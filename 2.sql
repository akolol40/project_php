-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Июн 15 2020 г., 23:44
-- Версия сервера: 5.7.26
-- Версия PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `test_samson`
--

-- --------------------------------------------------------

--
-- Структура таблицы `a_category`
--

CREATE TABLE `a_category` (
  `ид` int(11) NOT NULL,
  `код` int(11) NOT NULL,
  `название` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_category`
--

INSERT INTO `a_category` (`ид`, `код`, `название`) VALUES
(100015, 201, 'Бумага'),
(100016, 202, 'Бумага'),
(100017, 302, 'Принтеры'),
(100018, 302, 'МФУ'),
(100019, 305, 'Принтеры'),
(100020, 305, 'МФУ');

-- --------------------------------------------------------

--
-- Структура таблицы `a_ price`
--

CREATE TABLE `a_ price` (
  `Товар` int(255) NOT NULL,
  `Тип` varchar(255) NOT NULL,
  `Цена` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_ price`
--

INSERT INTO `a_ price` (`Товар`, `Тип`, `Цена`) VALUES
(100015, 'Базовая', 11.5),
(100015, 'Москва', 12.5),
(100016, 'Базовая', 18.5),
(100016, 'Москва', 22.5),
(100018, 'Базовая', 3010),
(100018, 'Москва', 3500),
(100020, 'Базовая', 3310),
(100020, 'Москва', 2999);

-- --------------------------------------------------------

--
-- Структура таблицы `a_product`
--

CREATE TABLE `a_product` (
  `ид` int(11) NOT NULL,
  `код` int(11) NOT NULL,
  `название` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_product`
--

INSERT INTO `a_product` (`ид`, `код`, `название`) VALUES
(100015, 201, 'Бумага А4'),
(100016, 202, 'Бумага А3'),
(100017, 302, 'Принтер Canon'),
(100018, 302, 'Принтер Canon'),
(100019, 305, 'Принтер HP'),
(100020, 305, 'Принтер HP');

-- --------------------------------------------------------

--
-- Структура таблицы `a_property`
--

CREATE TABLE `a_property` (
  `Товар` varchar(255) NOT NULL,
  `Значение` varchar(255) NOT NULL,
  `Свойства` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `a_property`
--

INSERT INTO `a_property` (`Товар`, `Значение`, `Свойства`) VALUES
('Бумага А4', '100', 'Плотность'),
('Бумага А4', '150', 'Белизна'),
('Бумага А3', '90', 'Плотность'),
('Бумага А3', '100', 'Белизна'),
('Принтер Canon', 'A4', 'Формат'),
('Принтер Canon', 'A3', 'Формат'),
('Принтер Canon', 'Лазерный', 'Тип'),
('Принтер HP', 'A3', 'Формат'),
('Принтер HP', 'Лазерный', 'Тип');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `a_category`
--
ALTER TABLE `a_category`
  ADD PRIMARY KEY (`ид`),
  ADD KEY `ид` (`ид`);

--
-- Индексы таблицы `a_ price`
--
ALTER TABLE `a_ price`
  ADD KEY `Товар` (`Товар`);

--
-- Индексы таблицы `a_product`
--
ALTER TABLE `a_product`
  ADD PRIMARY KEY (`ид`),
  ADD KEY `ид` (`ид`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `a_ price`
--
ALTER TABLE `a_ price`
  MODIFY `Товар` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100029;

--
-- AUTO_INCREMENT для таблицы `a_product`
--
ALTER TABLE `a_product`
  MODIFY `ид` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100021;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `a_category`
--
ALTER TABLE `a_category`
  ADD CONSTRAINT `a_category_ibfk_1` FOREIGN KEY (`ид`) REFERENCES `a_product` (`ид`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `a_ price`
--
ALTER TABLE `a_ price`
<<<<<<< HEAD
  ADD CONSTRAINT `a_ price_ibfk_1` FOREIGN KEY (`Товар`) REFERENCES `a_product` (`ид`);
=======
  ADD CONSTRAINT `a_ price_ibfk_1` FOREIGN KEY (`Товар`) REFERENCES `a_product` (`ид`);
>>>>>>> 22fffb4fa6b5e54416b2ad8ed61784383dee571b
