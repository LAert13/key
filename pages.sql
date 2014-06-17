-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 17 2014 г., 17:27
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
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pg_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `pg_title` varchar(50) DEFAULT NULL,
  `pg_parent` smallint(5) NOT NULL DEFAULT '0',
  `pg_alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pg_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`pg_id`, `pg_title`, `pg_parent`, `pg_alias`) VALUES
(1, 'Keyshop', 0, '/'),
(2, 'Магазин', 1, '/shop/'),
(3, 'Вход в интернет-магазин', 1, '/user/login'),
(5, 'Регистрация', 1, '/user/register'),
(6, 'Доставка и оплата', 1, '/info/delivery'),
(7, 'Контакты', 1, '/info/contacts'),
(8, 'Корзина', 1, '/order/cart'),
(9, 'Оформление заказа', 1, '/checkout'),
(10, 'Изменение пароля', 1, '/user/change_pass'),
(11, 'Подтверждение пароля', 1, '/user/confirm_pass'),
(12, 'Редактирование профиля', 1, '/user/edit_profile'),
(13, 'Список заказов', 1, '/user/order_list'),
(14, 'Детали заказа', 1, '/user/order_detail'),
(15, 'Восстановление пароля', 1, '/user/pass_reset'),
(16, 'Список отзывов', 1, '/user/review_list'),
(17, 'Помощь и гарантийные обязательства', 1, '/info/help'),
(18, 'Оформление заказа > Контактная информация', 1, '/order/contactInfo'),
(19, 'Оформление заказа > Подтверждение заказа', 1, '/order/confirmation'),
(20, 'Оформление заказа > Заказ успешен', 1, '/order/success');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
