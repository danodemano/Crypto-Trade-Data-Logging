<?php
//Enable debugging - disable when going live
$debug_mode = false;

//All the data arrays we need to fill
$ltc_btc = array();
$doge_btc = array();
$nmc_btc = array();
$nxt_btc = array();
$vtc_btc = array();
$misc = array();

//Get all the ticker/volume data
$misc['ticker'] = json_decode(file_get_contents('https://poloniex.com/public?command=returnTicker'), true);
$misc['volume'] = json_decode(file_get_contents('https://poloniex.com/public?command=return24hVolume'), true);

//Get all trade data
$ltc_btc['trades'] = json_decode(file_get_contents('https://poloniex.com/public?command=returnTradeHistory&currencyPair=BTC_LTC'), true);
$doge_btc['trades'] = json_decode(file_get_contents('https://poloniex.com/public?command=returnTradeHistory&currencyPair=BTC_DOGE'), true);
$nmc_btc['trades'] = json_decode(file_get_contents('https://poloniex.com/public?command=returnTradeHistory&currencyPair=BTC_NMC'), true);
$nxt_btc['trades'] = json_decode(file_get_contents('https://poloniex.com/public?command=returnTradeHistory&currencyPair=BTC_NXT'), true);
$vtc_btc['trades'] = json_decode(file_get_contents('https://poloniex.com/public?command=returnTradeHistory&currencyPair=BTC_VTC'), true);

//Database configurations
if (!$debug_mode) {
	require_once('dbinfo.php');
	
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass);

	//Make sure we are able to connect to the server
	if (!$conn) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	} //end if (!$conn) {

	//Set the database
	mysqli_select_db($conn, $dbname);
} //end if (!$debug_mode) {

//Insert all the ticker data into the database
foreach($misc['ticker'] as $key => $value) {
	$items = explode("_", $key); //Break out the pairs to reference the volume array
	$sql =  "INSERT INTO `poloniex_ticker` (`pair`, `price`, `24h_volume_1`, `24h_volume_2`) ".
		"VALUES ('$key', '$value', '".$misc['volume'][$key][$items[0]]."', '".$misc['volume'][$key][$items[1]]."');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach($misc['ticker'] as $ticker) {

//Inserting the trade data into the database
foreach ($ltc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `poloniex_trades` (`date`, `type`, `rate`, `amount`, `total`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['type']."', '".$trade['rate']."', '".$trade['amount']."', '".$trade['total']."', ".
			"'BTC', 'LTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_btc['trades'] as $trade) {

foreach ($doge_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `poloniex_trades` (`date`, `type`, `rate`, `amount`, `total`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['type']."', '".$trade['rate']."', '".$trade['amount']."', '".$trade['total']."', ".
			"'BTC', 'DOGE');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($doge_btc['trades'] as $trade) {

foreach ($nmc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `poloniex_trades` (`date`, `type`, `rate`, `amount`, `total`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['type']."', '".$trade['rate']."', '".$trade['amount']."', '".$trade['total']."', ".
			"'BTC', 'NMC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_btc['trades'] as $trade) {

foreach ($nxt_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `poloniex_trades` (`date`, `type`, `rate`, `amount`, `total`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['type']."', '".$trade['rate']."', '".$trade['amount']."', '".$trade['total']."', ".
			"'BTC', 'NXT');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nxt_btc['trades'] as $trade) {

foreach ($vtc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `poloniex_trades` (`date`, `type`, `rate`, `amount`, `total`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['type']."', '".$trade['rate']."', '".$trade['amount']."', '".$trade['total']."', ".
			"'BTC', 'VTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($vtc_btc['trades'] as $trade) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>
