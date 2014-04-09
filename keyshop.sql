-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 09 2014 г., 17:44
-- Версия сервера: 5.5.35-log
-- Версия PHP: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `phpwebco_shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin2 AUTO_INCREMENT=221 ;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'United States'),
(2, 'United Kingdom'),
(3, 'Norway'),
(4, 'Greece'),
(5, 'Afghanistan'),
(6, 'Albania'),
(7, 'Algeria'),
(8, 'American Samoa'),
(9, 'Andorra'),
(10, 'Angola'),
(11, 'Anguilla'),
(12, 'Antigua & Barbuda'),
(13, 'Antilles, Netherlands'),
(182, 'Senegal'),
(15, 'Argentina'),
(16, 'Armenia'),
(17, 'Aruba'),
(18, 'Australia'),
(19, 'Austria'),
(20, 'Azerbaijan'),
(21, 'Bahamas, The'),
(22, 'Bahrain'),
(23, 'Bangladesh'),
(24, 'Barbados'),
(25, 'Belarus'),
(26, 'Belgium'),
(27, 'Belize'),
(28, 'Benin'),
(29, 'Bermuda'),
(30, 'Bhutan'),
(31, 'Bolivia'),
(32, 'Bosnia and Herzegovina'),
(33, 'Botswana'),
(34, 'Brazil'),
(35, 'British Virgin Islands'),
(36, 'Brunei Darussalam'),
(37, 'Bulgaria'),
(38, 'Burkina Faso'),
(39, 'Burundi'),
(40, 'Cambodia'),
(41, 'Cameroon'),
(42, 'Canada'),
(43, 'Cape Verde'),
(44, 'Cayman Islands'),
(45, 'Central African Republic'),
(46, 'Chad'),
(47, 'Chile'),
(48, 'China'),
(49, 'Colombia'),
(50, 'Comoros'),
(51, 'Congo'),
(52, 'Congo'),
(53, 'Cook Islands'),
(54, 'Costa Rica'),
(55, 'Cote D''Ivoire'),
(56, 'Croatia'),
(57, 'Cuba'),
(58, 'Cyprus'),
(59, 'Czech Republic'),
(60, 'Denmark'),
(61, 'Djibouti'),
(62, 'Dominica'),
(63, 'Dominican Republic'),
(64, 'East Timor (Timor-Leste)'),
(65, 'Ecuador'),
(66, 'Egypt'),
(67, 'El Salvador'),
(68, 'Equatorial Guinea'),
(69, 'Eritrea'),
(70, 'Estonia'),
(71, 'Ethiopia'),
(72, 'Falkland Islands'),
(73, 'Faroe Islands'),
(74, 'Fiji'),
(75, 'Finland'),
(76, 'France'),
(77, 'French Guiana'),
(78, 'French Polynesia'),
(79, 'Gabon'),
(80, 'Gambia, the'),
(81, 'Georgia'),
(82, 'Germany'),
(83, 'Ghana'),
(84, 'Gibraltar'),
(86, 'Greenland'),
(87, 'Grenada'),
(88, 'Guadeloupe'),
(89, 'Guam'),
(90, 'Guatemala'),
(91, 'Guernsey and Alderney'),
(92, 'Guinea'),
(93, 'Guinea-Bissau'),
(94, 'Guinea, Equatorial'),
(95, 'Guiana, French'),
(96, 'Guyana'),
(97, 'Haiti'),
(179, 'San Marino'),
(99, 'Honduras'),
(100, 'Hong Kong, (China)'),
(101, 'Hungary'),
(102, 'Iceland'),
(103, 'India'),
(104, 'Indonesia'),
(105, 'Iran, Islamic Republic of'),
(106, 'Iraq'),
(107, 'Ireland'),
(108, 'Israel'),
(109, 'Ivory Coast (Cote d''Ivoire)'),
(110, 'Italy'),
(111, 'Jamaica'),
(112, 'Japan'),
(113, 'Jersey'),
(114, 'Jordan'),
(115, 'Kazakhstan'),
(116, 'Kenya'),
(117, 'Kiribati'),
(118, 'Korea, (South) Rep. of'),
(119, 'Kuwait'),
(120, 'Kyrgyzstan'),
(121, 'Lao People''s Dem. Rep.'),
(122, 'Latvia'),
(123, 'Lebanon'),
(124, 'Lesotho'),
(125, 'Libyan Arab Jamahiriya'),
(126, 'Liechtenstein'),
(127, 'Lithuania'),
(128, 'Luxembourg'),
(129, 'Macao, (China)'),
(130, 'Macedonia, TFYR'),
(131, 'Madagascar'),
(132, 'Malawi'),
(133, 'Malaysia'),
(134, 'Maldives'),
(135, 'Mali'),
(136, 'Malta'),
(137, 'Martinique'),
(138, 'Mauritania'),
(139, 'Mauritius'),
(140, 'Mexico'),
(141, 'Micronesia'),
(142, 'Moldova, Republic of'),
(143, 'Monaco'),
(144, 'Mongolia'),
(145, 'Montenegro'),
(146, 'Morocco'),
(147, 'Mozambique'),
(148, 'Myanmar (ex-Burma)'),
(149, 'Namibia'),
(150, 'Nepal'),
(151, 'Netherlands'),
(152, 'New Caledonia'),
(153, 'New Zealand'),
(154, 'Nicaragua'),
(155, 'Niger'),
(156, 'Nigeria'),
(157, 'Northern Mariana Islands'),
(159, 'Oman'),
(160, 'Pakistan'),
(161, 'Palestinian Territory'),
(162, 'Panama'),
(163, 'Papua New Guinea'),
(164, 'Paraguay'),
(165, 'Peru'),
(166, 'Philippines'),
(167, 'Poland'),
(168, 'Portugal'),
(170, 'Qatar'),
(171, 'Reunion'),
(172, 'Romania'),
(173, 'Russian Federation'),
(174, 'Rwanda'),
(175, 'Saint Kitts and Nevis'),
(176, 'Saint Lucia'),
(177, 'St. Vincent & the Grenad.'),
(178, 'Samoa'),
(180, 'Sao Tome and Principe'),
(181, 'Saudi Arabia'),
(183, 'Serbia'),
(184, 'Seychelles'),
(185, 'Singapore'),
(186, 'Slovakia'),
(187, 'Slovenia'),
(188, 'Solomon Islands'),
(189, 'Somalia'),
(190, 'South Sudan'),
(191, 'Spain'),
(192, 'Sri Lanka'),
(193, 'Sudan'),
(194, 'Suriname'),
(195, 'Swaziland'),
(196, 'Sweden'),
(197, 'Switzerland'),
(198, 'Syrian Arab Republic'),
(199, 'Taiwan'),
(200, 'Tajikistan'),
(201, 'Tanzania, United Rep. of'),
(202, 'Thailand'),
(203, 'Togo'),
(204, 'Tonga'),
(205, 'Trinidad & Tobago'),
(206, 'Tunisia'),
(207, 'Turkey'),
(208, 'Turkmenistan'),
(209, 'Uganda'),
(210, 'Украина'),
(211, 'United Arab Emirates'),
(212, 'Uruguay'),
(213, 'Uzbekistan'),
(214, 'Vanuatu'),
(215, 'Venezuela'),
(216, 'Viet Nam'),
(217, 'Virgin Islands, U.S.'),
(218, 'Yemen'),
(219, 'Zambia'),
(220, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Структура таблицы `site_settings`
--

CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `site_url` varchar(85) NOT NULL,
  `site_email` varchar(85) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_url`, `site_email`) VALUES
