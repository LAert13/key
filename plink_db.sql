-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2014 г., 00:08
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
(1, 'keyshop.in.ua', 'keyshop.ua@gmail.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_parent_id`, `cat_name`, `cat_description`, `cat_image`) VALUES
(18, 0, 'Клавиатуры', 'Механические клавиатуры', '9916b9f804e55ee47265af0e646b023e.jpg'),
(19, 0, 'Аксессуары', 'Аксессуары к клавиатурам', 'b7900b032486732b42f6927f440121d8.jpg'),
(20, 19, 'Ducky', 'Аксессуары к клавиатурам Ducky', '38ce03ba07574a7c581b06d4989964ff.jpg'),
(21, 18, 'Ducky', 'Механические клавиатуры Ducky', '9adfd36368ee24b8d325fe9d5944f6ea.jpg'),
(24, 0, 'Пневматические винтовки', 'Пневматические винтовки', '1e72e9ec1318aed7273311cee3811976.jpg'),
(25, 24, 'Газо-пружинные', 'Пневматические винтовки', 'be86b0b72484bfdab4ef6631b832522a.jpg'),
(26, 24, 'РСР (с предварительной накачкой)', 'РСР (с предварительной накачкой)', 'c3fcf74bbb856b52bd20567adc012d53.jpg'),
(27, 24, 'Пружинно-поршневые', 'Пружинно-поршневые', 'e5e9aac526f0a67d21f503dc0bdc56d0.jpg'),
(28, 24, 'С сжатым газом СО2', 'С сжатым газом СО2', 'd605e3185bc3e8ddd799ec9ccf3567fe.jpg'),
(29, 0, 'Пневматические пистолеты', 'Пневматические пистолеты', '90e88e0318eda3c2e46d4093d0e2fa98.jpg'),
(30, 29, 'Мультикомпрессионные', 'Мультикомпрессионные', '38216393f40623dd5c544a4f781e9d23.jpg'),
(31, 29, 'Пружинно-поршневые', 'Пружинно-поршневые', '0311599aba4731d637bc90413d84d71f.jpg'),
(32, 29, 'С сжатым газом СО2', 'С сжатым газом СО2', 'e195da235010ac617189120f46e5e77b.jpg'),
(33, 0, 'Револьверы под патрон флобера', 'Револьверы под патрон флобера', ''),
(34, 0, 'Сигнальные пистолеты', 'Сигнальные пистолеты', '');

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
-- Структура таблицы `tbl_filters`
--

CREATE TABLE IF NOT EXISTS `tbl_filters` (
  `flt_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `flt_name` varchar(30) NOT NULL,
  PRIMARY KEY (`flt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `tbl_filters`
--

INSERT INTO `tbl_filters` (`flt_id`, `flt_name`) VALUES
(1, 'Производитель'),
(2, 'Модель'),
(3, 'Калибр'),
(4, 'Цвет'),
(5, 'Используемые материалы'),
(6, 'Страна-производитель'),
(7, 'Вес,кг'),
(8, 'Кратность(увеличение)'),
(9, 'Тип прицела'),
(10, 'Емкость магазина'),
(11, 'Материал приклада'),
(12, 'Общая длинна'),
(13, 'Тип пневматики'),
(14, 'Начальная скорость пули'),
(15, 'Тип боеприпасов'),
(16, 'Тип пружины'),
(17, 'Материал'),
(18, 'Источник энергии'),
(19, 'Тип взвода'),
(20, 'Предохранитель'),
(21, 'Тип заряда');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_filter_link`
--

CREATE TABLE IF NOT EXISTS `tbl_filter_link` (
  `flt_id` smallint(5) NOT NULL,
  `val_id` smallint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_filter_link`
--

INSERT INTO `tbl_filter_link` (`flt_id`, `val_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(9, 4),
(9, 5),
(9, 6),
(4, 7),
(4, 8),
(15, 9),
(3, 10),
(19, 11),
(19, 12),
(17, 13),
(11, 14),
(11, 15),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(7, 21),
(7, 22),
(7, 23),
(7, 24),
(7, 25),
(7, 26),
(7, 27),
(7, 28),
(7, 29),
(7, 30),
(7, 31),
(8, 32),
(8, 33),
(12, 34),
(12, 35),
(12, 36),
(12, 37),
(12, 38),
(12, 39),
(12, 40),
(12, 41),
(12, 42),
(12, 43),
(12, 44),
(12, 45),
(12, 46),
(12, 47),
(12, 48),
(20, 49),
(20, 50),
(20, 51),
(16, 52),
(14, 53),
(14, 54),
(14, 55),
(14, 56),
(14, 57),
(14, 58),
(14, 59),
(14, 60),
(13, 61),
(6, 62),
(6, 63),
(6, 64),
(10, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(6, 73),
(6, 74),
(6, 75),
(6, 76),
(7, 77),
(7, 78),
(7, 79),
(7, 25),
(7, 81),
(7, 82),
(7, 83),
(10, 84),
(10, 85),
(10, 86),
(12, 87),
(12, 88),
(12, 89),
(12, 90),
(12, 91),
(12, 92),
(12, 93),
(12, 94),
(13, 95),
(13, 96),
(14, 97),
(14, 98),
(14, 99),
(14, 100),
(14, 101),
(14, 102),
(18, 103),
(19, 104),
(20, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(6, 112),
(6, 113),
(9, 114),
(9, 115),
(8, 116),
(8, 117),
(8, 118),
(10, 119),
(10, 120),
(10, 121),
(10, 122),
(10, 123),
(0, 124),
(7, 124),
(7, 126),
(7, 127),
(7, 128),
(7, 129),
(7, 130),
(7, 131),
(7, 132),
(7, 133),
(7, 134),
(7, 135),
(7, 136),
(7, 137),
(7, 138),
(7, 139),
(7, 140),
(7, 141),
(7, 142),
(7, 143),
(12, 144),
(12, 145),
(12, 146),
(12, 147),
(12, 148),
(12, 149),
(12, 150),
(12, 151),
(12, 152),
(12, 153),
(12, 154),
(12, 155),
(12, 156),
(12, 157),
(12, 158),
(12, 159),
(12, 160),
(12, 161),
(12, 162),
(12, 163),
(12, 164),
(12, 165),
(12, 166),
(12, 167),
(12, 168),
(12, 169),
(12, 170),
(12, 171),
(15, 172),
(15, 173),
(16, 174),
(19, 175),
(19, 176),
(14, 177),
(14, 178),
(14, 179),
(14, 180),
(14, 181),
(14, 182),
(14, 183),
(14, 184),
(14, 185),
(14, 186),
(14, 187),
(14, 188),
(14, 189),
(14, 190),
(14, 191),
(14, 192),
(14, 193),
(14, 194),
(14, 195),
(14, 196),
(14, 197),
(14, 198),
(14, 199),
(14, 200),
(14, 201),
(14, 202),
(1, 203),
(17, 15),
(10, 205),
(13, 206),
(12, 207),
(12, 208),
(12, 209),
(12, 210),
(12, 211),
(12, 212),
(8, 213),
(7, 214),
(7, 215),
(7, 216),
(4, 217);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_filter_value`
--

CREATE TABLE IF NOT EXISTS `tbl_filter_value` (
  `val_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `val_value` varchar(30) NOT NULL,
  PRIMARY KEY (`val_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=218 ;

--
-- Дамп данных таблицы `tbl_filter_value`
--

INSERT INTO `tbl_filter_value` (`val_id`, `val_value`) VALUES
(1, 'Crosman'),
(2, 'Gamo'),
(3, 'Magtech'),
(4, 'Оптический'),
(5, 'Прицельная планка и мушка'),
(6, 'Целик и мушка'),
(7, 'Черный'),
(8, 'Коричневый'),
(9, 'Свинцовые пули'),
(10, '4,5 мм'),
(11, 'Перелом ствола'),
(12, 'Подствольный рычаг'),
(13, 'Металл'),
(14, 'Дерево'),
(15, 'Пластик'),
(16, '2,5 кг'),
(17, '2,85 кг'),
(18, '2,8 кг'),
(19, '2,9 кг'),
(20, '3,0 кг'),
(21, '3,1 кг'),
(22, '3,12 кг'),
(23, '3,2 кг'),
(24, '3,28 кг'),
(25, '3,3 кг'),
(26, '3,38 кг'),
(27, '3,5 кг'),
(28, '3,6 кг'),
(29, '3,8 кг'),
(30, '4,0 кг'),
(31, '4,15 кг'),
(32, '3 - 9x'),
(33, '4x32'),
(34, '1070 мм'),
(35, '1090 мм'),
(36, '1092 мм'),
(37, '1100 мм'),
(38, '1110 мм'),
(39, '1115 мм'),
(40, '1130 мм'),
(41, '1143 мм'),
(42, '1150 мм'),
(43, '1160 мм'),
(44, '1165 мм'),
(45, '1170 мм'),
(46, '1180 мм'),
(47, '1190 мм'),
(48, '1220 мм'),
(49, 'Автоматический'),
(50, 'Есть'),
(51, 'Ручной'),
(52, 'Газовая пружина'),
(53, '280 м/с'),
(54, '305 м/с'),
(55, '320 м/с'),
(56, '350 м/с'),
(57, '365 м/с'),
(58, '366 м/с'),
(59, '380 м/с'),
(60, '400 м/с'),
(61, 'Пружинно-поршневая'),
(62, 'Бразилия'),
(63, 'Испания'),
(64, 'США'),
(65, '1'),
(66, 'BSA'),
(67, 'FX'),
(68, 'Gunpower'),
(69, 'KalibrGun'),
(70, 'Norica'),
(71, 'STEYR'),
(72, 'Winrauch'),
(73, 'Великобритания'),
(74, 'Германия'),
(75, 'Чехия'),
(76, 'Швеция'),
(77, '2,3 кг'),
(78, '2,4 кг'),
(79, '3,25 кг'),
(80, '3,3 кг'),
(81, '3,4 кг'),
(82, '3,9 кг'),
(83, '4,6 кг'),
(84, '10'),
(85, '14'),
(86, '16'),
(87, '1050 мм'),
(88, '1080 мм'),
(89, '620 мм'),
(90, '840 мм'),
(91, '970 мм'),
(92, '975 мм'),
(93, '980 мм'),
(94, '990 мм'),
(95, 'Компрессионная'),
(96, 'Мультикомпрессионная'),
(97, '275 м/с'),
(98, '285 м/с'),
(99, '300 м/с'),
(100, '325 м/с'),
(101, '330 м/с'),
(102, '335 м/с'),
(103, 'Сжатый воздух'),
(104, 'Затвор'),
(105, 'Отсутствует'),
(106, 'Borwning'),
(107, 'Cometa'),
(108, 'Diana'),
(109, 'Hatsan'),
(110, 'Stoeger'),
(111, 'ИЖ'),
(112, 'Россия'),
(113, 'Турция'),
(114, 'Диоптрический'),
(115, 'Коллиматорный'),
(116, '4 - 20x'),
(117, '4x'),
(118, '4x15'),
(119, '18'),
(120, '21'),
(121, '5'),
(122, '8'),
(123, '700'),
(124, '1,25 кг'),
(125, '1,25 кг'),
(126, '1,31 кг'),
(127, '1,4 кг'),
(128, '1,98 кг'),
(129, '1,67 кг'),
(130, '2,0 кг'),
(131, '2,1 кг'),
(132, '2,23 кг'),
(133, '2,49 кг'),
(134, '2,6 кг'),
(135, '2,7 кг'),
(136, '2,73 кг'),
(137, '2,77 кг'),
(138, '2,95 кг'),
(139, '3,7 кг'),
(140, '4,1 кг'),
(141, '4,2 кг'),
(142, '4,3 кг'),
(143, '4,58 кг'),
(144, '1020 мм'),
(145, '1030 мм'),
(146, '1040 мм'),
(147, '1060 мм'),
(148, '1085 мм'),
(149, '1112 мм'),
(150, '1114 мм'),
(151, '1120 мм'),
(152, '1125 мм'),
(153, '1140 мм'),
(154, '1155 мм'),
(155, '1163 мм'),
(156, '1195 мм'),
(157, '1210 мм'),
(158, '1230 мм'),
(159, '1232 мм'),
(160, '1270 мм'),
(161, '650 мм'),
(162, '775 мм'),
(163, '845 мм'),
(164, '889 мм'),
(165, '900 мм'),
(166, '921 мм'),
(167, '927 мм'),
(168, '930 мм'),
(169, '933 мм'),
(170, '940 мм'),
(171, '977 мм'),
(172, 'Шарики'),
(173, 'Шарики и свинцовые пули'),
(174, 'Витая пружина'),
(175, 'Скоба Генри'),
(176, 'Электромеханический'),
(177, '100 м/с'),
(178, '130 м/с'),
(179, '137 м/с'),
(180, '150 м/с'),
(181, '160 м/с'),
(182, '170 м/с'),
(183, '175 м/с'),
(184, '180 м/с'),
(185, '190 м/с'),
(186, '191 м/с'),
(187, '195 м/с'),
(188, '200 м/с'),
(189, '207 м/с'),
(190, '220 м/с'),
(191, '230 м/с'),
(192, '240 м/с'),
(193, '245 м/с'),
(194, '250 м/с'),
(195, '260 м/с'),
(196, '265 м/с'),
(197, '290 м/с'),
(198, '312 м/с'),
(199, '315 м/с'),
(200, '340 м/с'),
(201, '360 м/с'),
(202, '427 м/с'),
(203, 'UMAREX'),
(204, 'Пластик'),
(205, '12'),
(206, 'Газобалонная'),
(207, '570 мм'),
(208, '591 мм'),
(209, '780 мм'),
(210, '838 мм'),
(211, '863 мм'),
(212, '937 мм'),
(213, '6 - 42x'),
(214, '1,05 кг'),
(215, '1,61 кг'),
(216, '1,635 кг'),
(217, 'Бежевый');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `tbl_order`
--

INSERT INTO `tbl_order` (`od_id`, `od_date`, `od_last_update`, `od_status`, `od_memo`, `od_shipping_first_name`, `od_shipping_address1`, `od_shipping_phone`, `od_shipping_city`, `od_shipping_cost`, `od_user_id`, `od_shipping`) VALUES
(1, '2014-05-11 20:27:03', '2014-05-11 20:27:03', 'New', 'Asfas@sdfaasdf.rr', 'Asdfasdf', '', '545454545151', 'Sdafasdf', '5.00', 0, 'cod');

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

--
-- Дамп данных таблицы `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`od_id`, `pd_id`, `od_qty`) VALUES
(1, 8, 1);

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
(3, 21, 'Ducky Shine 3 DK9008', 'Топовая модель линейки с регулируемым уровнем и цветом подсветки.', '149.00', 2, '2c975665f88c971cbdd5230783f1bc07.jpg', '8ea5826da6baf7475a4efc1ea856d19f.jpg', 'DK9008', 13, '2014-02-26 13:54:59', '0000-00-00 00:00:00'),
(4, 20, 'Ducky Wrist Rest', 'Полноразмерная подставка под ладони. Сделана из натуральной кожи.', '25.00', 1, 'ad503b30c4033b70124ec3c15c01aec7.jpg', '2bcd838cd73a3b71f9a71c617fb97341.jpg', 'access', 4, '2014-02-26 15:35:00', '0000-00-00 00:00:00'),
(5, 21, 'Ducky Shine 3 DK9087', 'Топовая модель линейки с регулируемым уровнем и цветом подсветки. Без цифрового блока.', '131.00', 1, '79258f83428cb4650bee754ff5903f9a.jpg', '888f7b91e7eff8052704c59191ad3253.jpg', 'DK9087', 6, '2014-02-26 16:44:53', '0000-00-00 00:00:00'),
(6, 21, 'Ducky Zero DK2108S', 'Высокое качество по доступной цене! Теперь с подсветкой.', '131.00', 5, '02bcf6e7c545436ae98cdb0c4f927c8b.jpg', '59b5fdae81cba8084d74c9a3594b0b7a.jpg', 'DK2108S', 8, '2014-02-26 16:46:40', '0000-00-00 00:00:00'),
(7, 21, 'Ducky Zero DK2108', 'Высокое качество по доступной цене!', '107.00', 8, '89d111b3e26c1eff09c05f388e1e9ed8.jpg', '9bcf0554a8c6ccb3eb283d38f4fb74f4.jpg', 'DK2108', 7, '2014-02-26 16:48:05', '0000-00-00 00:00:00'),
(8, 21, 'Ducky Zero DK2087', 'Высокое качество по доступной цене!  Без цифрового блока.', '101.00', 0, 'f2bcb880208c13f7e795976ab00f8973.jpg', '38a55fdd152d721f385094766aabe5e4.jpg', 'DK2087', 7, '2014-02-26 16:48:48', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `tbl_shipping`
--

INSERT INTO `tbl_shipping` (`sh_id`, `sh_session`, `sh_name`, `sh_phone`, `sh_email`, `sh_city`, `sh_address`, `sh_ship`, `sh_uid`, `sh_flag`) VALUES
(2, '7ohrcem9n0nil6gj1c72bsllf1', 'abj', '123', 'example@email.com', 'aodj', '', 'cour', 0, 1),
(3, 'fvm381k3b85h4g1vnred5c5tv3', 'asdfasdf', '545454545151', 'asfas@sdfaasdf.rr', 'sdafasdf', '', 'cod', 0, 0),
(4, 'vijlr0v1hfq5vf8jlbka3kmn31', 'Artem Petrenko', '380509221571', 'chaos.laert@gmail.com', 'Dnipropetrovsk', 'Minina 3/149', 'cod', 0, 1);

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
('KeyShop - Механические клавиатуры', '\n', '050 922 15 71', 'keyshop.ua@gmail.com', '0.00', 4, 'y', '12.00');

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
(1, 'admin', '7e212e2b0d60f7f4124a17af060f7566', '2005-02-20 17:35:44', '2014-05-24 12:07:42'),
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
