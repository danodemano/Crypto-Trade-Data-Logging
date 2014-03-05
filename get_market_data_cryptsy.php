<?php
//Enable debugging - disable when going live
$debug_mode = false;

//All the data arrays we need to fill
$ltc_btc = array(); //3
$doge_btc = array(); //132
$nmc_btc = array(); //29
$ppc_btc = array(); //28
$vtc_btc = array(); //151
$xpm_btc = array(); //63
$nxt_btc = array(); //159
$misc = array(); //Global market/ticker/server data

require_once 'cryptsyAPI.php';

//Get all the ticker and server data
$misc['tickers'] = api_query("getmarkets");
$misc['server'] = api_query("getinfo");

//Get all the trade data
$ltc_btc['trades'] = api_query("markettrades", array("marketid" => 3));
$doge_btc['trades'] = api_query("markettrades", array("marketid" => 132));
$nmc_btc['trades'] = api_query("markettrades", array("marketid" => 29));
$ppc_btc['trades'] = api_query("markettrades", array("marketid" => 28));
$vtc_btc['trades'] = api_query("markettrades", array("marketid" => 151));
$xpm_btc['trades'] = api_query("markettrades", array("marketid" => 63));
$nxt_btc['trades'] = api_query("markettrades", array("marketid" => 159));

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

//Verify we have timestamp data
if (isset($misc['server']['return']['servertimestamp']) AND ($misc['server']['return']['servertimestamp']>0)) {
	//Insert all the ticker data into the database
	foreach ($misc['tickers']['return'] as $ticker) {
		//Only insert the specific market IDs we are looking for
		$id = $ticker['marketid']; //Only query the array once
		if (($id==3) OR ($id==132) OR ($id==29) OR ($id==28) OR ($id==151) OR ($id==63) OR ($id==159)) {
			$sql =  "INSERT INTO `cryptsy_ticker` (`marketid`, `label`, `current_volume`, `last_trade`, `high_trade`, `low_trade`, `server_time`, `server_time_zone`) ".
					"VALUES ('".$ticker['marketid']."', '".$ticker['label']."', ".
					"'".$ticker['current_volume']."', '".$ticker['last_trade']."', ".
					"'".$ticker['high_trade']."', '".$ticker['low_trade']."', ".
					"'".$misc['server']['return']['servertimestamp']."', '".$misc['server']['return']['servertimezone']."');";

			if (!$debug_mode) {
				mysqli_query($conn, $sql) or die('Error, query failed. ' . mysqli_error($conn) . '<br>Line: '.__LINE__ .'<br>File: '.__FILE__);
			}else{
				echo $sql;
				echo "<br><br>";
			} //end if (!$debug_mode) {
		} //end if (($id==3) OR ($id==112) OR ($id==29) OR ($id==28) OR ($id==151) OR ($id==63) OR ($id==159)) {
	} //end foreach ($misc['tickers']['return'] as $ticker) {
}else{
	die ("no timestamp information from server");
} //end if (isset($misc['server']['return']['servertimestamp']) AND ($misc['server']['return']['servertimestamp']>0)) {

//Inserting the trade data into the database
foreach ($ltc_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'LTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ltc_btc['trades']['return'] as $trade) {

foreach ($doge_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'DOGE');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($doge_btc['trades']['return'] as $trade) {

foreach ($nmc_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'NMC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nmc_btc['trades']['return'] as $trade) {

foreach ($ppc_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'PPC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($ppc_btc['trades']['return'] as $trade) {

foreach ($vtc_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'VTC');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($vtc_btc['trades']['return'] as $trade) {

foreach ($xpm_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'XPM');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($xpm_btc['trades']['return'] as $trade) {

foreach ($nxt_btc['trades']['return'] as $trade) {
	$sql =  "INSERT INTO `cryptsy_trades` (`tradeid`, `datetime`, `tradeprice`, `quantity`, `total`, `initiate_ordertype`, `server_time`, `server_time_zone`, `price_currency`, `item`) ".
			"VALUES ('".$trade['tradeid']."', '".$trade['datetime']."', '".$trade['tradeprice']."', '".$trade['quantity']."', ".
			"'".$trade['total']."', '".$trade['initiate_ordertype']."', '".$misc['server']['return']['servertimestamp']."', ".
			"'".$misc['server']['return']['servertimezone']."', 'BTC', 'NXT');";
	if (!$debug_mode) {
		mysqli_query($conn, $sql);
	}else{
		echo $sql;
		echo "<br><br>";
	} //end if (!$debug_mode) {
} //end foreach ($nxt_btc['trades']['return'] as $trade) {

//Close the database connection
if (!$debug_mode) {
	mysqli_close($conn);
} //end if (!$debug_mode) {
?>
