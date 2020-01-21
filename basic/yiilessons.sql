-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 21 2020 г., 09:59
-- Версия сервера: 5.6.41
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yiilessons`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1579535892),
('m200120_160147_create_tasks_table', 1579536919),
('m200120_201742_create_users_table', 1579551791);

-- --------------------------------------------------------

--
-- Структура таблицы `taskdb`
--

CREATE TABLE `taskdb` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `responsible_id` int(11) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `taskdb`
--

INSERT INTO `taskdb` (`id`, `title`, `description`, `creator_id`, `responsible_id`, `deadline`, `status_id`) VALUES
(1, '1', 'Применить миграцию с урока. На страничке task/index вывести имена всех задач в таблице tasks (В БД данные можно внести вручную). Использовать ActiveRecord.', 1, 3, '2020-01-21 15:55:00', 1),
(2, '2', 'Создать табличку пользователей (users) используя механизм миграций.', 1, 3, '2020-01-21 16:00:00', 1),
(3, '3*', 'Настроить авторизацию таким образом, чтобы она происходила через БД, а не заглушки.', 1, 2, '2020-01-21 16:05:00', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `usersdb`
--

CREATE TABLE `usersdb` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `usersdb`
--

INSERT INTO `usersdb` (`id`, `login`, `name`, `password`) VALUES
(1, 'admin', 'Поляков И.', 'adminadmin'),
(2, 'demo', 'Любой Человек.', 'demodemo'),
(3, 'Nastya', 'Большакова А.', 'NastyaNastya');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `taskdb`
--
ALTER TABLE `taskdb`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `usersdb`
--
ALTER TABLE `usersdb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `taskdb`
--
ALTER TABLE `taskdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `usersdb`
--
ALTER TABLE `usersdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
