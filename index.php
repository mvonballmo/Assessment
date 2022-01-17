<?php

function GetCurrentPrice()
{
  $url='https://api.coinbase.com/v2/prices/spot?currency=CHF';
  $bitcoinInCHF=json_decode(file_get_contents($url));

  return $bitcoinInCHF->data->amount;
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
  $connection = new mysqli("bitcoin-db", "root", "\"localaccess\"", "bitcoin");

  if ($connection->connect_errno)
  {
    die("Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error);
  }

  $query_string = "SELECT * FROM BitcoinPrices ORDER BY date DESC";

  $query_result = $connection->query($query_string);
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
  }
  else if ($query_result === false)
  {
    die('Error executing query: ' . $connection->error);
  }
}



?>
  <h1>Bitcoin data</h1>
  <h2>Current Bitcoin Price</h2>
<?php
  $currentPrice = round(GetCurrentPrice(), 3);
  echo "1 bitcoin = CHF $currentPrice";
?>
  <h1>Historical Prices</h1>
<?php
  if (empty($historicalData)) {
    echo "<p>There are no prices available.</p>";
  }
  else {
?>
  <table>
<?php
  echo "<tr><th>Price</th><th>Date</th></tr>";
  $historicalData = GetHistoricalPrices ();
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