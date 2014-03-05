<?php
//Enable debugging - disable when going live
$debug_mode = false;

require_once 'functions.php'; //The global functions file

require_once 'KrakenAPIClient.php';
$kraken = new KrakenAPI('1234', '1234'); 

//All the data arrays we need to fill
$btc_usd = array();
$ltc_usd = array();
$nmc_usd = array();
$btc_ltc = array();
$usd_xrp = array();
$btc_nmc = array();
$btc_xrp = array();
$misc    = array();

//Get the server time
$misc['time'] = $kraken->QueryPublic('Time');

//Get all the ticker data
$btc_usd['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'XXBTZUSD'));
$ltc_usd['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'XLTCZUSD'));
$nmc_usd['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'XNMCZUSD'));
$btc_ltc['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'XXBTXLTC'));
$usd_xrp['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'ZUSDXXRP'));
$btc_nmc['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'XXBTXNMC'));
$btc_xrp['ticker'] = $kraken->QueryPublic('Ticker', array('pair' => 'XXBTXXRP'));

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

//Check the last trade number to query only latest trades
$last_btc_usd = get_control('last_btc_usd', $conn, 'kraken');
$last_ltc_usd = get_control('last_ltc_usd', $conn, 'kraken');
$last_nmc_usd = get_control('last_nmc_usd', $conn, 'kraken');
$last_btc_ltc = get_control('last_btc_ltc', $conn, 'kraken');
$last_usd_xrp = get_control('last_usd_xrp', $conn, 'kraken');
$last_btc_nmc = get_control('last_btc_nmc', $conn, 'kraken');
$last_btc_xrp = get_control('last_btc_xrp', $conn, 'kraken');

//Get all the trade data
if ($last_btc_usd=='unknown') {
	$btc_usd['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTZUSD'));
}else{
	$btc_usd['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTZUSD', 'since' => $last_btc_usd));
} //end if ($last_btc_usd=='unknown') {
if ($last_ltc_usd=='unknown') {
	$ltc_usd['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XLTCZUSD'));
}else{
	$ltc_usd['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XLTCZUSD', 'since' => $last_ltc_usd));
} //end if ($last_ltc_usd=='unknown') {
if ($last_nmc_usd=='unknown') {
	$nmc_usd['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XNMCZUSD'));
}else{
	$nmc_usd['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XNMCZUSD', 'since' => $last_nmc_usd));
} //end if ($last_nmc_usd=='unknown') {
if ($last_btc_ltc=='unknown') {
	$btc_ltc['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTXLTC'));
}else{
	$btc_ltc['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTXLTC', 'since' => $last_btc_ltc));
} //end if ($last_btc_ltc=='unknown') {
if ($last_usd_xrp=='unknown') {
	$usd_xrp['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'ZUSDXXRP'));
}else{
	$usd_xrp['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'ZUSDXXRP', 'since' => $last_usd_xrp));
} //end if ($last_usd_xrp=='unknown') {
if ($last_btc_nmc=='unknown') {
	$btc_nmc['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTXNMC'));
}else{
	$btc_nmc['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTXNMC', 'since' => $last_btc_nmc));
} //end if ($last_btc_nmc=='unknown') {
if ($last_btc_xrp=='unknown') {
	$btc_xrp['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTXXRP'));
}else{
	$btc_xrp['trades'] = $kraken->QueryPublic('Trades', array('pair' => 'XXBTXXRP', 'since' => $last_btc_xrp));
} //end if ($last_btc_xrp=='unknown') {

//Update all the last trades
set_control('last_btc_usd', $btc_usd['trades']['result']['last'], $conn, 'kraken');
set_control('last_ltc_usd', $ltc_usd['trades']['result']['last'], $conn, 'kraken');
set_control('last_nmc_usd', $nmc_usd['trades']['result']['last'], $conn, 'kraken');
set_control('last_btc_ltc', $btc_ltc['trades']['result']['last'], $conn, 'kraken');
set_control('last_usd_xrp', $usd_xrp['trades']['result']['last'], $conn, 'kraken');
set_control('last_btc_nmc', $btc_nmc['trades']['result']['last'], $conn, 'kraken');
set_control('last_btc_xrp', $btc_xrp['trades']['result']['last'], $conn, 'kraken');

