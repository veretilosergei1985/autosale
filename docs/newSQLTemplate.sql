-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 05 2013 г., 18:15
-- Версия сервера: 5.5.31-0+wheezy1
-- Версия PHP: 5.4.4-14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `designhaus`
--
CREATE DATABASE IF NOT EXISTS `designhaus` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `designhaus`;

-- --------------------------------------------------------

--
-- Структура таблицы `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `award_text` varchar(255) NOT NULL,
  `is_visible` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `awards`
--

INSERT INTO `awards` (`id`, `award_text`, `is_visible`) VALUES
(1, 'Active member of The American Society of Interior Designers (ASID)', 'no'),
(2, 'Served on the Board of the Interior Design Legislative Coalition of Pennsylvania (IDLCPA)', 'yes'),
(3, 'Director of Communications in 2006 and 2007 for the Pennsylvania East Chapter of ASID', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `main_text` text NOT NULL,
  `flat_image` varchar(255) NOT NULL,
  `is_visible` enum('yes','no') NOT NULL DEFAULT 'yes',
  `main_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `main_text`, `flat_image`, `is_visible`, `main_image`) VALUES
(29, 'Dining & Entertainment', 'Dining & Entertainment', 'iphg5IrIz4BhDtx.jpg', 'yes', 'LeFZXfc6RYZBg5k.jpg'),
(30, 'Bedroom', 'Bedroom', 'erA95xMsjLIaHSs.jpg', 'yes', 'vSOG2vzHczDSvRq.jpg'),
(31, 'Kitchen & Bath', 'Kitchen & Bath', 'aVplaxm5j4gjOyH.jpg', 'yes', 'z7efBHeOjOIxSr8.jpg'),
(32, 'Living Space', 'Living Space', '0JuOkvNkBm6OfrF.jpg', 'yes', 'SWjL0KneBnJCZZD.jpg'),
(33, 'Show House', 'Show House', 'UkYyolJYLCAPT2R.jpg', 'yes', 'wdIMgG7vBDOFKyC.jpg'),
(34, 'Window Treatments', 'Window Treatments', 'BUmIFqhWdXlEAfJ.jpg', 'yes', 'BQ5zQut5iwJI2LY.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `designers`
--

CREATE TABLE IF NOT EXISTS `designers` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `person_description` text NOT NULL,
  `image_file` varchar(255) NOT NULL,
  `is_visible` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `designers`
--

INSERT INTO `designers` (`id`, `full_name`, `person_description`, `image_file`, `is_visible`) VALUES
(1, 'Vera Bahou', 'Vera Bahou, Allied ASID, began her career in 2001 upon graduating from Drexel University with a degree in Interior Design. Upon graduation she quickly joined County Linen Interiors in Doylestown, Pennsylvania where she handled fabric and color coordination and designed custom window treatments. In 2002, Vera moved to Fort Meyers Florida when presented with an opportunity to further her knowledge and experience in her career. There she joined Robb & Stucky Furniture & Interior Design and she designed project floor plans, selected furniture and specified fabrics, materials, flooring and finishes. Her previous design experience was very useful in her creation of extraordinary custom window treatments for the Robb & Stucky clientele.\r\n\r\nUpon returning to the Northeast in 2003 Vera joined Lowe''s Home Improvement in Princeton, New Jersey. She was responsible for the design and implementation of Kitchen and Bathroom remodeling for the company''s clients. Her work included all selection and specification of fixtures, flooring, finishes, materials and color schemes.\r\n\r\nWhile handling diverse projects in several cities Vera also started her own design firm in 2002 and named it DesignHaus Interiors (DHI). Here she was able to use her vast experience in her other positions and generated and developed design projects for residential and commercial clients.\r\n\r\nToday, Vera is an active member of her professional organization The American Society of Interior Designers (ASID). She continues to own and operate DHI where she creates a conceptual framework to fit the clients'' needs and develop a program for the scope of work. Vera consults with clients to develop the project while remaining in budget. She uses all facets of the design process from the vision for the project to documenting it with plans and selecting all materials and furnishings, fixtures, finishes and color schemes. Vera also oversees all the contractors and sub-contractors and monitors the projects implementation while assuring that the client is fully satisfied with the end results.\r\n\r\nVera is very passionate about design and her profession. Her goal is to provide visually creative solutions that become important components in people''s homes and create spaces, while satisfying her clients’ needs and maintaining the project budget.', '/public/images/designers/U4W0kPTZVuGNC1T.jpg', 'yes'),
(2, 'Vera Brezneva', 'Vera Bahou, Allied ASID, began her career in 2001 upon graduating from Drexel University with a degree in Interior Design. Upon graduation she quickly joined County Linen Interiors in Doylestown, Pennsylvania where she handled fabric and color coordination and designed custom window treatments. In 2002, Vera moved to Fort Meyers Florida when presented with an opportunity to further her knowledge and experience in her career. There she joined Robb & Stucky Furniture & Interior Design and she designed project floor plans, selected furniture and specified fabrics, materials, flooring and finishes. Her previous design experience was very useful in her creation of extraordinary custom window treatments for the Robb & Stucky clientele.\r\n\r\nUpon returning to the Northeast in 2003 Vera joined Lowe''s Home Improvement in Princeton, New Jersey. She was responsible for the design and implementation of Kitchen and Bathroom remodeling for the company''s clients. Her work included all selection and specification of fixtures, flooring, finishes, materials and color schemes.\r\n\r\nWhile handling diverse projects in several cities Vera also started her own design firm in 2002 and named it DesignHaus Interiors (DHI). Here she was able to use her vast experience in her other positions and generated and developed design projects for residential and commercial clients.\r\n\r\nToday, Vera is an active member of her professional organization The American Society of Interior Designers (ASID). She continues to own and operate DHI where she creates a conceptual framework to fit the clients'' needs and develop a program for the scope of work. Vera consults with clients to develop the project while remaining in budget. She uses all facets of the design process from the vision for the project to documenting it with plans and selecting all materials and furnishings, fixtures, finishes and color schemes. Vera also oversees all the contractors and sub-contractors and monitors the projects implementation while assuring that the client is fully satisfied with the end results.\r\n\r\nVera is very passionate about design and her profession. Her goal is to provide visually creative solutions that become important components in people''s homes and create spaces, while satisfying her clients’ needs and maintaining the project budget.', '/public/images/designers/AfU3PHSCpA1HelW.jpg', 'no');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(3) NOT NULL,
  `big_image` varchar(255) NOT NULL,
  `is_visible` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=358 ;

--
-- Дамп данных таблицы `gallery`
--

INSERT INTO `gallery` (`id`, `cat_id`, `big_image`, `is_visible`) VALUES
(285, 30, 'Lwzf7V3oS3eoFTW.jpg', 'yes'),
(286, 30, 'NkvkoJlHTiuw63u.jpg', 'yes'),
(287, 30, 'QsUC3B9hr2clzzN.jpg', 'yes'),
(288, 30, 'axcvBoYMmQp6ddk.jpg', 'yes'),
(289, 30, 'wpvczlLZsrzLBxt.jpg', 'yes'),
(290, 30, 'gG10NSwW4WB0lCD.jpg', 'yes'),
(291, 30, '27KaqIvhmfeMjhf.jpg', 'yes'),
(292, 30, 'OpRB0NTj3wxmpbG.jpg', 'yes'),
(293, 30, 'XMFfI1oQr52a44o.jpg', 'yes'),
(294, 30, 'toIbA950y0MKbO0.jpg', 'yes'),
(295, 30, 'VnSH4SiVUeq0tt0.jpg', 'yes'),
(296, 30, '4QM4YxdspyXCM1b.jpg', 'yes'),
(297, 31, 'cOHBt3dr01of9Cj.jpg', 'yes'),
(298, 31, '1jSyRXRrHg3vsT6.jpg', 'yes'),
(299, 31, 'LU7Ue2jrBmdtIVc.jpg', 'yes'),
(300, 31, 'suWOAPSo5KvuBGQ.jpg', 'yes'),
(301, 31, 'Hva03OmAokSxFsM.jpg', 'yes'),
(302, 31, 'zr2SBHu8h2s9abB.jpg', 'yes'),
(303, 31, 'pUlHGr7APBvExiz.jpg', 'yes'),
(304, 31, 'HO4aeHieqmDFyWD.jpg', 'yes'),
(305, 31, 'sVQytOpmSk3BeCj.jpg', 'yes'),
(306, 31, 'c8g7hlo29y4Fk3Y.jpg', 'yes'),
(307, 31, 'q2TpIzv6pXu72sZ.jpg', 'yes'),
(308, 31, 'hNHLG3v1GizLHNR.jpg', 'yes'),
(309, 31, 'ExVdcMFw98Nepnj.jpg', 'yes'),
(310, 31, '8qaNCiQpgvJwUPb.jpg', 'yes'),
(311, 31, 'i2uiT29pNVklmh0.jpg', 'yes'),
(312, 31, 'AfpVbSAFLqWtCfC.jpg', 'yes'),
(313, 31, 'LeZNHb8tbpz9E7C.jpg', 'yes'),
(314, 31, 'nGEdGJS5KRYSaEz.jpg', 'yes'),
(315, 31, 'eGiyMKqWvOBTFP2.jpg', 'yes'),
(316, 31, 'o1s3Eg3HuBJccRE.jpg', 'yes'),
(317, 31, 'rQrBgAoZeaCwBqH.jpg', 'yes'),
(318, 31, 'fGCCuvmAXdS7mZf.jpg', 'yes'),
(319, 31, 'sGP9PgAlpLopEF6.jpg', 'yes'),
(320, 31, 'qaJBVBDBwZLvwFY.jpg', 'yes'),
(321, 32, 'ZdTZeJ5DlZDKMT4.jpg', 'yes'),
(322, 32, 'FjNXefNRRp4aACX.jpg', 'yes'),
(323, 32, 'cahJxOeQHDwTyno.jpg', 'yes'),
(324, 32, '0XKYknmQr2ScDPi.jpg', 'yes'),
(325, 32, 'IpmxedO0sztV8mN.jpg', 'yes'),
(326, 32, '6rPmopKXPM3o6cO.jpg', 'yes'),
(327, 32, 'JPr9WL0pYdSixTa.jpg', 'yes'),
(328, 32, 'aPdZlXpYSArcP4S.jpg', 'yes'),
(329, 32, 'p1aI3O1zC66d7Q2.jpg', 'yes'),
(330, 32, 'N1s41TTCzXoyK6x.jpg', 'yes'),
(331, 32, 'n7mGItdaQXuZG0i.jpg', 'yes'),
(332, 32, 'qGd9kI96gfTAumN.jpg', 'yes'),
(333, 32, 'vTz71F9WjVyC6Hd.jpg', 'yes'),
(334, 32, 'eB0IW6Py4mSLyKm.jpg', 'yes'),
(335, 32, 'A33836NlZhr5K5M.jpg', 'yes'),
(336, 33, 'xkFm9YFham8G0Zk.jpg', 'yes'),
(337, 33, 'YjgHlPMSHWFCeBv.jpg', 'yes'),
(338, 33, 'WZT8nx681Hy095F.jpg', 'yes'),
(339, 33, 'P7oyxc9zVjZ3Jy0.jpg', 'yes'),
(340, 33, 'OJIcXY8ZpRNnByv.jpg', 'yes'),
(341, 33, 'HdATgVOnN0r1i88.jpg', 'yes'),
(342, 33, 'pTTZTV7Q95grNPq.jpg', 'yes'),
(343, 33, 'HWjlDn2lETIBEQD.jpg', 'yes'),
(344, 33, 'MMSnR4fUXsPZJ7y.jpg', 'yes'),
(345, 34, '88dQOcpQlIkSzIz.jpg', 'yes'),
(346, 34, 'kt2pedeFkBkAYvK.jpg', 'yes'),
(347, 34, 'J7qWhj2cSzEe8Q1.jpg', 'yes'),
(348, 34, 'TQaQI5O1PlK30LB.jpg', 'yes'),
(349, 34, 'dsDCteBLr8Qe5C6.jpg', 'yes'),
(350, 34, 'I0YK4cNZpMamEoT.jpg', 'yes'),
(351, 34, 'SmCiMKEg9qpW0wN.jpg', 'yes'),
(352, 34, '0TsugHqFgqf8JjL.jpg', 'yes'),
(353, 34, 'CKIicbvi85VE75v.jpg', 'yes'),
(354, 34, 'vwBjY0vOhOLQzGZ.jpg', 'yes'),
(355, 34, 'qVECThalggw58SU.jpg', 'yes'),
(356, 34, 'Nvg9EiuxCKXVHSm.jpg', 'yes'),
(357, 34, 'Gd7brOG7sYMwtIT.jpg', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `title`, `url`) VALUES
(1, 'Home', ''),
(2, 'About', 'about'),
(3, 'Portfolio', 'portfolio');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_group_of_pages` enum('yes','no') NOT NULL DEFAULT 'no',
  `external_link` varchar(255) DEFAULT NULL,
  `template_id` int(10) unsigned DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `is_default` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_visible` enum('yes','no') NOT NULL DEFAULT 'yes',
  `access_control` enum('anybody','students') NOT NULL DEFAULT 'anybody',
  `show_in_top_menu` enum('yes','no') NOT NULL DEFAULT 'no',
  `parent` int(10) unsigned DEFAULT NULL,
  `require_ssl` enum('yes','no') NOT NULL DEFAULT 'no',
  `position` int(10) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(10) unsigned NOT NULL,
  `with_password` enum('yes','no') NOT NULL DEFAULT 'no',
  `has_right` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=173 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `is_group_of_pages`, `external_link`, `template_id`, `url`, `meta_keywords`, `meta_description`, `title`, `content`, `is_default`, `is_visible`, `access_control`, `show_in_top_menu`, `parent`, `require_ssl`, `position`, `timestamp`, `with_password`, `has_right`) VALUES
