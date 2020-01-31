-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 31 2020 г., 21:21
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
('m200120_201742_create_users_table', 1579551791),
('m200128_045050_add_columns_tasks_table', 1580187600);

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
  `status_id` int(11) DEFAULT NULL,
  `starttime` datetime NOT NULL,
  `modifytime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `taskdb`
--

INSERT INTO `taskdb` (`id`, `title`, `description`, `creator_id`, `responsible_id`, `deadline`, `status_id`, `starttime`, `modifytime`) VALUES
(1, 'Урок 2. Задача 1', 'Применить миграцию с урока. На страничке task/index вывести имена всех задач в таблице tasks (в БД данные можно внести вручную). Использовать ActiveRecord.', 1, 3, '2020-01-21 15:55:00', 1, '2020-01-14 22:00:00', '2020-01-30 18:47:27'),
(2, 'Урок 2. Задача 2', 'Создать табличку пользователей (users) используя механизм миграций.', 1, 3, '2020-01-21 16:00:00', 1, '2020-01-14 22:00:00', '2020-01-30 18:32:57'),
(3, 'Урок 2. Задача 3*', 'Настроить авторизацию таким образом, чтобы она происходила через БД, а не заглушки.', 1, 2, '2020-01-21 16:05:00', 0, '2020-01-14 22:00:00', '2020-01-30 18:33:04'),
(4, 'Урок 3. Задача 1', 'Сделать админку для пользователей, используя генератор кода.', 1, 3, '2020-01-21 06:55:00', 1, '2020-01-18 13:00:00', '2020-01-30 18:33:11'),
(5, 'Урок 3. Задача 2', 'Сделать страницу списка задач. Каждая задача на странице должна быть представлена карточкой-превью. Каждая карточка должна быть виджетом. А сами карточки должны выводиться при помощи виджета listView. ', 1, 3, '2020-01-21 07:00:00', 1, '2020-01-18 13:00:00', '2020-01-30 18:33:18'),
(6, 'Урок 3. Задача 3*', 'Создать страницу для регстрации нового пользователя (использовать ActiveForm).', 1, 2, '2020-01-21 07:05:00', 0, '2020-01-18 13:00:00', '2020-01-30 18:33:26'),
(7, 'Урок 3. Задача 4*', 'В админке сделать выпадающие списки для связанных сущностей.', 5, 2, '2020-01-21 07:10:00', 0, '2020-01-18 13:00:00', '2020-01-30 18:33:37'),
(8, 'Урок 4. Задача 1.', 'Используя механизм событий, при создании новой задачи отправлять ответсвенному оповещение на почту', 5, 4, '2020-01-28 15:55:00', 1, '2020-01-28 14:43:39', '2020-01-30 18:33:44'),
(9, 'Урок 4. Задача 2.', 'Используя TimestampBehavior обеспечить сохранение в базе данных о дате изменения/обновления записи', 5, 3, '2020-01-28 15:55:00', 1, '2020-01-28 14:46:02', '2020-01-30 18:33:51'),
(10, 'Урок 5. Задача 1.', 'Сделать страницу с информацией о задаче (с возможностью редактировать и сохранять)', 5, 3, '2020-02-01 06:55:00', 1, '2020-01-30 19:37:17', '2020-01-31 19:19:17'),
(11, 'Урок 5. Задача 2.', 'На главной странице сделать возможность фильтровать задачи по месяцам.', 5, 3, '2020-02-01 06:55:00', 1, '2020-01-31 19:20:07', '2020-01-31 19:20:07'),
(12, 'Урок 5. Задача 3.', 'На главной странице кэшировать рузультат выполнения запроса тасков (по месяцам).', 5, 3, '2020-02-01 06:55:00', 1, '2020-01-31 19:23:03', '2020-01-31 19:23:03'),
(13, 'Урок 5. Задача 4.', 'Кэшировать страницу About целиком.', 5, 3, '2020-02-01 07:00:00', 1, '2020-01-31 19:24:14', '2020-01-31 21:18:26'),
(14, 'Урок 5. Задача 5*.', 'В качестве компонента кэширования использовать redis.', 5, 2, '2020-02-01 07:05:00', 0, '2020-01-31 19:25:40', '2020-01-31 19:25:40');

-- --------------------------------------------------------

--
-- Структура таблицы `usersdb`
--

CREATE TABLE `usersdb` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `usersdb`
--

INSERT INTO `usersdb` (`id`, `login`, `name`, `password`, `email`) VALUES
(1, 'admin', 'Полуянов И.', 'adminadmin', 'admin@site.ru'),
(2, 'demo', 'Любой Человек.', 'demodemo', 'demo@site.ru'),
(3, 'Nastya', 'Большакова А.', 'NastyaNastya', 'nastya@mail.ru'),
(4, 'Pupkin', 'Пупкин Ж.', 'qwerty', 'email@mail.ru'),
(5, 'Trouble', 'Трудный Б.', 'TroubleTrouble', 'trouble@mail.ru');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `usersdb_ibfk_2` (`responsible_id`),
  ADD KEY `usersdb_ibfk_1` (`creator_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `usersdb`
--
ALTER TABLE `usersdb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `taskdb`
--
ALTER TABLE `taskdb`
  ADD CONSTRAINT `usersdb_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `usersdb` (`id`),
  ADD CONSTRAINT `usersdb_ibfk_2` FOREIGN KEY (`responsible_id`) REFERENCES `usersdb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
