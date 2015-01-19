<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_203944_old_project_db_structure extends Migration {

    public function up() {
        $sql = <<<SQL
-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2015 at 08:50 AM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Table structure for table `account`
--
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` enum('income','expense','money','credit','creditcard','invest','card') NOT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'RUR',
  `title` varchar(255) NOT NULL,
  `parent_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  KEY `currency` (`currency`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `currency`
--
CREATE TABLE IF NOT EXISTS `currency` (
  `id` varchar(5) NOT NULL,
  `title` varchar(64) NOT NULL,
  `format` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `currency_course`
--
CREATE TABLE IF NOT EXISTS `currency_course` (
  `in_currency` varchar(5) NOT NULL,
  `out_currency` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `expense`
--
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `comment` text NOT NULL,
  `economy` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `expense_account`
--
CREATE TABLE IF NOT EXISTS `expense_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `sum` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `income_id` (`expense_id`,`account_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Table structure for table `expense_pay`
--
CREATE TABLE IF NOT EXISTS `expense_pay` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `qty` decimal(12,4) NOT NULL DEFAULT '1.0000',
  `sum` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `income_id` (`expense_id`,`account_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Table structure for table `income`
--
CREATE TABLE IF NOT EXISTS `income` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Table structure for table `income_account`
--
CREATE TABLE IF NOT EXISTS `income_account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `income_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `sum` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `income_id` (`income_id`,`account_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Table structure for table `month`
--
CREATE TABLE IF NOT EXISTS `month` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `month` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`month`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Table structure for table `plan`
--
CREATE TABLE IF NOT EXISTS `plan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `sum` decimal(12,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Table structure for table `starting`
--
CREATE TABLE IF NOT EXISTS `starting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `sum` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id` (`account_id`,`date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Table structure for table `transfer`
--
CREATE TABLE IF NOT EXISTS `transfer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `source` int(10) unsigned NOT NULL,
  `out_sum` decimal(10,2) NOT NULL,
  `dest` int(10) unsigned NOT NULL,
  `in_sum` decimal(10,2) NOT NULL,
  `ratio` decimal(10,6) NOT NULL,
  `comission` decimal(10,2) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `source` (`source`),
  KEY `dest` (`dest`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
-- --------------------------------------------------------
--
-- Constraints for dumped tables
--
--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `account_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `account_ibfk_4` FOREIGN KEY (`currency`) REFERENCES `currency` (`id`);
--
-- Constraints for table `expense_account`
--
ALTER TABLE `expense_account`
  ADD CONSTRAINT `expense_account_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `expense_account_ibfk_2` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`id`);
--
-- Constraints for table `expense_pay`
--
ALTER TABLE `expense_pay`
  ADD CONSTRAINT `expense_pay_ibfk_1` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`id`),
  ADD CONSTRAINT `expense_pay_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);
--
-- Constraints for table `income_account`
--
ALTER TABLE `income_account`
  ADD CONSTRAINT `income_account_ibfk_1` FOREIGN KEY (`income_id`) REFERENCES `income` (`id`),
  ADD CONSTRAINT `income_account_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);
--
-- Constraints for table `month`
--
ALTER TABLE `month`
  ADD CONSTRAINT `month_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);
--
-- Constraints for table `starting`
--
ALTER TABLE `starting`
  ADD CONSTRAINT `starting_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`);
--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `transfer_ibfk_1` FOREIGN KEY (`source`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `transfer_ibfk_2` FOREIGN KEY (`dest`) REFERENCES `account` (`id`);
SQL;
        $this->execute($sql);
    }

    public function down() {
        $sql = "DROP TABLE `account`, `currency`, `currency_course`, `expense`, `expense_account`, `expense_pay`, `income`, `income_account`, `month`, `plan`, `starting`, `transfer`;";
        $this->execute($sql);
    }

}
