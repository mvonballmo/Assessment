<?php
require("Common.php");
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