<?php

echo "jello";

$url='https://bitpay.com/api/rates';
$json=json_decode( file_get_contents( $url ) );
$dollar=$btc=0;

foreach( $json as $obj ){
  if( $obj->code=='USD' )$btc=$obj->rate;
}

echo "1 bitcoin=\$" . $btc . "USD<br />";
$dollar=1 / $btc;
echo "10 dollars = " . round( $dollar * 10,8 )."BTC";

//https://api.coinbase.com/v2/prices/spot?currency=USD