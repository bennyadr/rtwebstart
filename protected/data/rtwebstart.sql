-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.12 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.1.0.4545
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table rtwebstart.rtw_user
DROP TABLE IF EXISTS `rtw_user`;
CREATE TABLE IF NOT EXISTS `rtw_user` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `birthdate` datetime NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `mobile_prefix` varchar(4) DEFAULT NULL,
  `mobile_number` varchar(7) DEFAULT NULL,
  `mobile_franchise` varchar(20) DEFAULT NULL,
  `mobile_account` set('POSTPAID','PREPAID') DEFAULT NULL,
  `verification_code` varchar(10) DEFAULT NULL,
  `is_verify` bit(1) NOT NULL DEFAULT b'0',
  `invitation_code` varchar(10) DEFAULT NULL,
  `is_login` bit(1) NOT NULL DEFAULT b'0',
  `last_login_time` datetime DEFAULT NULL,
  `acc_status` bit(1) NOT NULL DEFAULT b'0',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `invitation_code` (`invitation_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table rtwebstart.rtw_user: ~1 rows (approximately)
DELETE FROM `rtw_user`;
/*!40000 ALTER TABLE `rtw_user` DISABLE KEYS */;
INSERT INTO `rtw_user` (`uid`, `first_name`, `last_name`, `middle_name`, `birthdate`, `gender`, `email`, `username`, `mobile_prefix`, `mobile_number`, `mobile_franchise`, `mobile_account`, `verification_code`, `is_verify`, `invitation_code`, `is_login`, `last_login_time`, `acc_status`, `createdate`) VALUES
	(3, 'Rex', 'Cruz', NULL, '1987-03-03 00:00:00', 'm', 'cruz_rex87@yahoo.com.ph', NULL, NULL, NULL, NULL, NULL, NULL, b'0', NULL, b'0', NULL, b'1', '2013-12-03 06:03:12');
/*!40000 ALTER TABLE `rtw_user` ENABLE KEYS */;


-- Dumping structure for table rtwebstart.rtw_userattributes
DROP TABLE IF EXISTS `rtw_userattributes`;
CREATE TABLE IF NOT EXISTS `rtw_userattributes` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `address` text,
  PRIMARY KEY (`id`),
  KEY `FK1_userattributes_user_user_id` (`user_id`),
  CONSTRAINT `FK1_userattributes_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `rtw_user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table rtwebstart.rtw_userattributes: ~0 rows (approximately)
DELETE FROM `rtw_userattributes`;
/*!40000 ALTER TABLE `rtw_userattributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `rtw_userattributes` ENABLE KEYS */;


-- Dumping structure for table rtwebstart.rtw_usertype
DROP TABLE IF EXISTS `rtw_usertype`;
CREATE TABLE IF NOT EXISTS `rtw_usertype` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table rtwebstart.rtw_usertype: ~2 rows (approximately)
DELETE FROM `rtw_usertype`;
/*!40000 ALTER TABLE `rtw_usertype` DISABLE KEYS */;
INSERT INTO `rtw_usertype` (`id`, `user_type`, `level`) VALUES
	(1, 'USER', 1),
	(2, 'ADMIN', 2);
/*!40000 ALTER TABLE `rtw_usertype` ENABLE KEYS */;


-- Dumping structure for table rtwebstart.user_oauth
DROP TABLE IF EXISTS `user_oauth`;
CREATE TABLE IF NOT EXISTS `user_oauth` (
  `user_id` int(11) NOT NULL,
  `provider` varchar(45) NOT NULL,
  `identifier` varchar(64) NOT NULL,
  `profile_cache` text,
  `session_data` text,
  PRIMARY KEY (`provider`,`identifier`),
  UNIQUE KEY `unic_user_id_name` (`user_id`,`provider`),
  KEY `oauth_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table rtwebstart.user_oauth: ~1 rows (approximately)
DELETE FROM `user_oauth`;
/*!40000 ALTER TABLE `user_oauth` DISABLE KEYS */;
INSERT INTO `user_oauth` (`user_id`, `provider`, `identifier`, `profile_cache`, `session_data`) VALUES
	(3, 'Facebook', '1434867496', 'a:22:{s:10:"identifier";s:10:"1434867496";s:10:"webSiteURL";s:22:"www.zurcxer.devhub.com";s:10:"profileURL";s:32:"https://www.facebook.com/zurcxer";s:8:"photoURL";s:66:"https://graph.facebook.com/1434867496/picture?width=150&height=150";s:11:"displayName";s:8:"Rex Cruz";s:11:"description";s:0:"";s:9:"firstName";s:3:"Rex";s:8:"lastName";s:4:"Cruz";s:6:"gender";s:4:"male";s:8:"language";N;s:3:"age";N;s:8:"birthDay";i:3;s:10:"birthMonth";i:3;s:9:"birthYear";i:1987;s:5:"email";s:23:"cruz_rex87@yahoo.com.ph";s:13:"emailVerified";s:23:"cruz_rex87@yahoo.com.ph";s:5:"phone";N;s:7:"address";N;s:7:"country";N;s:6:"region";s:16:"Baliuag, Bulacan";s:4:"city";N;s:3:"zip";N;}', 'a:2:{s:35:"hauth_session.facebook.is_logged_in";s:4:"i:1;";s:41:"hauth_session.facebook.token.access_token";s:191:"s:182:"CAAFVu8qSnEUBAGFEYWZCXaEcYJQQQCkqLtYSVd0xtAsFiXawMmW5mrJZA1vUMBIef7FaedrNUuNSB8AbwZASVZAjMyuNSKxIGnSn2RpVDwgCxqQo1DxIJrgyXTQlFgbCuuFmZABBg8374fxisjFSXwU6Lhe2rDjQFxfhPe2JpQbFjhO9XuYJi";";}');
/*!40000 ALTER TABLE `user_oauth` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
