-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 21 2014 г., 16:48
-- Версия сервера: 5.5.37-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `plink_db`
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
(16, 'Armenia'),
(25, 'Belarus'),
(70, 'Estonia'),
(115, 'Kazakhstan'),
(120, 'Kyrgyzstan'),
(122, 'Latvia'),
(127, 'Lithuania'),
(142, 'Moldova, Republic of'),
(173, 'Russian Federation'),
(200, 'Tajikistan'),
(208, 'Turkmenistan'),
(210, 'Украина'),
(213, 'Uzbekistan');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pg_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `pg_title` varchar(50) DEFAULT NULL,
  `pg_parent` smallint(5) NOT NULL DEFAULT '0',
  `pg_alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`pg_id`, `pg_title`, `pg_parent`, `pg_alias`) VALUES
(1, 'Keyshop', 0, '/index.php'),
(2, 'Магазин', 1, '/shopController.php'),
(3, 'Вход в интернет-магазин', 1, '/login.php'),
(5, 'Регистрация', 1, '/register.php'),
(6, 'Доставка и оплата', 1, '/delivery.php'),
(7, 'Контакты', 1, '/contacts.php'),
(8, 'Корзина', 1, '/cart.php'),
(9, 'Оформление заказа', 1, '/checkout.php'),
(10, 'Изменение пароля', 1, '/change_pass.php'),
(11, 'Подтверждение пароля', 1, '/confirm_pass.php'),
(12, 'Редактирование профиля', 1, '/edit_profile.php'),
(13, 'Список заказов', 1, '/order_list.php'),
(14, 'Детали заказа', 1, '/order_detail.php'),
(15, 'Восстановление пароля', 1, '/pass_reset.php'),
(16, 'Список отзывов', 1, '/review_list.php');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `ct_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `ct_qty` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `ct_session_id` char(32) NOT NULL DEFAULT '',
  `ct_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ct_id`),
  KEY `pd_id` (`pd_id`),
  KEY `ct_session_id` (`ct_session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `tbl_cart`
--

INSERT INTO `tbl_cart` (`ct_id`, `pd_id`, `ct_qty`, `ct_session_id`, `ct_date`) VALUES
(11, 3, 1, '9e5h97hj5udu775nkqrqf72au4', '2014-05-08 18:11:43');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Дамп данных таблицы `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES
(18, 0, 'Клавиатуры', 'Механические клавиатуры', '9916b9f804e55ee47265af0e646b023e.jpg'),
(19, 0, 'Аксессуары', 'Аксессуары к клавиатурам', 'b7900b032486732b42f6927f440121d8.jpg'),
(20, 19, 'Ducky', 'Аксессуары к клавиатурам Ducky', '38ce03ba07574a7c581b06d4989964ff.jpg'),
(21, 18, 'Ducky', 'Механические клавиатуры Ducky', '9adfd36368ee24b8d325fe9d5944f6ea.jpg'),
(22, 0, 'Винтовки пневматические', 'Винтовки пневматические', '608ee53b2c4e168f491f55d52e09e805.jpg'),
(23, 22, 'Газо-пружинные', 'Газо-пружинные', '0ebb443d2f6f686548dbedf92c421e26.jpg'),
(26, 22, 'РСР (с предварительной накачкой)', 'РСР (с предварительной накачкой)', 'e44ba90ebcc1ae7642a8d2ec7470db7f.jpg'),
(27, 22, 'Пружинно-поршневые', 'Пружинно-поршневые', '9267c0fe2142121bef3f4e17736fbf59.jpg'),
(28, 22, 'С сжатым газом СО2', 'С сжатым газом СО2', 'b0e0af59ae221c033d3ebac0c8f51bcb.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order_item`
--

CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `od_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pd_id` int(10) unsigned NOT NULL DEFAULT '0',
  `od_qty` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`od_id`,`od_qty`)
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

INSERT INTO `tbl_product` (`pd_id`, `cat_id`, `pd_name`, `pd_description`, `pd_price`, `pd_qty`, `pd_image`, `pd_thumbnail`, `pd_img_dir`, `pd_img_cnt`, `pd_date`, `pd_last_update`) VALUES
(2, 21, 'Ducky Shine 3 Tuhaojin', 'Эксклюзив 2014-го года - выпущено всего 999 штук!', '250.00', 0, 'e19bb3856738b80ac3c8873232cce6ac.jpg', 'a16d1fdb378db3dc3cc2f0564e045adc.jpg', 'tuhaojin', 8, '2014-02-26 13:54:17', '0000-00-00 00:00:00'),
(3, 21, 'Ducky Shine 3 DK9008', 'Топовая модель линейки с регулируемым уровнем и цветом подсветки.', '149.00', 2, '45c73a62a84fefffebb7502ef11e6671.jpg', '267ca62a2f469ee3aa11198a44f418d3.jpg', 'DK9008', 13, '2014-02-26 13:54:59', '0000-00-00 00:00:00'),
(4, 20, 'Ducky Wrist Rest', 'Полноразмерная подставка под ладони. Сделана из натуральной кожи!', '25.00', 1, 'ad503b30c4033b70124ec3c15c01aec7.jpg', '2bcd838cd73a3b71f9a71c617fb97341.jpg', 'access', 4, '2014-02-26 15:35:00', '0000-00-00 00:00:00'),
(5, 21, 'Ducky Shine 3 DK9087', 'Топовая модель линейки с регулируемым уровнем и цветом подсветки. Без цифрового блока.', '131.00', 1, '79258f83428cb4650bee754ff5903f9a.jpg', '888f7b91e7eff8052704c59191ad3253.jpg', 'DK9087', 6, '2014-02-26 16:44:53', '0000-00-00 00:00:00'),
(6, 21, 'Ducky Zero DK2108S', 'Высокое качество по доступной цене! Теперь с подсветкой.', '131.00', 5, '02bcf6e7c545436ae98cdb0c4f927c8b.jpg', '59b5fdae81cba8084d74c9a3594b0b7a.jpg', 'DK2108S', 8, '2014-02-26 16:46:40', '0000-00-00 00:00:00'),
(7, 21, 'Ducky Zero DK2108', 'Высокое качество по доступной цене!', '107.00', 8, '89d111b3e26c1eff09c05f388e1e9ed8.jpg', '9bcf0554a8c6ccb3eb283d38f4fb74f4.jpg', 'DK2108', 7, '2014-02-26 16:48:05', '0000-00-00 00:00:00'),
(8, 21, 'Ducky Zero DK2087', 'Высокое качество по доступной цене!  Без цифрового блока.', '101.00', 1, 'f2bcb880208c13f7e795976ab00f8973.jpg', '38a55fdd152d721f385094766aabe5e4.jpg', 'DK2087', 7, '2014-02-26 16:48:48', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_shipping`
--

CREATE TABLE IF NOT EXISTS `tbl_shipping` (
  `sh_id` int(6) NOT NULL AUTO_INCREMENT,
  `sh_session` char(32) DEFAULT NULL,
  `sh_name` varchar(25) DEFAULT NULL,
  `sh_phone` varchar(25) DEFAULT NULL,
  `sh_email` varchar(25) DEFAULT NULL,
  `sh_city` varchar(25) DEFAULT NULL,
  `sh_address` varchar(100) DEFAULT NULL,
  `sh_ship` varchar(4) DEFAULT NULL,
  `sh_uid` int(5) NOT NULL DEFAULT '0',
  `sh_flag` smallint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sh_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`sh_id`, `sh_session`, `sh_name`, `sh_phone`, `sh_email`, `sh_city`, `sh_address`, `sh_ship`, `sh_uid`, `sh_flag`) VALUES
(2, '7ohrcem9n0nil6gj1c72bsllf1', 'abj', '123', 'example@email.com', 'aodj', '', 'cour', 0, 1);

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
  `sc_order_email` enum('y','n') NOT NULL DEFAULT 'n',
  `sc_exch` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`sc_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_shop_config`
--

INSERT INTO `tbl_shop_config` (`sc_name`, `sc_address`, `sc_phone`, `sc_email`, `sc_shipping_cost`, `sc_currency`, `sc_order_email`, `sc_exch`) VALUES
('KeyShop - Механические клавиатуры', '\n', '050 922 15 71', 'keyshop.ua@gmail.com', '0.00', 4, 'y', '11.85');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_password`, `user_regdate`, `user_last_login`) VALUES
(1, 'admin', '7e212e2b0d60f7f4124a17af060f7566', '2005-02-20 17:35:44', '2014-05-21 15:08:23');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `temp_pass`, `temp_pass_active`, `first_name`, `last_name`, `email`, `dialing_code`, `phone`, `city`, `country`, `thumb_path`, `img_path`, `active`, `level_access`, `act_key`, `reg_date`, `last_active`) VALUES
(2, 'admin', 'eb0e08b3bd3351091697316934808133', '', 0, 'Site', 'Admin', 'admin@test.com', 254, 722123123, 'Nairobi', 'Kenya', '', '', 1, 1, '', '', ''),
(15, 'laert', '266e8d5449777ef4651279cb8517d157', '', 0, 'Артем', 'Петренко', 'laert13@ya.ru', 0, 509221571, 'Днепропетровск', 'Украина', '', '', 1, 2, '', 'Thursday, Mar 13, 2014, 5:47 pm', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
