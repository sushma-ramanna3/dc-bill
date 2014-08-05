-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 05, 2014 at 02:48 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ksda_dc_billingapplication`
--

-- --------------------------------------------------------

--
-- Table structure for table `mstdistrict`
--

CREATE TABLE IF NOT EXISTS `mstdistrict` (
  `intDistrictID` int(11) NOT NULL AUTO_INCREMENT,
  `txtDistrictName` varchar(45) NOT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`intDistrictID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstdistrict`
--

INSERT INTO `mstdistrict` (`intDistrictID`, `txtDistrictName`, `flgisActive`) VALUES
(1, 'Mandya', 1),
(2, 'Mysore', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mstdoctype`
--

CREATE TABLE IF NOT EXISTS `mstdoctype` (
  `intDocTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `txtDocumentType` varchar(30) NOT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`intDocTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstdoctype`
--

INSERT INTO `mstdoctype` (`intDocTypeID`, `txtDocumentType`, `flgisActive`) VALUES
(1, 'Photo', 1),
(2, 'ID Proof', 2);

-- --------------------------------------------------------

--
-- Table structure for table `msthoblirsk`
--

CREATE TABLE IF NOT EXISTS `msthoblirsk` (
  `intHobliRSKID` int(11) NOT NULL AUTO_INCREMENT,
  `intTalukID` int(11) NOT NULL,
  `txtHobliRSK` varchar(40) NOT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`intHobliRSKID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `msthoblirsk`
--

INSERT INTO `msthoblirsk` (`intHobliRSKID`, `intTalukID`, `txtHobliRSK`, `flgisActive`) VALUES
(1, 1, 'Alur', 1),
(2, 2, 'Kasaba', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mstmanufacturer`
--

CREATE TABLE IF NOT EXISTS `mstmanufacturer` (
  `intManuID` int(11) NOT NULL AUTO_INCREMENT,
  `intProdID` int(11) NOT NULL,
  `txtManufacturerName` varchar(100) NOT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intManuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstmanufacturer`
--

INSERT INTO `mstmanufacturer` (`intManuID`, `intProdID`, `txtManufacturerName`, `txtRemarks`, `flgisActive`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 1, 'MAC_prod1', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'manu_prod2', NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mstmodel`
--

CREATE TABLE IF NOT EXISTS `mstmodel` (
  `intModelID` int(11) NOT NULL AUTO_INCREMENT,
  `intManuID` int(11) NOT NULL,
  `txtModelName` varchar(100) NOT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intModelID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstmodel`
--

INSERT INTO `mstmodel` (`intModelID`, `intManuID`, `txtModelName`, `txtRemarks`, `flgisActive`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 1, 'mod_manu1', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'mod-manu2', NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mstproductname`
--

CREATE TABLE IF NOT EXISTS `mstproductname` (
  `intProdID` int(11) NOT NULL AUTO_INCREMENT,
  `txtProdName` varchar(100) NOT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intProdID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstproductname`
--

INSERT INTO `mstproductname` (`intProdID`, `txtProdName`, `txtRemarks`, `flgisActive`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 'prod1', 'product1', 1, NULL, NULL, NULL, NULL, NULL),
(2, 'PROD2', 'txtbeneficiaryname', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mstrateconfiguration`
--

CREATE TABLE IF NOT EXISTS `mstrateconfiguration` (
  `intRateConfID` int(11) NOT NULL AUTO_INCREMENT,
  `intProdID` int(11) NOT NULL,
  `intManuID` int(11) NOT NULL,
  `intModelID` int(11) NOT NULL,
  `intSpecification` int(11) NOT NULL,
  `decFullRate` decimal(10,0) NOT NULL,
  `decFarmerShare` decimal(10,0) NOT NULL,
  `decGovtShare` decimal(10,0) NOT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intRateConfID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstrateconfiguration`
--

INSERT INTO `mstrateconfiguration` (`intRateConfID`, `intProdID`, `intManuID`, `intModelID`, `intSpecification`, `decFullRate`, `decFarmerShare`, `decGovtShare`, `txtRemarks`, `flgisActive`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 1, 1, 1, 1, 30000, 10000, 15000, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 2, 2, 2, 50000, 20000, 30000, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mstspecification`
--

CREATE TABLE IF NOT EXISTS `mstspecification` (
  `intSpecID` int(11) NOT NULL AUTO_INCREMENT,
  `intModelID` int(11) NOT NULL,
  `txtSpecification` varchar(100) NOT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intSpecID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mstspecification`
--

INSERT INTO `mstspecification` (`intSpecID`, `intModelID`, `txtSpecification`, `txtRemarks`, `flgisActive`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 1, 'spec_mod1', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'spec_mod2', NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msttaluk`
--

CREATE TABLE IF NOT EXISTS `msttaluk` (
  `intTalukID` int(11) NOT NULL AUTO_INCREMENT,
  `txtTalukName` varchar(45) NOT NULL,
  `intDistrictID` int(11) NOT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`intTalukID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `msttaluk`
--

INSERT INTO `msttaluk` (`intTalukID`, `txtTalukName`, `intDistrictID`, `flgisActive`) VALUES
(1, 'Maddur', 1, 1),
(2, 'Kodagu', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mstunitofmeasure`
--

CREATE TABLE IF NOT EXISTS `mstunitofmeasure` (
  `intUomID` int(11) NOT NULL AUTO_INCREMENT,
  `txtUOM` varchar(40) NOT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`intUomID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mstunitofmeasure`
--

INSERT INTO `mstunitofmeasure` (`intUomID`, `txtUOM`, `flgisActive`) VALUES
(1, 'kg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trnbeneficiary`
--

CREATE TABLE IF NOT EXISTS `trnbeneficiary` (
  `BeneID` int(11) NOT NULL AUTO_INCREMENT,
  `txtbeneficiaryname` varchar(100) NOT NULL,
  `txtbeneAddress` varchar(300) DEFAULT NULL,
  `txtbeneState` varchar(20) NOT NULL,
  `intbeneDistrict` int(11) NOT NULL,
  `intbeneTaluk` int(11) NOT NULL,
  `intbeneRSK` int(11) NOT NULL,
  `intbenePinCode` int(11) NOT NULL,
  `txtbeneContactNo` varchar(15) DEFAULT NULL,
  `dtdateofBirth` varchar(75) NOT NULL,
  `intbeneAge` int(11) NOT NULL,
  `txtbeneSex` varchar(15) NOT NULL,
  `intbeneCategory` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `intbeneModeofPayment` int(11) DEFAULT NULL,
  `txtbeneDDChequeNo` varchar(30) DEFAULT NULL,
  `flgbeneisAmountRemitted` tinyint(1) DEFAULT NULL,
  `intbeneAmtReceived` decimal(10,0) DEFAULT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL DEFAULT '1',
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`BeneID`),
  KEY `FX_District_idx` (`intbeneDistrict`),
  KEY `FK_Taluk_idx` (`intbeneTaluk`),
  KEY `FK_RSK_idx` (`intbeneRSK`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `trnbeneficiary`
--

INSERT INTO `trnbeneficiary` (`BeneID`, `txtbeneficiaryname`, `txtbeneAddress`, `txtbeneState`, `intbeneDistrict`, `intbeneTaluk`, `intbeneRSK`, `intbenePinCode`, `txtbeneContactNo`, `dtdateofBirth`, `intbeneAge`, `txtbeneSex`, `intbeneCategory`, `created_at`, `updated_at`, `intbeneModeofPayment`, `txtbeneDDChequeNo`, `flgbeneisAmountRemitted`, `intbeneAmtReceived`, `txtRemarks`, `flgisActive`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 'test msnabf', 'kasfkjk', 'KA', 2, 2, 2, 123123, '9325372523', '05-08-2014', 25, 'male', 1, '2014-08-03 18:05:57', '2014-08-03 18:05:57', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(2, 'testjhgjdfm jsbfdj', 'mbbbdf', 'Karnataka', 1, 1, 1, 432423, '3559943534', '05-08-2014', 25, 'female', 2, '2014-08-03 19:24:57', '2014-08-03 19:24:57', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(3, 'testjhgjdfm jsbfdj', 'mbbbdf', 'Karnataka', 1, 1, 1, 432423, '3559943534', '05-08-2014', 25, 'female', 2, '2014-08-03 19:26:29', '2014-08-03 19:26:29', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(4, 'testjhgjdfm jsbfdj', 'mbbbdf', 'Karnataka', 1, 1, 1, 432423, '3559943534', '05-08-2014', 25, 'female', 2, '2014-08-03 19:27:27', '2014-08-03 19:27:27', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(5, 'jdjkg fkj skdkjwe', 'asdvjwafk', 'Karnataka', 1, 1, 1, 234572, '3495952094', '12-08-2014', 25, 'male', 2, '2014-08-03 19:29:10', '2014-08-03 19:29:10', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(6, 'dsgdsgf dsgdsg', 'xcvxvxcvxc', 'Karnataka', 1, 1, 1, 353253, '5435435435', '18-07-2012', 2, 'male', 1, '2014-08-05 07:19:27', '2014-08-05 07:19:27', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(7, 'dsgdsgf dsgdsg', 'dsfdsfdsf', 'Karnataka', 2, 2, 2, 454354, '5454545433', '08-07-2014', 0, 'male', 1, '2014-08-05 07:23:41', '2014-08-05 07:23:41', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(8, 'fdg fdg', '6hgdfgdfg', 'Karnataka', 1, 1, 1, 456456, '43456745', '11-08-2014', -1, 'male', 1, '2014-08-05 08:35:17', '2014-08-05 08:35:17', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(9, 'dsgdsgf Name', 'yttry', 'Karnataka', 1, 1, 1, 456546, '5454545454', '30-07-2014', 0, 'female', 1, '2014-08-05 08:36:51', '2014-08-05 08:36:51', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10, 'dsgdsgf dsgdsg', 'asfsadf', 'Karnataka', 1, 1, 1, 324346, '5454545433', '12-08-2014', -1, 'female', 1, '2014-08-05 08:42:29', '2014-08-05 08:42:29', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(11, 'gfdg fdg', 'dfgfdg', 'Karnataka', 1, 1, 1, 435454, '5454545454', '04-08-2014', 0, 'male', 1, '2014-08-05 08:43:52', '2014-08-05 08:43:52', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(12, 'dsfds fdsf', 'dsfdsf', 'Karnataka', 1, 1, 1, 354324, '5454545433', '03-08-2014', 0, 'female', 2, '2014-08-05 08:46:15', '2014-08-05 08:46:15', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(13, 'dsfdsf dsf', 'safddsf', 'Karnataka', 1, 1, 1, 570001, '5454545433', '21-08-2014', -1, 'male', 3, '2014-08-05 08:48:40', '2014-08-05 08:48:40', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(14, 'dsfdsf Name', 'dsf', 'Karnataka', 1, 1, 1, 435435, '5454545454', '15-08-2014', -1, 'female', 2, '2014-08-05 08:54:16', '2014-08-05 08:54:16', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(15, 'Test Name', 'asfdas', 'Karnataka', 1, 1, 1, 343243, '5454545433', '06-08-2014', -1, 'female', 2, '2014-08-05 08:56:29', '2014-08-05 08:56:29', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(16, 'dsgdsgf Name', 'j;j', 'Karnataka', 1, 1, 1, 435435, '5323201021', '30-07-2014', 0, 'male', 2, '2014-08-05 08:59:08', '2014-08-05 08:59:08', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(17, 'dsgdsgf hlkj', 'iou', 'Karnataka', 1, 1, 1, 324324, '2453241534', '28-07-2014', 0, 'male', 2, '2014-08-05 09:02:22', '2014-08-05 09:02:22', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(18, 'dsf ljlae', 'asfd', 'Karnataka', 1, 1, 1, 343243, '5454545433', '05-08-2014', 0, 'male', 1, '2014-08-05 09:04:01', '2014-08-05 09:04:01', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(19, 'dsfdsf jljl', 'dsf', 'Karnataka', 1, 1, 1, 343243, '1234561212', '06-08-2014', -1, 'female', 2, '2014-08-05 09:10:53', '2014-08-05 09:10:53', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL),
(20, 'asdfdsk kkk', 'dsfsrf', 'Karnataka', 2, 2, 2, 256356, '2453241534', '27-08-2014', -1, 'male', 1, '2014-08-05 09:15:52', '2014-08-05 09:12:08', 1, '35252525252', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trnbeneficiarydocuments`
--

CREATE TABLE IF NOT EXISTS `trnbeneficiarydocuments` (
  `intbeneDocID` int(11) NOT NULL AUTO_INCREMENT,
  `intbeneID` int(11) NOT NULL,
  `intDocType` int(11) NOT NULL,
  `flgDocUploaded` tinyint(1) NOT NULL,
  `txtDocPath` varchar(50) NOT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intbeneDocID`),
  KEY `FK_BeneID_idx` (`intbeneID`),
  KEY `FK_DocType_idx` (`intDocType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `trnbeneficiarydocuments`
--

INSERT INTO `trnbeneficiarydocuments` (`intbeneDocID`, `intbeneID`, `intDocType`, `flgDocUploaded`, `txtDocPath`, `txtRemarks`, `flgisActive`, `created_at`, `updated_at`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(3, 20, 1, 1, '/var/www/projects/dc/app/views/photos/20_140723003', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trnbeneficiaryproddetails`
--

CREATE TABLE IF NOT EXISTS `trnbeneficiaryproddetails` (
  `intbeneProdID` int(11) NOT NULL AUTO_INCREMENT,
  `intbeneID` int(11) NOT NULL,
  `intProdID` int(11) NOT NULL,
  `intManufacturerID` int(11) NOT NULL,
  `intModelID` int(11) NOT NULL,
  `intSpecID` int(11) NOT NULL,
  `decFullRate` decimal(10,0) NOT NULL,
  `decGovtShare` decimal(10,0) NOT NULL,
  `decFarmerShare` decimal(10,0) NOT NULL,
  `intQty` int(11) NOT NULL,
  `intUnitofMeasure` int(11) NOT NULL,
  `flgisActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `txtRemarks` varchar(350) DEFAULT NULL,
  `txtField1` varchar(50) DEFAULT NULL,
  `txtField2` varchar(50) DEFAULT NULL,
  `txtField3` varchar(50) DEFAULT NULL,
  `txtField4` varchar(50) DEFAULT NULL,
  `txtField5` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`intbeneProdID`),
  KEY `FK_BeneId_idx` (`intbeneID`),
  KEY `FK_Prod_idx` (`intProdID`),
  KEY `FK_Model_idx` (`intModelID`),
  KEY `FK_Manuf_idx` (`intManufacturerID`),
  KEY `FK_Spec_idx` (`intSpecID`),
  KEY `FK_UOM_idx` (`intUnitofMeasure`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `trnbeneficiaryproddetails`
--

INSERT INTO `trnbeneficiaryproddetails` (`intbeneProdID`, `intbeneID`, `intProdID`, `intManufacturerID`, `intModelID`, `intSpecID`, `decFullRate`, `decGovtShare`, `decFarmerShare`, `intQty`, `intUnitofMeasure`, `flgisActive`, `created_at`, `updated_at`, `txtRemarks`, `txtField1`, `txtField2`, `txtField3`, `txtField4`, `txtField5`) VALUES
(1, 13, 1, 1, 1, 1, 30000, 15000, 10000, 3, 1, 1, '2014-08-05 08:51:30', '2014-08-05 08:51:30', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 14, 2, 2, 2, 2, 50000, 30000, 20000, 56, 1, 1, '2014-08-05 08:54:25', '2014-08-05 08:54:25', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 15, 2, 2, 2, 2, 50000, 30000, 20000, 536, 1, 1, '2014-08-05 08:56:38', '2014-08-05 08:56:38', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 16, 1, 1, 1, 1, 30000, 15000, 10000, 34, 1, 1, '2014-08-05 08:59:15', '2014-08-05 08:59:15', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 17, 1, 1, 1, 1, 30000, 15000, 10000, 25, 1, 1, '2014-08-05 09:02:31', '2014-08-05 09:02:31', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 18, 1, 1, 1, 1, 30000, 15000, 10000, 25, 1, 1, '2014-08-05 09:04:10', '2014-08-05 09:04:10', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 19, 2, 2, 2, 2, 50000, 30000, 20000, 6, 1, 1, '2014-08-05 09:11:01', '2014-08-05 09:11:01', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 20, 1, 1, 1, 1, 30000, 15000, 10000, 25, 1, 1, '2014-08-05 09:12:15', '2014-08-05 09:12:15', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `usertype`, `email`, `password`, `phone`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'admin1', 'admin', 'admin', 'admin@abc.com', '$2y$10$qmoFnmRyLqvOQ80R0cSRz.Pf/QiyP3md2lJAY4q3QOEDnO2.u6nRK', 1234567890, 'Mysore', '47OROgathyESGcCYjWCFvBYhZyxlCTsBxtIxj15HknK7dWlG35qhk93QC17W', '2014-07-09 10:37:06', '2014-07-30 09:21:58'),
(6, 'super', 'admin', 'kiosk', 'kiosk@abc.com', '$2y$10$qmoFnmRyLqvOQ80R0cSRz.Pf/QiyP3md2lJAY4q3QOEDnO2.u6nRK', 0, '', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trnbeneficiary`
--
ALTER TABLE `trnbeneficiary`
  ADD CONSTRAINT `FK_RSK` FOREIGN KEY (`intbeneRSK`) REFERENCES `msthoblirsk` (`intHobliRSKID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Taluk` FOREIGN KEY (`intbeneTaluk`) REFERENCES `msttaluk` (`intTalukID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FX_District` FOREIGN KEY (`intbeneDistrict`) REFERENCES `mstdistrict` (`intDistrictID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trnbeneficiarydocuments`
--
ALTER TABLE `trnbeneficiarydocuments`
  ADD CONSTRAINT `FK_BeneficiaryID` FOREIGN KEY (`intbeneID`) REFERENCES `trnbeneficiary` (`BeneID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_DocType` FOREIGN KEY (`intDocType`) REFERENCES `mstdoctype` (`intDocTypeID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trnbeneficiaryproddetails`
--
ALTER TABLE `trnbeneficiaryproddetails`
  ADD CONSTRAINT `FK_BeneId` FOREIGN KEY (`intbeneID`) REFERENCES `trnbeneficiary` (`BeneID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Manuf` FOREIGN KEY (`intManufacturerID`) REFERENCES `mstmanufacturer` (`intManuID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Model` FOREIGN KEY (`intModelID`) REFERENCES `mstmodel` (`intModelID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Prod` FOREIGN KEY (`intProdID`) REFERENCES `mstproductname` (`intProdID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Spec` FOREIGN KEY (`intSpecID`) REFERENCES `mstspecification` (`intSpecID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_UOM` FOREIGN KEY (`intUnitofMeasure`) REFERENCES `mstunitofmeasure` (`intUomID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
