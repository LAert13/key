-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 19 2014 г., 18:35
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
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pg_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `pg_title` varchar(50) DEFAULT NULL,
  `pg_parent` smallint(5) NOT NULL DEFAULT '0',
  `pg_alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`pg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
