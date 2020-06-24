-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2020 年 6 月 24 日 23:20
-- サーバのバージョン： 10.4.11-MariaDB
-- PHP のバージョン: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gsacf_d06_04`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `weightLoss`
--

CREATE TABLE `weightLoss` (
  `date` date NOT NULL,
  `weight` varchar(20) NOT NULL,
  `bodyfat` varchar(20) NOT NULL,
  `memo` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `weightLoss`
--

INSERT INTO `weightLoss` (`date`, `weight`, `bodyfat`, `memo`) VALUES
('2020-06-10', '99', '99', 'よく食べた'),
('2020-06-22', '99', '99', 'hhh'),
('2020-06-22', '10', '10', '痩せた'),
('2020-06-23', '99', '99', 'ほほ'),
('2020-06-23', '77', '77', 'hoho'),
('2020-06-24', '88', '88', 'てすと'),
('2020-06-18', 'tr', 'yr', 'yr');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
