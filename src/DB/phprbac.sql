-- phpMyAdmin SQL Dump
-- version 4.2.8deb1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生時間： 2014 年 09 月 24 日 14:59
-- 伺服器版本: 5.5.39-1
-- PHP 版本： 5.6.0-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `phprbac`
--

-- --------------------------------------------------------

--
-- 資料表結構 `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
`id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `resource` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `roleresource`
--

CREATE TABLE IF NOT EXISTS `roleresource` (
  `role_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `action` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'get|post|put|delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `userrole`
--

CREATE TABLE IF NOT EXISTS `userrole` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `resource`
--
ALTER TABLE `resource`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `resource` (`resource`);

--
-- 資料表索引 `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- 資料表索引 `roleresource`
--
ALTER TABLE `roleresource`
 ADD PRIMARY KEY (`role_id`,`resource_id`), ADD UNIQUE KEY `roleresource` (`role_id`,`resource_id`);

--
-- 資料表索引 `userrole`
--
ALTER TABLE `userrole`
 ADD PRIMARY KEY (`user_id`,`role_id`), ADD UNIQUE KEY `userrole` (`user_id`,`role_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `resource`
--
ALTER TABLE `resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
