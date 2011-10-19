SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `res_blackouts` (
  `blackout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `comments` longtext NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`blackout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `res_equipment` (
  `equip_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `serial` mediumtext NOT NULL,
  `description` longtext NOT NULL,
  `max_length` int(11) NOT NULL,
  `picture` text NOT NULL,
  `min_user_level` int(11) NOT NULL,
  `checkoutfrom` int(11) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`equip_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `res_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `action_type` text NOT NULL,
  `action_description` longtext NOT NULL,
  `ip` varchar(15) NOT NULL,
  `hostname` text NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `res_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `body` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `res_reservations` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `equip_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `checked_out_by` int(11) NOT NULL,
  `check_out_date` date NOT NULL,
  `checked_in_by` int(11) NOT NULL,
  `check_in_date` date NOT NULL,
  `length` int(11) NOT NULL,
  `pickup_time` varchar(10) NOT NULL,
  `user_comment` longtext NOT NULL,
  `admin_comment` longtext NOT NULL,
  `mod_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`res_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `res_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `user_level` int(11) NOT NULL,
  `warnings` int(11) NOT NULL DEFAULT '0',
  `notes` longtext NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `student_id` (`student_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `res_warnings` (
  `warn_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `reason` longtext NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `time` datetime NOT NULL,
  PRIMARY KEY (`warn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