(29, 'no', NULL, 4, '', '', '', 'Home', '<p>\r\n	<!--{$component.MainGallery}--></p>\r\n', 'yes', 'yes', 'students', 'yes', NULL, 'no', 32, 1344612447, 'no', 'yes'),
(110, 'no', NULL, 5, 'adult_leaders_directory', '', '', 'Adult Leaders Directory', '\r\n				<h3>\r\n					Adult Leaders Directory</h3>\r\n				<p>\r\n					Adult Leaders Directory</p>\r\n', 'no', 'yes', 'students', 'yes', 109, 'no', 0, 1330685320, 'no', 'yes'),
(111, 'no', NULL, 5, 'registered_youth', '', '', 'Registered Youth', '\r\n				<h3>\r\n					Registered Youth</h3>\r\n				<p>\r\n					Registered Youth</p>\r\n', 'no', 'yes', 'students', 'yes', 109, 'no', 1, 1330685366, 'no', 'yes'),
(112, 'no', NULL, 5, 'registration_form_online', '', '', 'Registration form online, saved to database via secure connection', '\r\n				<h3>\r\n					Registration form online, saved to database via secure connection</h3>\r\n				<p>\r\n					Registration form online, saved to database via secure connection</p>\r\n', 'no', 'yes', 'students', 'yes', 108, 'no', 2, 1330685417, 'no', 'yes'),
(113, 'no', NULL, 5, 'medical_and_photo', '', '', 'Medical and Photo Release Form', '<h3>\r\n	Medical and Photo Release Form</h3>\r\n<p>\r\n	Click <a href="/files/Files/StakeYMCampMedicalandPhotoReleaseForm2012.pdf" target="_blank">Medical and Photo Release Form (PDF)</a> to open and print this form.</p>\r\n\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n', 'no', 'yes', 'students', 'yes', 108, 'no', 0, 1330784222, 'no', 'yes'),
(115, 'no', NULL, 5, 'general_camp_information', '', '', 'General Camp Information', '\r\n				<h3>\r\n					General Camp Information</h3>\r\n				<p>\r\n					General Camp Information</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 0, 1330685441, 'no', 'yes'),
(116, 'no', NULL, 5, 'camp_rules', '', '', 'Camp Rules', '\r\n				<h3>\r\n					Camp Rules</h3>\r\n				<p>\r\n					Camp Rules</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 1, 1330685461, 'no', 'yes'),
(117, 'no', NULL, 5, 'equipment_list', '', '', 'Equipment List', '\r\n				<h3>\r\n					Equipment List</h3>\r\n				<p>\r\n					Equipment List</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 2, 1330685477, 'no', 'yes'),
(118, 'no', NULL, 5, 'first_aid', '', '', 'First Aid', '\r\n				<h3>\r\n					First Aid</h3>\r\n				<p>\r\n					First Aid</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 3, 1330685493, 'no', 'yes'),
(119, 'no', NULL, 5, 'meals', '', '', 'Meals', '\r\n				<h3>\r\n					Meals</h3>\r\n				<p>\r\n					Meals</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 4, 1330685506, 'no', 'yes'),
(120, 'no', NULL, 5, 'housing', '', '', 'Housing', '\r\n				<h3>\r\n					Housing</h3>\r\n				<p>\r\n					Housing</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 5, 1330685520, 'no', 'yes'),
(121, 'no', NULL, 5, 'camp_map', '', '', 'Camp Map', '<h3>\r\n	Camp Map</h3>\r\n<p>\r\n	Camp Map</p>\r\n', 'no', 'yes', 'students', 'yes', 114, 'no', 6, 1334764242, 'yes', 'yes'),
(123, 'no', NULL, 5, 'family_history', '', '', 'Family History', '\r\n				<h3>\r\n					Family History</h3>\r\n				<p>\r\n					Family History</p>\r\n', 'no', 'yes', 'students', 'yes', 122, 'no', 0, 1330685550, 'no', 'yes'),
(124, 'no', NULL, 5, 'group_activity', '', '', 'Group Activity', '\r\n				<h3>\r\n					Group Activity</h3>\r\n				<p>\r\n					Group Activity</p>\r\n', 'no', 'yes', 'students', 'yes', 122, 'no', 1, 1330685668, 'no', 'yes'),
(125, 'no', NULL, 5, 'high_adventure', '', '', 'High Adventure', '\r\n				<h3>\r\n					High Adventure</h3>\r\n				<p>\r\n					High Adventure</p>\r\n', 'no', 'yes', 'students', 'yes', 122, 'no', 2, 1330685568, 'no', 'yes'),
(126, 'no', NULL, 5, 'on_site_activities', '', '', 'On-site Activities', '\r\n				<h3>\r\n					On-site Activities</h3>\r\n				<p>\r\n					On-site Activities</p>\r\n', 'no', 'yes', 'students', 'yes', 122, 'no', 3, 1330685585, 'no', 'yes'),
(127, 'no', NULL, 5, 'service', '', '', 'Service', '\r\n				<h3>\r\n					Service</h3>\r\n				<p>\r\n					Service</p>\r\n', 'no', 'yes', 'students', 'yes', 122, 'no', 4, 1330685596, 'no', 'yes'),
(128, 'no', NULL, 5, 'spiritual', '', '', 'Spiritual', '\r\n				<h3>\r\n					Spiritual</h3>\r\n				<p>\r\n					Spiritual</p>\r\n', 'no', 'yes', 'students', 'yes', 122, 'no', 5, 1330685612, 'no', 'yes'),
(131, 'no', NULL, 5, 'map_to_the_camp', '', '', 'Map to the Camp', '\r\n				<h3>\r\n					Map to the Camp</h3>\r\n				<p>\r\n					Map to the Camp</p>\r\n				<p>\r\n					&nbsp;</p>\r\n', 'no', 'yes', 'students', 'yes', 96, 'no', 0, 1330685633, 'no', 'yes'),
(135, 'no', NULL, 4, 'cctv', '', '', 'cctv', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 162, 'no', 26, 1343213998, 'no', 'no'),
(136, 'no', NULL, 4, 'contact', '', '', 'Contact', '', 'no', 'yes', 'students', 'yes', NULL, 'no', 37, 1344946312, 'no', 'yes'),
(139, 'no', NULL, 4, 'team', '', '', 'team', '\r\n	<div class="headline">\r\n		<h2>\r\n			Meet The Team</h2>\r\n	</div>\r\n	<!--{$component.MeetTeam}-->', 'no', 'yes', 'students', 'yes', 164, 'no', 30, 1343214836, 'no', 'no'),
(142, 'no', NULL, 4, 'risk-management', '', '', 'risk-management', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 148, 'no', 33, 1343214009, 'no', 'no'),
(143, 'no', NULL, 4, 'uniformed_guards', '', '', 'uniformed guards', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho <img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 141, 'no', 0, 1343213926, 'no', 'no'),
(144, 'no', NULL, 4, 'rsa_staff', '', '', 'rsa staff', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho<br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 141, 'no', 1, 1343213935, 'no', 'no'),
(145, 'no', NULL, 4, 'first_aid_medics', '', '', 'first aid medics', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho<br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 141, 'no', 2, 1343213941, 'no', 'no'),
(146, 'no', NULL, 4, 'traffic_control', '', '', 'traffic control', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho<br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 141, 'no', 3, 1343213949, 'no', 'no'),
(147, 'no', NULL, 4, 'promotional_staff', '', '', 'promotional staff', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho<br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 141, 'no', 4, 1343213955, 'no', 'no'),
(149, 'no', NULL, 4, 'venue_assessment', '', '', 'venue assessment', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 148, 'no', 34, 1343214015, 'no', 'no'),
(150, 'no', NULL, 4, 'logistic_reports', '', '', 'logistic reports', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 148, 'no', 35, 1343214021, 'no', 'no'),
(151, 'no', NULL, 4, 'planning', '', '', 'planning', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 148, 'no', 36, 1343214437, 'no', 'no'),
(153, 'no', NULL, 4, 'protocols', '', '', 'protocols', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 148, 'no', 38, 1343214427, 'no', 'no'),
(155, 'no', NULL, 4, 'client_venue_training', '', '', 'client venue training', '<p>\r\n	HALO Security sup<img alt="" src="/files/Images/img11.jpg" style="width: 157px; height: 139px; float: left;" />ply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 154, 'no', 0, 1343214380, 'no', 'no'),
(156, 'no', NULL, 4, 'licensing', '', '', 'licensing', '<p>\r\n	HALO Security s<img alt="" src="/files/Images/img08.jpg" style="width: 157px; height: 140px; float: left;" />upply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 154, 'no', 1, 1343214367, 'no', 'no'),
(157, 'no', NULL, 4, 'accreditation', '', '', 'accreditation', '<p>\r\n	HALO Security s<img alt="" src="/files/Images/img08.jpg" style="width: 157px; height: 140px; float: left;" />upply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 154, 'no', 2, 1343214350, 'no', 'no'),
(158, 'no', NULL, 4, 'conflict_resolutions', '', '', 'conflict resolutions', '<p>\r\n	HALO Security s<img alt="" src="/files/Images/img08.jpg" style="width: 157px; height: 140px; float: left;" />upply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 154, 'no', 3, 1343214335, 'no', 'no'),
(159, 'no', NULL, 4, 'inductions', '', '', 'inductions', '<p>\r\n	HALO Security s<img alt="" src="/files/Images/img07.jpg" style="width: 157px; height: 139px; float: left;" />upply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues. These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment. RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue. HALO Staff are trained and well proficient in: The context of responsible service of alcohol in NSW The legislative framework for the responsible service of alcoho Alcohol Guidelines for low-risk drinking; and Strategies to prevent intoxication and under-age drinking Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 154, 'no', 4, 1343214320, 'no', 'yes'),
(160, 'no', NULL, 5, 'field_training', '', '', 'field training', '', 'no', 'yes', 'students', 'yes', 154, 'no', 5, 1342445649, 'no', 'yes'),
(161, 'no', NULL, 4, 'fire_wardens', '', '', 'fire wardens', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho<br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 141, 'no', 5, 1343213963, 'no', 'no'),
(163, 'no', NULL, 4, 'control_room', '', '', 'control_room', '<p>\r\n	HALO Security supply well trained and equipped RSA (Responsible Service of Alcohol) staff to ensure compliance with state and federal Liquor Licensing Laws at all Entertainment, Hospitality &amp; Licensed Venues.<br />\r\n	<br />\r\n	These staff members play a pivotal role in ensuring strict compliance to liquor licensing laws whilst maintaining a customer service focus. They not only provide an important safety role but enhance the venues community standing in ensuring the safety of their patrons and the surrounding environment.<br />\r\n	<br />\r\n	RSA staff can suit most venues and can work well in a high visibility and or covert manner. They are adaptable to most venue situations and are well trained to observe, detect and report without creating and or escalating an issue.<br />\r\n	HALO Staff are trained and well proficient in:<br />\r\n	The context of responsible service of alcohol in NSW<br />\r\n	The legislative framework for the responsible service of alcoho <img alt="" src="/files/Images/8.jpg" style="width: 200px; height: 114px; float: right;" /><br />\r\n	Alcohol Guidelines for low-risk drinking; and<br />\r\n	Strategies to prevent intoxication and under-age drinking<br />\r\n	Enquire about this service.</p>\r\n', 'no', 'yes', 'students', 'yes', 162, 'no', 0, 1343213992, 'no', 'no'),
(166, 'no', NULL, 4, 'about', '', '', 'About us', '<h2>\r\n	Our Services</h2>\r\n<article class="block">\r\n	<div class="img-holder">\r\n		<img alt="image description" height="240" src="/images/img10.jpg" width="300" /></div>\r\n	<div class="text-holder">\r\n		<h3>\r\n			About Designhaus Interiors</h3>\r\n		<p>\r\n			Designhaus Interiors Offers Residential &amp; Commercial design services.</p>\r\n		<h4>\r\n			Residential Services</h4>\r\n		<p>\r\n			Residential Services</p>\r\n		<p>\r\n			Designer will schedule an initial consultation with Client to gather information regarding the scope of the project. homeowner&#39;s needs, lifestyle, and design style preferences. This is the homeowner&#39;s opportunity to provide any information that would be helpful to the designer in generating ideas for a presentation of a fullscale design concept.</p>\r\n		<p>\r\n			Designer will schedule an initial consultation with Client to gather information regarding the scope of the project. homeowner&#39;s needs, lifestyle, and design style preferences. This is the homeowner&#39;s opportunity to provide any information that would be helpful to the designer in generating ideas for a presentation of a fullscale design concept.</p>\r\n		<p>\r\n			<a class="more" href="#">Click here to view presentation of my work</a></p>\r\n	</div>\r\n</article>\r\n<p>\r\n	&nbsp;</p>\r\n', 'no', 'yes', 'students', 'yes', NULL, 'no', 34, 1344946340, 'no', 'yes'),
(167, 'no', NULL, 4, 'company_description', '', '', 'Company Description', '<h2>\r\n	About Us / Company Description</h2>\r\n<article class="block">\r\n	<div class="img-holder">\r\n		<img alt="image description" src="/images/img18.jpg" /></div>\r\n	<div class="text-holder">\r\n		<h3>\r\n			DesignHaus Interiors Company Description</h3>\r\n		<p>\r\n			DesignHaus Interiors (DHI) is a full service interior design firm specializing in kitchen and bath interior design, space planning, custom window treatments and lighting, color and furnishing selections. Established in 2002, DHI has vast experience working on new construction and remodeling interior design projects ranging from 1,000 to over 5,000 square feet.</p>\r\n		<p>\r\n			DHI has worked on many residential projects with extensive experience in model homes and 55 and over communities and club houses. In addition to residential interior design, DHI has also worked on commercial projects, such as restaurants, lounges and offices.</p>\r\n		<p>\r\n			Owned and operated by Vera Bahou, Allied ASID, DesignHaus Interiors&rsquo; range of talents and projects vary in style from traditional to modern and everything in between. With access to abundant resources for instant staffing, fabrication, finishes and material vendors, DHI has the ability to work with the client to fully understand their needs. Whether working within a client&rsquo;s budget or specific design essentials, DesignHaus Interiors has the experience and talent to create the ideal interior design space.</p>\r\n	</div>\r\n</article>\r\n<p>\r\n	&nbsp;</p>\r\n', 'no', 'yes', 'students', 'yes', 166, 'no', 0, 1344948987, 'no', 'yes'),
(168, 'no', NULL, 4, 'testimonials', '', '', 'Testimonials', '<p>\r\n	<!--{$component.ClientsTestimonials}--></p>\r\n', 'no', 'yes', 'students', 'yes', 166, 'no', 1, 1344946382, 'no', 'yes'),
(169, 'no', NULL, 4, 'awards', '', '', 'Awards and Achievements', '<p>\r\n	<!--{$component.OurAwards}--></p>\r\n', 'no', 'yes', 'students', 'yes', 166, 'no', 2, 1344946414, 'no', 'yes'),
(170, 'no', NULL, 4, 'portfolio', '', '', 'Portfolio', '<p>\r\n	<!--{$component.Portfolio}--></p>\r\n', 'no', 'yes', 'students', 'yes', NULL, 'no', 36, 1344946452, 'no', 'yes'),
(171, 'no', NULL, 4, 'design_services', '', '', 'Design Services', '<h2>\r\n	Residential</h2>\r\n<article class="block">\r\n	<div class="sidebar">\r\n		<div class="list">\r\n			<ul>\r\n				<li>\r\n					Lorem ipsum dolor</li>\r\n				<li>\r\n					Consectetur adipiscing</li>\r\n				<li>\r\n					Integer nec odio</li>\r\n				<li>\r\n					Praesent libero</li>\r\n				<li>\r\n					Sed cursus ante</li>\r\n				<li>\r\n					Dapibus diam</li>\r\n				<li>\r\n					Sed nisi</li>\r\n				<li>\r\n					Nulla quis sem</li>\r\n			</ul>\r\n		</div>\r\n	</div>\r\n	<!--{$component.DesignServices}--></article>\r\n', 'no', 'yes', 'students', 'yes', NULL, 'no', 35, 1344946473, 'no', 'yes'),
(172, 'no', NULL, 4, 'meet_designer', '', '', 'Meet the Designer', '<p>\r\n	<!--{$component.OurDesigners}--></p>\r\n', 'no', 'yes', 'students', 'yes', 166, 'no', 3, 1344946439, 'no', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Site Administrator'),
(2, 'Content Moderator');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT '',
  `type` enum('text','email','integer','decimal') NOT NULL DEFAULT 'text',
  `description` varchar(255) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `type`, `description`, `value`) VALUES
(1, 'admin_email', 'email', 'Administrator''s email', 'Larry@MedTegra.com'),
(2, 'default_from_email', 'email', 'Default From email', 'info@gohalo.com.au'),
(3, 'meta_keywords', 'text', 'Meta Keywords', ''),
(4, 'meta_description', 'text', 'Meta Description', ''),
(5, 'default_page_size', 'integer', 'Default page size', '10'),
(6, 'google_analytics_code', 'text', 'Google Analytics javascript block', ''),
(10, 'mail_per_one_time', 'integer', 'Mail per one time', '50'),
(11, 'page_password', 'text', 'Page Password', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `tabs`
--

CREATE TABLE IF NOT EXISTS `tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `tabs`
--

INSERT INTO `tabs` (`id`, `title`, `path`, `order`) VALUES
(1, 'Layouts', 'layouts', 1),
(2, 'Pages', 'pages', 2),
(9, 'Settings', 'settings', 9),
(10, 'Users', 'users', 8),
(24, 'Designers', 'designers', 3),
(25, 'Testimonials', 'testimonials', 4),
(26, 'Awards', 'awards', 5),
(27, 'Categories', 'categories', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `is_default` enum('yes','no') NOT NULL DEFAULT 'no',
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `templates`
--

INSERT INTO `templates` (`id`, `name`, `content`, `is_default`, `timestamp`) VALUES
(4, 'MainLayout', '<!DOCTYPE html>\r\n<head>\r\n	<meta charset="utf-8">\r\n	<meta name="description" content="<!--{$settings.meta_description}-->"/>\r\n	<meta name="keywords" content="<!--{$settings.meta_keywords}-->" />\r\n	<title>Design Haus Interiors</title>\r\n	\r\n	<link media="all" href="<!--{$site_url_rel}-->public/stylesheets/all.css?<!--{$timestp}-->" rel="stylesheet" type="text/css" />\r\n        <link media="all" href="<!--{$site_url_rel}-->public/stylesheets/jquery.ad-gallery.css?<!--{$timestp}-->" rel="stylesheet" type="text/css" />\r\n	<!--[if lt IE 9]><script src="<!--{$site_url_rel}-->public/js/html5.js" type="text/javascript"></script><![endif]-->\r\n	<!--[if lt IE 9]><link href="<!--{$site_url_rel}-->public/stylesheets/ie.css?<!--{$timestp}-->" rel="stylesheet" type="text/css" /><![endif]-->\r\n\r\n\r\n	<script src="<!--{$site_url_rel}-->public/js/jquery-1.7.2.min.js" type="text/javascript"></script>\r\n	<script src="<!--{$site_url_rel}-->public/js/jquery.easing.1.3.js" type="text/javascript"></script>\r\n	<script src="<!--{$site_url_rel}-->public/js/jquery.nivo.slider.js" type="text/javascript"></script>\r\n       <script src="<!--{$site_url_rel}-->public/js/jquery.uploadify.v2.1.0.min.js" type="text/javascript"></script>\r\n	<script type="text/javascript" src="<!--{$site_url_rel}-->public/js/menu.js"></script>\r\n        <script type="text/javascript" src="<!--{$site_url_rel}-->public/js/jquery.ad-gallery.min.js"></script>\r\n		\r\n</head>\r\n<body>\r\n	<div class="wrapper main-page">\r\n		<header>\r\n			<h1 class="logo"><a href="#">Design House Interiors</a></h1>\r\n			<!--{$component.MainMenu}-->\r\n		</header>\r\n		<section class="main">\r\n                    <!--{$content}--> \r\n		</section>\r\n		<footer>\r\n			(215) 534-0681 <br />\r\n			<a href="mailto:&#118;&#101;&#114;&#097;&#098;&#097;&#104;&#111;&#117;&#064;&#103;&#109;&#097;&#105;&#108;&#046;&#099;&#111;&#109;">&#118;&#101;&#114;&#097;&#098;&#097;&#104;&#111;&#117;&#064;&#103;&#109;&#097;&#105;&#108;&#046;&#099;&#111;&#109;</a>\r\n			<span>DesignHaus Interiors 2009</span>\r\n		</footer>\r\n	</div>\r\n	<script>\r\n     $(document).ready(function(){\r\n	   $(''#slider'').nivoSlider({\r\n		effect:''fold,fade,sliceDown'',\r\n        slices:15,\r\n        animSpeed:800,\r\n        pauseTime:6000,\r\n        directionNav:true, //Next & Prev\r\n        directionNavHide:true, //Only show on hover\r\n        controlNav:true, //1,2,3...\r\n        pauseOnHover:false, //Stop animation while hovering\r\n        captionOpacity:.7 //Universal caption opacity\r\n	   });\r\n     });\r\n\r\n		$(function() {\r\n			var galleries = $(''.ad-gallery'').adGallery();\r\n		});\r\n	\r\n</script>\r\n</body>\r\n</html>', 'yes', 1344950333);

-- --------------------------------------------------------

--
-- Структура таблицы `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `testimonial_text` text NOT NULL,
  `is_visible` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `testimonial_text`, `is_visible`) VALUES
(1, 'Asma Ghannam', '“I recently had the pleasure of working with Vera Bahou, of DesignHaus Interiors, on renovating our basement. Vera has beautiful taste, an amazing eye for colors, and a wealth of resources. She is very organized, meticulous and candid. Vera took the lead in drawing the future design for the basement, developing the proposed budget, and setting up appointments with various showrooms. In selecting designs and furniture, Vera would offer her tasteful advice, while being respectful of the clients'' views. She reached out to construction builders, electricians, glass and marble vendors etc....and often requested numerous estimates to ensure competitive bidding. Vera supervised their efforts and worked tirelessly to ensure they delivered. I was also impressed with her depth and wealth of expertise, be it in colors, wall decor, window treatments, furniture, tiles, marble, glass, accessories, carpeting or other.\r\n\r\nWhat I found most refreshing about her was her assertiveness and candor, be it with me, the vendors, or the contractors hired to do the actual construction. She held them accountable and did not hesitate to ask them to re-do the work if she felt it was not up to the highest quality standards. Her customer focus was much appreciated and her diplomacy in interacting with vendors and contractors was very impressive. At the end of the day, our basement bathroom and bar looked beautiful, and the furniture, wall decor and paint job was bold and very attractive.\r\n\r\nIn a nutshell, Vera Bahou is a truly creative, artistic and professional designer and I highly recommend her for anyone interested in turning "plain" into "beautiful".”\r\n', 'yes'),
(2, 'Veretilo Sergei', '“I recently had the pleasure of working with Vera Bahou, of DesignHaus Interiors, on renovating our basement. Vera has beautiful taste, an amazing eye for colors, and a wealth of resources. She is very organized, meticulous and candid. Vera took the lead in drawing the future design for the basement, developing the proposed budget, and setting up appointments with various showrooms. In selecting designs and furniture, Vera would offer her tasteful advice, while being respectful of the clients'' views. She reached out to construction builders, electricians, glass and marble vendors etc....and often requested numerous estimates to ensure competitive bidding. Vera supervised their efforts and worked tirelessly to ensure they delivered. I was also impressed with her depth and wealth of expertise, be it in colors, wall decor, window treatments, furniture, tiles, marble, glass, accessories, carpeting or other.\r\n\r\nWhat I found most refreshing about her was her assertiveness and candor, be it with me, the vendors, or the contractors hired to do the actual construction. She held them accountable and did not hesitate to ask them to re-do the work if she felt it was not up to the highest quality standards. Her customer focus was much appreciated and her diplomacy in interacting with vendors and contractors was very impressive. At the end of the day, our basement bathroom and bar looked beautiful, and the furniture, wall decor and paint job was bold and very attractive.\r\n\r\nIn a nutshell, Vera Bahou is a truly creative, artistic and professional designer and I highly recommend her for anyone interested in turning "plain" into "beautiful".”\r\n', 'yes'),
(3, 'Liane O’brien', '“Vera is a terrific listener with an eye for the clients taste and budget. I can highly recommend DesignHaus Interiors for any project relating to remodel/and or design.”', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `first_name` varchar(45) NOT NULL DEFAULT '',
  `last_name` varchar(45) NOT NULL DEFAULT '',
  `login` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `password_salt` char(3) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `login`, `password`, `password_salt`, `email`, `is_active`) VALUES
(2, 1, 'Sergei', 'Veretilo', 'admin', 'e3618105f23997b0786bade7a82ed8a6', 'vW1', 'veretilo_sergei@mail.ru', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_tabs`
--

CREATE TABLE IF NOT EXISTS `user_tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tab_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `tab_id` (`tab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=217 ;

--
-- Дамп данных таблицы `user_tabs`
--

INSERT INTO `user_tabs` (`id`, `user_id`, `tab_id`) VALUES
(127, 1, 1),
(128, 1, 2),
(133, 1, 9),
(135, 1, 10),
(169, 3, 1),
(170, 3, 2),
(173, 3, 10),
(175, 3, 9),
(201, 1, 24),
(203, 1, 25),
(205, 1, 26),
(207, 1, 27),
(209, 2, 1),
(210, 2, 2),
(211, 2, 24),
(212, 2, 25),
(213, 2, 26),
(214, 2, 27),
(215, 2, 10),
(216, 2, 9);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
