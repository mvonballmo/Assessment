<?php

function GetCurrentPrice()
{
  $url='https://api.coinbase.com/v2/prices/spot?currency=CHF';
  $bitcoinInCHF=json_decode(file_get_contents($url));

  return $bitcoinInCHF->data->amount;
}

function StorePrice($price)
{
  getQueryResult ("INSERT INTO BitcoinPrices (price_in_chf) VALUES($price)");
}

class HistoricalPrice
{
  public $price;
  public $date;

  public function __construct ($price, $date)
  {
    $this->price = $price;
    $this->date = $date;
  }
}

function GetHistoricalPrices()
{
  $query_result = getQueryResult ("SELECT * FROM BitcoinPrices ORDER BY date DESC");

  if (is_a($query_result, 'mysqli_result'))
  {
    $rows = [];
    $result_set = $query_result;
    $result_set->data_seek(0);

    $row = $result_set->fetch_array();
    while (isset($row)) {
      $price = $row["price_in_chf"];
      $date = $row["date"];

      array_push($rows, new HistoricalPrice($price, $date));

      $row = $result_set->fetch_array();
    }

    return $rows;
  } else {
    die("Historical data retrieval failed.");
  }
}

/**
 * @param $query_string
 * @return bool|mysqli_result|void
 */
function GetQueryResult ($query_string)
{
  $connection = new mysqli("bitcoin-db", "root", "\"localaccess\"", "bitcoin");

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

?>
  <h1>Bitcoin data</h1>
  <h2>Current Bitcoin Price</h2>
<?php
  $currentPrice = round(GetCurrentPrice(), 3);
  echo "1 bitcoin = CHF $currentPrice";

  StorePrice($currentPrice);
?>
  <h1>Historical Prices</h1>
<?php
  $historicalData = GetHistoricalPrices ();
  if (empty($historicalData)) {
    echo "<p>There are no prices available.</p>";
  }
  else {
?>
  <a href="clearOldData.php">Clear old data</a>
  <table>
<?php
  echo "<tr><th>Price</th><th>Date</th></tr>";
  foreach ($historicalData as $datum)
  {
    $price = $datum->price;
    $date = $datum->date;
    echo "<tr><td>$price</td><td>$date</td></tr>";
  }
?>
  </table>
<?php
  }