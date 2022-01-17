<?php

$url='https://api.coinbase.com/v2/prices/spot?currency=CHF';
$bitcoinInCHF=json_decode(file_get_contents($url));

echo "1 bitcoin = CHF" . $bitcoinInCHF->data->amount;