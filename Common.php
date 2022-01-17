<?php

/**
 * @return bool|mysqli_result|void
 */
function GetQueryResult (string $query_string)
{
  $connection = new mysqli("bitcoin-db", "root", "localaccess", "bitcoin");

  if ($connection->connect_errno)
  {
    die("Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error);
  }

  $query_result = $connection->query ($query_string);

  if ($query_result === false)
  {
    die('Error executing query: ' . $connection->error);
  }

  return $query_result;
}

function GetCurrentPrice(): float
{
  $url='https://api.coinbase.com/v2/prices/spot?currency=CHF';
  $bitcoinInCHF=json_decode(file_get_contents($url));

  return $bitcoinInCHF->data->amount;
}

function StorePrice($price)
{
  GetQueryResult ("INSERT INTO BitcoinPrices (price_in_chf) VALUES($price)");
}

class HistoricalPrice
{
  public float $price;
  public DateTime $date;

  public function __construct ($price, $date)
  {
    $this->price = $price;
    $this->date = $date;
  }
}

function GetQueryData($createRowData): Generator
{
  $query_result = GetQueryResult ("SELECT * FROM BitcoinPrices ORDER BY date DESC");

  if (is_a($query_result, 'mysqli_result'))
  {
    $query_result->data_seek(0);

    $row = $query_result->fetch_array();
    while (isset($row)) {
      yield $createRowData($row);

      $row = $query_result->fetch_array();
    }
  } else {
    die("Historical data retrieval failed.");
  }
}

function GetHistoricalPrices(): Generator
{
  yield from GetQueryData (function($row) {
    return new HistoricalPrice($row["price_in_chf"], new DateTime($row["date"]));
  });
}

function ClearOldData()
{
  GetQueryResult ("DELETE FROM `BitcoinPrices` WHERE date < DATE_ADD(current_timestamp(), INTERVAL -120 DAY)");
}