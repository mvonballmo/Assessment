<?php
require("Common.php");
?>
  <link rel="stylesheet" href="Reset.css" />
  <link rel="stylesheet" href="Styles.css" />
  <h1>Bitcoin data</h1>
  <h2>Current Bitcoin Price</h2>
<?php
  $currentPrice = round(GetCurrentPrice(), 3);
  echo "1 BTC = CHF $currentPrice";

  StorePrice($currentPrice);
?>
  <h2>Historical Prices</h2>
<?php
  /** @var HistoricalPrice[] $historicalData */
  $historicalData = iterator_to_array (GetHistoricalPrices());
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
    $date = $datum->date->format("Y-m-d H:i:s");
    echo "<tr><td>$price</td><td>$date</td></tr>";
  }
?>
  </table>
<?php
  }