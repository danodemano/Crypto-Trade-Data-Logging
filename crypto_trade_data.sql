-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 05, 2014 at 08:58 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crypto_trade_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `bitstamp_btc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `bitstamp_btc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `last` float NOT NULL,
  `timestamp` bigint(50) NOT NULL,
  `bid` float NOT NULL,
  `volume` float NOT NULL,
  `low` float NOT NULL,
  `ask` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18268 ;

-- --------------------------------------------------------

--
-- Table structure for table `bitstamp_trades`
--

CREATE TABLE IF NOT EXISTS `bitstamp_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `tid` bigint(50) NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid` (`tid`),
  KEY `date` (`date`),
  KEY `amount` (`price`),
  KEY `price` (`amount`),
  KEY `price_currency` (`price_currency`),
  KEY `item` (`item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61589 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_btc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_btc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17947 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_ltc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_ltc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17955 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_ltc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_ltc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18046 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_nmc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_nmc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18155 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_nmc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_nmc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18153 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_ppc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_ppc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18191 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_ppc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `btce_ppc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `vol` float NOT NULL,
  `vol_current` float NOT NULL,
  `last` float NOT NULL,
  `buy` float NOT NULL,
  `sell` float NOT NULL,
  `updated` bigint(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`),
  KEY `low` (`low`),
  KEY `avg` (`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18162 ;

-- --------------------------------------------------------

--
-- Table structure for table `btce_trades`
--

CREATE TABLE IF NOT EXISTS `btce_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `tid` bigint(50) NOT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `trade_type` varchar(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid` (`tid`),
  KEY `trade_type` (`trade_type`),
  KEY `item` (`item`),
  KEY `price_currency` (`price_currency`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1178020 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_doge_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `bter_doge_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `last` float NOT NULL,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `sell` float NOT NULL,
  `buy` float NOT NULL,
  `vol_doge` float NOT NULL,
  `vol_btc` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`,`low`,`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18246 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_ltc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `bter_ltc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `last` float NOT NULL,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `sell` float NOT NULL,
  `buy` float NOT NULL,
  `vol_ltc` float NOT NULL,
  `vol_btc` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`,`low`,`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18246 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_nmc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `bter_nmc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `last` float NOT NULL,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `sell` float NOT NULL,
  `buy` float NOT NULL,
  `vol_nmc` float NOT NULL,
  `vol_btc` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`,`low`,`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18254 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_nxt_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `bter_nxt_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `last` float NOT NULL,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `sell` float NOT NULL,
  `buy` float NOT NULL,
  `vol_nxt` float NOT NULL,
  `vol_btc` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`,`low`,`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18227 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_ppc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `bter_ppc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `last` float NOT NULL,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `sell` float NOT NULL,
  `buy` float NOT NULL,
  `vol_ppc` float NOT NULL,
  `vol_btc` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`,`low`,`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18244 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_trades`
--

CREATE TABLE IF NOT EXISTS `bter_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `price` float NOT NULL,
  `amount` float NOT NULL,
  `tid` bigint(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid` (`tid`),
  KEY `type` (`type`),
  KEY `price_currency` (`price_currency`),
  KEY `item` (`item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49697 ;

-- --------------------------------------------------------

--
-- Table structure for table `bter_vtc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `bter_vtc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `last` float NOT NULL,
  `high` float NOT NULL,
  `low` float NOT NULL,
  `avg` float NOT NULL,
  `sell` float NOT NULL,
  `buy` float NOT NULL,
  `vol_vtc` float NOT NULL,
  `vol_btc` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `high` (`high`,`low`,`avg`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18221 ;

-- --------------------------------------------------------

--
-- Table structure for table `cryptsy_ticker`
--

CREATE TABLE IF NOT EXISTS `cryptsy_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `marketid` int(25) NOT NULL,
  `label` varchar(50) NOT NULL,
  `current_volume` float NOT NULL,
  `last_trade` float NOT NULL,
  `high_trade` float NOT NULL,
  `low_trade` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `server_time_zone` varchar(15) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `marketid` (`marketid`),
  KEY `label` (`label`),
  KEY `current_volume` (`current_volume`),
  KEY `last_trade` (`last_trade`),
  KEY `high_trade` (`high_trade`),
  KEY `low_trade` (`low_trade`),
  KEY `server_time` (`server_time`),
  KEY `server_time_zone` (`server_time_zone`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1694001 ;

-- --------------------------------------------------------

--
-- Table structure for table `cryptsy_trades`
--

CREATE TABLE IF NOT EXISTS `cryptsy_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `tradeid` bigint(50) NOT NULL,
  `datetime` datetime NOT NULL,
  `tradeprice` float NOT NULL,
  `quantity` float NOT NULL,
  `total` float NOT NULL,
  `initiate_ordertype` varchar(25) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `server_time_zone` varchar(15) NOT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tradeid` (`tradeid`),
  KEY `initiate_ordertype` (`initiate_ordertype`),
  KEY `server_time` (`server_time`),
  KEY `server_time_zone` (`server_time_zone`),
  KEY `price_currency` (`price_currency`),
  KEY `item` (`item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=268117 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_btc_ltc_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_btc_ltc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_btc_nmc_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_btc_nmc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_btc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_btc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_btc_xrp_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_btc_xrp_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_control`
--

CREATE TABLE IF NOT EXISTS `kraken_control` (
  `field` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `field` (`field`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_ltc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_ltc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_nmc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_nmc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_trades`
--

CREATE TABLE IF NOT EXISTS `kraken_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL,
  `volume` float NOT NULL,
  `time` float NOT NULL,
  `buy_sell` varchar(25) NOT NULL,
  `market_limit` varchar(25) NOT NULL,
  `misc` varchar(255) DEFAULT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `price` (`price`),
  KEY `volume` (`volume`),
  KEY `buy_sell` (`buy_sell`),
  KEY `market_limit` (`market_limit`),
  KEY `price_currency` (`price_currency`),
  KEY `item` (`item`),
  KEY `server_time` (`server_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15003 ;

-- --------------------------------------------------------

--
-- Table structure for table `kraken_usd_xrp_ticker`
--

CREATE TABLE IF NOT EXISTS `kraken_usd_xrp_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `ask_price` float NOT NULL,
  `ask_volume` float NOT NULL,
  `bid_price` float NOT NULL,
  `bid_volume` float NOT NULL,
  `last_trade_price` float NOT NULL,
  `last_trade_volume` float NOT NULL,
  `volume_today` float NOT NULL,
  `volume_24h` float NOT NULL,
  `weighted_avg_price_today` float NOT NULL,
  `weighted_avg_price_24h` float NOT NULL,
  `number_of_trades_today` int(25) NOT NULL,
  `number_of_trades_24h` int(25) NOT NULL,
  `low_today` float NOT NULL,
  `low_24h` float NOT NULL,
  `high_today` float NOT NULL,
  `high_24h` float NOT NULL,
  `opening_price` float NOT NULL,
  `server_time` bigint(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14987 ;

-- --------------------------------------------------------

--
-- Table structure for table `poloniex_ticker`
--

CREATE TABLE IF NOT EXISTS `poloniex_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `pair` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `24h_volume_1` float NOT NULL,
  `24h_volume_2` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pair` (`pair`),
  KEY `price` (`price`),
  KEY `24h_volume_1` (`24h_volume_1`),
  KEY `24h_volume_2` (`24h_volume_2`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48361 ;

-- --------------------------------------------------------

--
-- Table structure for table `poloniex_trades`
--

CREATE TABLE IF NOT EXISTS `poloniex_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `type` varchar(25) NOT NULL,
  `rate` float NOT NULL,
  `amount` float NOT NULL,
  `total` float NOT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`type`,`rate`,`amount`,`total`,`price_currency`,`item`),
  KEY `type` (`type`),
  KEY `price_currency` (`price_currency`),
  KEY `item` (`item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1159 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_btc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_btc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_doge_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_doge_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_ltc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_ltc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_nmc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_nmc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_nxt_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_nxt_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_ppc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_ppc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_trades`
--

CREATE TABLE IF NOT EXISTS `vircurex_trades` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `tid` bigint(50) NOT NULL,
  `amount` float NOT NULL,
  `price` float NOT NULL,
  `price_currency` varchar(50) NOT NULL,
  `item` varchar(50) NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tid` (`tid`),
  KEY `date` (`date`),
  KEY `amount` (`amount`),
  KEY `price` (`price`),
  KEY `price_currency` (`price_currency`),
  KEY `item` (`item`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6855 ;

-- --------------------------------------------------------

--
-- Table structure for table `vircurex_vtc_btc_ticker`
--

CREATE TABLE IF NOT EXISTS `vircurex_vtc_btc_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `lowest_ask` float NOT NULL,
  `highest_bid` float NOT NULL,
  `last_trade` float NOT NULL,
  `volume` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `lowest_ask` (`lowest_ask`),
  KEY `highest_bid` (`highest_bid`),
  KEY `last_trade` (`last_trade`),
  KEY `volume` (`volume`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4144 ;

-- --------------------------------------------------------

--
-- Table structure for table `vos_btc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `vos_btc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `opening_price` float NOT NULL,
  `closing_price` float NOT NULL,
  `units_traded` float NOT NULL,
  `max_price` float NOT NULL,
  `min_price` float NOT NULL,
  `average_price` float NOT NULL,
  `volume_1day` float NOT NULL,
  `volume_7day` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `opening_price` (`opening_price`),
  KEY `closing_price` (`closing_price`),
  KEY `units_traded` (`units_traded`),
  KEY `max_price` (`max_price`),
  KEY `min_price` (`min_price`),
  KEY `average_price` (`average_price`),
  KEY `volume_1day` (`volume_1day`),
  KEY `volume_7day` (`volume_7day`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9389 ;

-- --------------------------------------------------------

--
-- Table structure for table `vos_doge_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `vos_doge_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `opening_price` float NOT NULL,
  `closing_price` float NOT NULL,
  `units_traded` float NOT NULL,
  `max_price` float NOT NULL,
  `min_price` float NOT NULL,
  `average_price` float NOT NULL,
  `volume_1day` float NOT NULL,
  `volume_7day` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `opening_price` (`opening_price`),
  KEY `closing_price` (`closing_price`),
  KEY `units_traded` (`units_traded`),
  KEY `max_price` (`max_price`),
  KEY `min_price` (`min_price`),
  KEY `average_price` (`average_price`),
  KEY `volume_1day` (`volume_1day`),
  KEY `volume_7day` (`volume_7day`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9389 ;

-- --------------------------------------------------------

--
-- Table structure for table `vos_ltc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `vos_ltc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `opening_price` float NOT NULL,
  `closing_price` float NOT NULL,
  `units_traded` float NOT NULL,
  `max_price` float NOT NULL,
  `min_price` float NOT NULL,
  `average_price` float NOT NULL,
  `volume_1day` float NOT NULL,
  `volume_7day` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `opening_price` (`opening_price`),
  KEY `closing_price` (`closing_price`),
  KEY `units_traded` (`units_traded`),
  KEY `max_price` (`max_price`),
  KEY `min_price` (`min_price`),
  KEY `average_price` (`average_price`),
  KEY `volume_1day` (`volume_1day`),
  KEY `volume_7day` (`volume_7day`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9389 ;

-- --------------------------------------------------------

--
-- Table structure for table `vos_ppc_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `vos_ppc_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `opening_price` float NOT NULL,
  `closing_price` float NOT NULL,
  `units_traded` float NOT NULL,
  `max_price` float NOT NULL,
  `min_price` float NOT NULL,
  `average_price` float NOT NULL,
  `volume_1day` float NOT NULL,
  `volume_7day` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `opening_price` (`opening_price`),
  KEY `closing_price` (`closing_price`),
  KEY `units_traded` (`units_traded`),
  KEY `max_price` (`max_price`),
  KEY `min_price` (`min_price`),
  KEY `average_price` (`average_price`),
  KEY `volume_1day` (`volume_1day`),
  KEY `volume_7day` (`volume_7day`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9390 ;

-- --------------------------------------------------------

--
-- Table structure for table `vos_xpm_usd_ticker`
--

CREATE TABLE IF NOT EXISTS `vos_xpm_usd_ticker` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` bigint(50) NOT NULL,
  `opening_price` float NOT NULL,
  `closing_price` float NOT NULL,
  `units_traded` float NOT NULL,
  `max_price` float NOT NULL,
  `min_price` float NOT NULL,
  `average_price` float NOT NULL,
  `volume_1day` float NOT NULL,
  `volume_7day` float NOT NULL,
  `inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `opening_price` (`opening_price`),
  KEY `closing_price` (`closing_price`),
  KEY `units_traded` (`units_traded`),
  KEY `max_price` (`max_price`),
  KEY `min_price` (`min_price`),
  KEY `average_price` (`average_price`),
  KEY `volume_1day` (`volume_1day`),
  KEY `volume_7day` (`volume_7day`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8101 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
