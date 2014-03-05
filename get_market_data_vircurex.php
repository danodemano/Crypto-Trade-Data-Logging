<?php
//Enable debugging - disable when going live
$debug_mode = false;

//All the data arrays we need to fill
$btc_usd = array();
$ltc_btc = array();
$doge_btc = array();
$nmc_btc = array();
$nxt_btc = array();
$ppc_btc = array();
$vtc_btc = array();

//Get all the ticker data
$btc_usd['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=BTC&alt=USD'), true);
$ltc_btc['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=LTC&alt=BTC'), true);
$doge_btc['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=DOGE&alt=BTC'), true);
$nmc_btc['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=NMC&alt=BTC'), true);
$nxt_btc['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=NXT&alt=BTC'), true);
$ppc_btc['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=PPC&alt=BTC'), true);
$vtc_btc['ticker'] = json_decode(file_get_contents('https://api.vircurex.com/api/get_info_for_1_currency.json?base=VTC&alt=BTC'), true);

//Get all trade data
$btc_usd['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=BTC&alt=USD'), true);
$ltc_btc['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=LTC&alt=BTC'), true);
$doge_btc['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=DOGE&alt=BTC'), true);
$nmc_btc['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=NMC&alt=BTC'), true);
$nxt_btc['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=NXT&alt=BTC'), true);
$ppc_btc['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=PPC&alt=BTC'), true);
$vtc_btc['trades'] = json_decode(file_get_contents('https://api.vircurex.com/api/trades.json?base=VTC&alt=BTC'), true);

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
//Checking to make sure we have data from the API call
if ((isset($btc_usd['ticker']['highest_bid'])) AND ($btc_usd['ticker']['highest_bid']<>0) AND ($btc_usd['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_btc_usd_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$btc_usd['ticker']['lowest_ask']."', '".$btc_usd['ticker']['highest_bid']."', ".
			"'".$btc_usd['ticker']['last_trade']."', '".$btc_usd['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($btc_usd['ticker']['highest_bid'])) AND ($btc_usd['ticker']['highest_bid']<>0) AND ($btc_usd['ticker']['highest_bid']<>'')) {

if ((isset($ltc_btc['ticker']['highest_bid'])) AND ($ltc_btc['ticker']['highest_bid']<>0) AND ($ltc_btc['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_ltc_btc_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$ltc_btc['ticker']['lowest_ask']."', '".$ltc_btc['ticker']['highest_bid']."', ".
			"'".$ltc_btc['ticker']['last_trade']."', '".$ltc_btc['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ltc_btc['ticker']['highest_bid'])) AND ($ltc_btc['ticker']['highest_bid']<>0) AND ($ltc_btc['ticker']['highest_bid']<>'')) {

if ((isset($doge_btc['ticker']['highest_bid'])) AND ($doge_btc['ticker']['highest_bid']<>0) AND ($doge_btc['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_doge_btc_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$doge_btc['ticker']['lowest_ask']."', '".$doge_btc['ticker']['highest_bid']."', ".
			"'".$doge_btc['ticker']['last_trade']."', '".$doge_btc['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($doge_btc['ticker']['highest_bid'])) AND ($doge_btc['ticker']['highest_bid']<>0) AND ($doge_btc['ticker']['highest_bid']<>'')) {

if ((isset($nmc_btc['ticker']['highest_bid'])) AND ($nmc_btc['ticker']['highest_bid']<>0) AND ($nmc_btc['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_nmc_btc_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$nmc_btc['ticker']['lowest_ask']."', '".$nmc_btc['ticker']['highest_bid']."', ".
			"'".$nmc_btc['ticker']['last_trade']."', '".$nmc_btc['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nmc_btc['ticker']['highest_bid'])) AND ($nmc_btc['ticker']['highest_bid']<>0) AND ($nmc_btc['ticker']['highest_bid']<>'')) {

if ((isset($nxt_btc['ticker']['highest_bid'])) AND ($nxt_btc['ticker']['highest_bid']<>0) AND ($nxt_btc['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_nxt_btc_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$nxt_btc['ticker']['lowest_ask']."', '".$nxt_btc['ticker']['highest_bid']."', ".
			"'".$nxt_btc['ticker']['last_trade']."', '".$nxt_btc['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($nxt_btc['ticker']['highest_bid'])) AND ($nxt_btc['ticker']['highest_bid']<>0) AND ($nxt_btc['ticker']['highest_bid']<>'')) {

if ((isset($ppc_btc['ticker']['highest_bid'])) AND ($ppc_btc['ticker']['highest_bid']<>0) AND ($ppc_btc['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_ppc_btc_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$ppc_btc['ticker']['lowest_ask']."', '".$ppc_btc['ticker']['highest_bid']."', ".
			"'".$ppc_btc['ticker']['last_trade']."', '".$ppc_btc['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($ppc_btc['ticker']['highest_bid'])) AND ($ppc_btc['ticker']['highest_bid']<>0) AND ($ppc_btc['ticker']['highest_bid']<>'')) {

if ((isset($vtc_btc['ticker']['highest_bid'])) AND ($vtc_btc['ticker']['highest_bid']<>0) AND ($vtc_btc['ticker']['highest_bid']<>'')) {
	$sql =  "INSERT INTO `vircurex_vtc_btc_ticker` (`lowest_ask`, `highest_bid`, `last_trade`, `volume`) ".
			"VALUES ('".$vtc_btc['ticker']['lowest_ask']."', '".$vtc_btc['ticker']['highest_bid']."', ".
			"'".$vtc_btc['ticker']['last_trade']."', '".$vtc_btc['ticker']['volume']."');";

	if (!$debug_mode) {
		mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end if ((isset($vtc_btc['ticker']['highest_bid'])) AND ($vtc_btc['ticker']['highest_bid']<>0) AND ($vtc_btc['ticker']['highest_bid']<>'')) {

//Inserting the trade data into the database
foreach ($btc_usd['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
			"'USD', 'BTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($btc_usd['trades'] as $trade) {

foreach ($ltc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
			"'BTC', 'LTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_btc['trades'] as $trade) {

foreach ($doge_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
			"'BTC', 'DOGE');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($doge_btc['trades'] as $trade) {

foreach ($nmc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
			"'BTC', 'NMC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_btc['trades'] as $trade) {

foreach ($nxt_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
			"'BTC', 'NXT');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nxt_btc['trades'] as $trade) {

foreach ($ppc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
			"'BTC', 'PPC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ppc_btc['trades'] as $trade) {

foreach ($vtc_btc['trades'] as $trade) {
	$sql =  "INSERT INTO `vircurex_trades` (`date`, `tid`, `amount`, `price`, `price_currency`, `item`) ".
			"VALUES ('".$trade['date']."', '".$trade['tid']."', '".$trade['amount']."', '".$trade['price']."', ".
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