(1, 'localhost/allinone', 'laert13@ya.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `ct_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ct_qty` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `ct_sw` smallint(5) NOT NULL DEFAULT '0',
  `ct_il` smallint(5) NOT NULL DEFAULT '0',
  `ct_session_id` char(32) NOT NULL DEFAULT '',
  `ct_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ct_id`),
  KEY `pd_id` (`pd_id`),
  KEY `ct_session_id` (`ct_session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `tbl_cart`
--

INSERT INTO `tbl_cart` (`ct_id`, `pd_id`, `ct_qty`, `ct_sw`, `ct_il`, `ct_session_id`, `ct_date`) VALUES
(50, 2, 1, 0, 0, 'hi2dmiijdhspfldh1tbq578f51', '2014-04-09 15:50:51'),
(51, 2, 2, 0, 0, 'cib1bltrp5cihair7ctvujvn66', '2014-04-09 15:51:11');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_parent_id` int(11) NOT NULL DEFAULT '0',
  `cat_name` varchar(50) NOT NULL DEFAULT '',
  `cat_description` varchar(200) NOT NULL DEFAULT '',
  `cat_image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cat_id`),
  KEY `cat_parent_id` (`cat_parent_id`),
  KEY `cat_name` (`cat_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES
(18, 0, 'Клавиатуры', 'Механические клавиатуры', '9916b9f804e55ee47265af0e646b023e.jpg'),
(19, 0, 'Аксессуары', 'Аксессуары к клавиатурам', 'b7900b032486732b42f6927f440121d8.jpg'),
(20, 19, 'Ducky', 'Аксессуары к клавиатурам Ducky', '38ce03ba07574a7c581b06d4989964ff.jpg'),
(21, 18, 'Ducky', 'Механические клавиатуры Ducky', '9adfd36368ee24b8d325fe9d5944f6ea.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_currency`
--

CREATE TABLE IF NOT EXISTS `tbl_currency` (
  `cy_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cy_code` char(3) NOT NULL DEFAULT '',
  `cy_symbol` varchar(8) NOT NULL DEFAULT '',
  PRIMARY KEY (`cy_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_currency`
--

INSERT INTO `tbl_currency` (`cy_id`, `cy_code`, `cy_symbol`) VALUES
(1, 'EUR', '&#8364;'),
(2, 'ГРН', '&#8372;'),
(3, 'JPY', '&yen;'),
(4, 'USD', '$');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `od_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `od_date` datetime DEFAULT NULL,
  `od_last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `od_status` enum('New','Paid','Shipped','Completed','Cancelled') NOT NULL DEFAULT 'New',
  `od_memo` varchar(255) NOT NULL DEFAULT '',
  `od_shipping_first_name` varchar(50) NOT NULL DEFAULT '',
  `od_shipping_address1` varchar(100) NOT NULL DEFAULT '',
  `od_shipping_phone` varchar(32) NOT NULL DEFAULT '',
  `od_shipping_city` varchar(100) NOT NULL DEFAULT '',
  `od_shipping_cost` decimal(5,2) DEFAULT '0.00',
  `od_user_id` int(4) NOT NULL,
  `od_shipping` varchar(4) NOT NULL,
  PRIMARY KEY (`od_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order_item`
--

CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `od_qty` int(10) unsigned NOT NULL DEFAULT '0',
  `od_sw` smallint(5) NOT NULL DEFAULT '0',
  `od_il` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`od_id`,`od_qty`,`od_sw`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pd_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_name` varchar(100) NOT NULL DEFAULT '',
  `pd_description` text NOT NULL,
  `pd_price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `pd_qty` smallint(5) unsigned NOT NULL DEFAULT '0',
  `pd_sw_black` smallint(5) NOT NULL DEFAULT '0',
  `pd_sw_brown` smallint(5) NOT NULL DEFAULT '0',
  `pd_sw_blue` smallint(5) NOT NULL DEFAULT '0',
  `pd_sw_red` smallint(5) NOT NULL DEFAULT '0',
  `pd_illum` smallint(5) NOT NULL DEFAULT '0',
  `pd_il_blue` smallint(5) NOT NULL DEFAULT '0',
  `pd_il_orang` smallint(5) NOT NULL DEFAULT '0',
  `pd_image` varchar(200) DEFAULT NULL,
  `pd_thumbnail` varchar(200) DEFAULT NULL,
  `pd_img_dir` varchar(200) DEFAULT NULL,
  `pd_img_cnt` int(10) NOT NULL,
  `pd_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pd_last_update` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`pd_id`),
  KEY `cat_id` (`cat_id`),
  KEY `pd_name` (`pd_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `tbl_product`
--

INSERT INTO `tbl_product` (`pd_id`, `cat_id`, `pd_name`, `pd_description`, `pd_price`, `pd_qty`, `pd_sw_black`, `pd_sw_brown`, `pd_sw_blue`, `pd_sw_red`, `pd_illum`, `pd_il_blue`, `pd_il_orang`, `pd_image`, `pd_thumbnail`, `pd_img_dir`, `pd_img_cnt`, `pd_date`, `pd_last_update`) VALUES
(2, 21, 'Ducky Shine 3 Tuhaojin', 'Эксклюзив 2014-го года - выпущено всего 999 штук!', '250.00', 8, 2, 2, 2, 2, 1, 0, 0, 'e19bb3856738b80ac3c8873232cce6ac.jpg', 'a16d1fdb378db3dc3cc2f0564e045adc.jpg', 'tuhaojin', 8, '2014-02-26 13:54:17', '0000-00-00 00:00:00'),
(3, 21, 'Ducky Shine 3 DK9008', 'Топовая модель линейки с регулируемым уровнем и цветом подсветки.', '159.00', 0, 0, 0, 0, 0, 1, 0, 0, '45c73a62a84fefffebb7502ef11e6671.jpg', '267ca62a2f469ee3aa11198a44f418d3.jpg', 'DK9008', 13, '2014-02-26 13:54:59', '0000-00-00 00:00:00'),
(4, 20, 'Ducky Wrist Rest', 'Полноразмерная подставка под ладони. Сделана из натуральной кожи.', '25.00', 8, 0, 0, 0, 0, 0, 0, 0, 'ad503b30c4033b70124ec3c15c01aec7.jpg', '2bcd838cd73a3b71f9a71c617fb97341.jpg', 'access', 4, '2014-02-26 15:35:00', '0000-00-00 00:00:00'),
(5, 21, 'Ducky Shine 3 DK9087', 'Топовая модель линейки с регулируемым уровнем и цветом подсветки. Без цифрового блока.', '139.00', 5, 2, 1, 1, 1, 1, 0, 0, '79258f83428cb4650bee754ff5903f9a.jpg', '888f7b91e7eff8052704c59191ad3253.jpg', 'DK9087', 6, '2014-02-26 16:44:53', '0000-00-00 00:00:00'),
(6, 21, 'Ducky Zero DK2108S', 'Высокое качество по доступной цене! Теперь с подсветкой.', '131.00', 7, 2, 3, 1, 1, 2, 3, 4, '02bcf6e7c545436ae98cdb0c4f927c8b.jpg', '59b5fdae81cba8084d74c9a3594b0b7a.jpg', 'DK2108S', 8, '2014-02-26 16:46:40', '0000-00-00 00:00:00'),
(7, 21, 'Ducky Zero DK2108', 'Высокое качество по доступной цене!', '107.00', 6, 2, 2, 2, 0, 0, 0, 0, '89d111b3e26c1eff09c05f388e1e9ed8.jpg', '9bcf0554a8c6ccb3eb283d38f4fb74f4.jpg', 'DK2108', 7, '2014-02-26 16:48:05', '0000-00-00 00:00:00'),
(8, 21, 'Ducky Zero DK2087', 'Высокое качество по доступной цене!  Без цифрового блока.', '101.00', 8, 3, 2, 3, 0, 0, 0, 0, 'f2bcb880208c13f7e795976ab00f8973.jpg', '38a55fdd152d721f385094766aabe5e4.jpg', 'DK2087', 7, '2014-02-26 16:48:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_review`
--

CREATE TABLE IF NOT EXISTS `tbl_review` (
  `rv_id` int(11) NOT NULL AUTO_INCREMENT,
  `rv_pd_id` int(11) NOT NULL,
  `rv_usr_id` int(11) NOT NULL,
  `rv_usr_name` varchar(30) NOT NULL,
  `rv_usr_email` varchar(30) NOT NULL,
  `rv_usr_rating` int(11) NOT NULL,
  `rv_text` varchar(300) NOT NULL,
  `rv_valid` int(11) NOT NULL DEFAULT '0',
  `rv_date` varchar(45) NOT NULL,
  PRIMARY KEY (`rv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `tbl_review`
--

INSERT INTO `tbl_review` (`rv_id`, `rv_pd_id`, `rv_usr_id`, `rv_usr_name`, `rv_usr_email`, `rv_usr_rating`, `rv_text`, `rv_valid`, `rv_date`) VALUES
(19, 5, 15, 'laert', 'laert13@ya.ru', 5, ',ndfnsmfnmsdnm', 1, '2014-03-13 16:52:30'),
(20, 5, 15, 'laert', 'laert13@ya.ru', 5, 'nsmbbmnmnm', 0, '2014-03-13 16:54:01'),
(21, 4, 15, 'laert', 'g@s.oo', 5, '', 0, '2014-03-27 16:57:32');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_shop_config`
--

CREATE TABLE IF NOT EXISTS `tbl_shop_config` (
  `sc_name` varchar(50) NOT NULL DEFAULT '',
  `sc_address` varchar(100) NOT NULL DEFAULT '',
  `sc_phone` varchar(30) NOT NULL DEFAULT '',
  `sc_email` varchar(30) NOT NULL DEFAULT '',
  `sc_shipping_cost` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sc_currency` int(10) unsigned NOT NULL DEFAULT '1',
  `sc_order_email` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_shop_config`
--

INSERT INTO `tbl_shop_config` (`sc_name`, `sc_address`, `sc_phone`, `sc_email`, `sc_shipping_cost`, `sc_currency`, `sc_order_email`) VALUES
('KeyShop - Механические клавиатуры', 'Old warehouse under the bridge,\r\nWater Seven, Grand Line', '777-FRANKY', 'franky@tomsworkers.com', '0.00', 4, 'y');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `user_password` varchar(32) NOT NULL DEFAULT '',
  `user_regdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `user_regdate`, `user_last_login`) VALUES
(1, 'admin', '43e9a4ab75570f5b', '2005-02-20 17:35:44', '2014-03-03 11:40:54'),
(3, 'webmaster', '026cf3fc6e903caf', '2005-03-02 17:52:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `temp_pass` varchar(32) CHARACTER SET utf8 NOT NULL,
  `temp_pass_active` int(1) NOT NULL,
  `first_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(25) CHARACTER SET utf8 NOT NULL,
  `email` varchar(35) CHARACTER SET utf8 NOT NULL,
  `dialing_code` int(5) NOT NULL,
  `phone` int(25) NOT NULL,
  `city` varchar(80) CHARACTER SET utf8 NOT NULL,
  `country` varchar(80) CHARACTER SET utf8 NOT NULL,
  `thumb_path` varchar(150) CHARACTER SET utf8 NOT NULL,
  `img_path` varchar(150) CHARACTER SET utf8 NOT NULL,
  `active` int(1) NOT NULL,
  `level_access` int(1) NOT NULL,
  `act_key` varchar(80) CHARACTER SET utf8 NOT NULL,
  `reg_date` varchar(45) CHARACTER SET utf8 NOT NULL,
  `last_active` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `temp_pass`, `temp_pass_active`, `first_name`, `last_name`, `email`, `dialing_code`, `phone`, `city`, `country`, `thumb_path`, `img_path`, `active`, `level_access`, `act_key`, `reg_date`, `last_active`) VALUES
(1, 'user1', '6c90b22e50c986116fff47d48ad9407d', 'd0ygOllq', 0, 'John', 'Doe', 'test@localhost', 254, 723456789, 'Kigali', 'Afghanistan', '', '', 1, 2, '', 'Wednesday, Sep 28, 2011, 8:47 am', ''),
(2, 'admin', 'eb0e08b3bd3351091697316934808133', '', 0, 'Site', 'Admin', 'admin@test.com', 254, 722123123, 'Nairobi', 'Kenya', '', '', 1, 1, '', '', ''),
(3, 'user2', '317da97d438875c141a4b5f9f67dfdd0', '', 0, 'Jane', 'Doe', 'user2@mail.com', 254, 771771771, 'Meru', 'Kenya', '', '', 1, 2, '', 'Wednesday, Dec 21, 2011, 6:06 am', ''),
(12, 'billy', '266e8d5449777ef4651279cb8517d157', '', 0, 'Артем', 'Петренко', 'chaos.laert@gmail.com', 0, 509221571, 'Днепропетровск', 'Украина', '', '', 1, 2, '', 'Saturday, Mar 1, 2014, 6:41 pm', ''),
(15, 'laert', '266e8d5449777ef4651279cb8517d157', '', 0, 'Артем', 'Петренко', 'laert13@ya.ru', 0, 509221571, 'Днепропетровск', 'Украина', '', '', 1, 2, '', 'Thursday, Mar 13, 2014, 5:47 pm', ''),
(17, 'zone', '266e8d5449777ef4651279cb8517d157', '', 0, '', '', 'zone-i@i.ua', 0, 0, '', '', '', '', 1, 2, '', '2014-03-14 16:49:11', ''),
(18, 'blablablab', '266e8d5449777ef4651279cb8517d157', '', 0, '', '', 'tt@i.ua', 0, 0, '', '', '', '', 1, 2, '', '2014-03-30 12:14:26', ''),
(19, 'uuuuuuuu', '4000f8f21c4fc014dd78e64fdfd2a80c', '', 0, '', '', 'uuuuu@uuu.uu', 0, 0, '', '', '', '', 1, 2, '', '2014-03-30 12:19:19', ''),
(20, 'blood', 'fd29716ebd465313bc5d92d4b4c7e28a', '', 0, '', '', 'blood@ya.ru', 0, 0, '', '', '', '', 1, 2, '', '2014-03-31 18:33:04', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