//Insert all the ticker data into the database
//Checking to make sure we have data from the API call
if ((isset($btc_usd['ticker']['result']['XXBTZUSD']['a'][0])) AND ($btc_usd['ticker']['result']['XXBTZUSD']['a'][0]<>0) AND ($btc_usd['ticker']['result']['XXBTZUSD']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_btc_usd_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$btc_usd['ticker']['result']['XXBTZUSD']['a'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['a'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['b'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['b'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['c'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['c'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['v'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['v'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['p'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['p'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['t'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['t'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['l'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['l'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['h'][0]."', '".$btc_usd['ticker']['result']['XXBTZUSD']['h'][1]."', ".
		"'".$btc_usd['ticker']['result']['XXBTZUSD']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_usd['ticker']['result']['XXBTZUSD']['a'][0])) AND ($btc_usd['ticker']['result']['XXBTZUSD']['a'][0]<>0) AND ($btc_usd['ticker']['result']['XXBTZUSD']['a'][0]<>'')) {

if ((isset($ltc_usd['ticker']['result']['XLTCZUSD']['a'][0])) AND ($ltc_usd['ticker']['result']['XLTCZUSD']['a'][0]<>0) AND ($ltc_usd['ticker']['result']['XLTCZUSD']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_ltc_usd_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$ltc_usd['ticker']['result']['XLTCZUSD']['a'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['a'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['b'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['b'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['c'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['c'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['v'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['v'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['p'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['p'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['t'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['t'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['l'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['l'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['h'][0]."', '".$ltc_usd['ticker']['result']['XLTCZUSD']['h'][1]."', ".
		"'".$ltc_usd['ticker']['result']['XLTCZUSD']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ltc_usd['ticker']['result']['XLTCZUSD']['a'][0])) AND ($ltc_usd['ticker']['result']['XLTCZUSD']['a'][0]<>0) AND ($ltc_usd['ticker']['result']['XLTCZUSD']['a'][0]<>'')) {

if ((isset($nmc_usd['ticker']['result']['XNMCZUSD']['a'][0])) AND ($nmc_usd['ticker']['result']['XNMCZUSD']['a'][0]<>0) AND ($nmc_usd['ticker']['result']['XNMCZUSD']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_nmc_usd_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$nmc_usd['ticker']['result']['XNMCZUSD']['a'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['a'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['b'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['b'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['c'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['c'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['v'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['v'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['p'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['p'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['t'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['t'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['l'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['l'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['h'][0]."', '".$nmc_usd['ticker']['result']['XNMCZUSD']['h'][1]."', ".
		"'".$nmc_usd['ticker']['result']['XNMCZUSD']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nmc_usd['ticker']['result']['XNMCZUSD']['a'][0])) AND ($nmc_usd['ticker']['result']['XNMCZUSD']['a'][0]<>0) AND ($nmc_usd['ticker']['result']['XNMCZUSD']['a'][0]<>'')) {

if ((isset($btc_ltc['ticker']['result']['XXBTXLTC']['a'][0])) AND ($btc_ltc['ticker']['result']['XXBTXLTC']['a'][0]<>0) AND ($btc_ltc['ticker']['result']['XXBTXLTC']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_btc_ltc_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$btc_ltc['ticker']['result']['XXBTXLTC']['a'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['a'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['b'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['b'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['c'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['c'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['v'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['v'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['p'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['p'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['t'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['t'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['l'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['l'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['h'][0]."', '".$btc_ltc['ticker']['result']['XXBTXLTC']['h'][1]."', ".
		"'".$btc_ltc['ticker']['result']['XXBTXLTC']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_ltc['ticker']['result']['XXBTXLTC']['a'][0])) AND ($btc_ltc['ticker']['result']['XXBTXLTC']['a'][0]<>0) AND ($btc_ltc['ticker']['result']['XXBTXLTC']['a'][0]<>'')) {

if ((isset($usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0])) AND ($usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0]<>0) AND ($usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_usd_xrp_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['a'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['b'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['b'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['c'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['c'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['v'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['v'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['p'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['p'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['t'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['t'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['l'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['l'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['h'][0]."', '".$usd_xrp['ticker']['result']['ZUSDXXRP']['h'][1]."', ".
		"'".$usd_xrp['ticker']['result']['ZUSDXXRP']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0])) AND ($usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0]<>0) AND ($usd_xrp['ticker']['result']['ZUSDXXRP']['a'][0]<>'')) {

if ((isset($btc_nmc['ticker']['result']['XXBTXNMC']['a'][0])) AND ($btc_nmc['ticker']['result']['XXBTXNMC']['a'][0]<>0) AND ($btc_nmc['ticker']['result']['XXBTXNMC']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_btc_nmc_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$btc_nmc['ticker']['result']['XXBTXNMC']['a'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['a'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['b'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['b'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['c'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['c'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['v'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['v'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['p'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['p'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['t'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['t'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['l'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['l'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['h'][0]."', '".$btc_nmc['ticker']['result']['XXBTXNMC']['h'][1]."', ".
		"'".$btc_nmc['ticker']['result']['XXBTXNMC']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_nmc['ticker']['result']['XXBTXNMC']['a'][0])) AND ($btc_nmc['ticker']['result']['XXBTXNMC']['a'][0]<>0) AND ($btc_nmc['ticker']['result']['XXBTXNMC']['a'][0]<>'')) {

if ((isset($btc_xrp['ticker']['result']['XXBTXXRP']['a'][0])) AND ($btc_xrp['ticker']['result']['XXBTXXRP']['a'][0]<>0) AND ($btc_xrp['ticker']['result']['XXBTXXRP']['a'][0]<>'')) {
	$sql =  "INSERT INTO `kraken_btc_xrp_ticker` (`ask_price`, `ask_volume`, `bid_price`, `bid_volume`, `last_trade_price`, `last_trade_volume`, `volume_today`, `volume_24h`, ".
		"`weighted_avg_price_today`, `weighted_avg_price_24h`, `number_of_trades_today`, `number_of_trades_24h`, `low_today`, `low_24h`, `high_today`, `high_24h`, ".
		"`opening_price`, `server_time`) ".
		"VALUES ('".$btc_xrp['ticker']['result']['XXBTXXRP']['a'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['a'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['b'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['b'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['c'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['c'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['v'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['v'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['p'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['p'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['t'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['t'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['l'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['l'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['h'][0]."', '".$btc_xrp['ticker']['result']['XXBTXXRP']['h'][1]."', ".
		"'".$btc_xrp['ticker']['result']['XXBTXXRP']['o']."', '".$misc['time']['result']['unixtime']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_xrp['ticker']['result']['XXBTXXRP']['a'][0])) AND ($btc_xrp['ticker']['result']['XXBTXXRP']['a'][0]<>0) AND ($btc_xrp['ticker']['result']['XXBTXXRP']['a'][0]<>'')) {

//Inserting the trade data into the database
foreach ($btc_usd['trades']['result']['XXBTZUSD'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'USD', 'BTC', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'USD', 'BTC', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_usd['trades']['result']['XXBTZUSD'] as $trade) {

foreach ($ltc_usd['trades']['result']['XLTCZUSD'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'USD', 'LTC', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'USD', 'LTC', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_usd['trades']['result']['XLTCZUSD'] as $trade) {

foreach ($nmc_usd['trades']['result']['XNMCZUSD'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'USD', 'NMC', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'USD', 'NMC', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_usd['trades']['result']['XNMCZUSD'] as $trade) {

foreach ($btc_ltc['trades']['result']['XXBTXLTC'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'LTC', 'BTC', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'LTC', 'BTC', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_ltc['trades']['result']['XXBTXLTC'] as $trade) {

foreach ($usd_xrp['trades']['result']['ZUSDXXRP'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'XRP', 'USD', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'XRP', 'USD', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($usd_xrp['trades']['result']['ZUSDXXRP'] as $trade) {

foreach ($btc_nmc['trades']['result']['XXBTXNMC'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'NMC', 'BTC', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'NMC', 'BTC', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_nmc['trades']['result']['XXBTXNMC'] as $trade) {

foreach ($btc_xrp['trades']['result']['XXBTXXRP'] as $trade) {
	if ($trade[5]=='') {
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', NULL, 'XRP', 'BTC', '".$misc['time']['result']['unixtime']."');";
	}else{
		$sql =  "INSERT INTO `kraken_trades` (`price`, `volume`, `time`, `buy_sell`, `market_limit`, `misc`, `price_currency`, `item`, `server_time`) ".
			"VALUES ('".$trade[0]."', '".$trade[1]."', '".$trade[2]."', '".$trade[3]."', ".
			"'".$trade[4]."', '".$trade[5]."' 'XRP', 'BTC', '".$misc['time']['result']['unixtime']."');";
	} //end if ($trade[5]=='') {
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_xrp['trades']['result']['XXBTXXRP'] as $trade) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>
