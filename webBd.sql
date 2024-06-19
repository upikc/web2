-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Июн 19 2024 г., 19:00
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `webBd`
--
CREATE DATABASE IF NOT EXISTS `webBd` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `webBd`;

-- --------------------------------------------------------

--
-- Структура таблицы `faves`
--

CREATE TABLE `faves` (
  `faves_id` int NOT NULL,
  `user` int NOT NULL,
  `recipe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `faves`
--

INSERT INTO `faves` (`faves_id`, `user`, `recipe`) VALUES
(45, 1, 2),
(61, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Ingredients`
--

CREATE TABLE `Ingredients` (
  `Ingred_id` int NOT NULL,
  `Ingred_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Ingredients`
--

INSERT INTO `Ingredients` (`Ingred_id`, `Ingred_name`) VALUES
(3, 'лаваш'),
(4, 'мука'),
(1, 'мясо'),
(2, 'овощи'),
(6, 'рис'),
(5, 'хлеб');

-- --------------------------------------------------------

--
-- Структура таблицы `recipes`
--

CREATE TABLE `recipes` (
  `rec_id` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `creactor_id` int NOT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipes`
--

INSERT INTO `recipes` (`rec_id`, `title`, `description`, `creactor_id`, `image`) VALUES
(1, 'шаурма', 'самый вкусный шаурма', 1, 'image_666a2fe49a416.webp'),
(2, 'шаурма_100%vegans', 'описание', 1, 'Meatwrap.webp'),
(3, 'хлеб', 'описание', 2, 'bread.webp'),
(4, 'вареные овощи', 'описание', 2, 'Cooked_Vegetables.webp'),
(5, 'Бутерброд', 'описание', 1, 'Dustwich.webp'),
(6, 'Рис', 'описание', 2, 'Rice_Bowl.webp'),
(7, 'Гохан', 'описание', 1, 'Gohan.webp');

--
-- Триггеры `recipes`
--
DELIMITER $$
CREATE TRIGGER `recipes_BEFORE_DELETE` BEFORE DELETE ON `recipes` FOR EACH ROW BEGIN
	DELETE FROM recipe_tags WHERE r_id = OLD.rec_id;
	DELETE FROM recipe_Ingred WHERE r_id = OLD.rec_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `recipe_Ingred`
--

CREATE TABLE `recipe_Ingred` (
  `id` int NOT NULL,
  `r_id` int NOT NULL,
  `Ingred_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipe_Ingred`
--

INSERT INTO `recipe_Ingred` (`id`, `r_id`, `Ingred_id`) VALUES
(7, 3, 4),
(8, 4, 2),
(9, 5, 1),
(10, 5, 2),
(11, 5, 5),
(12, 6, 6),
(13, 7, 6),
(14, 7, 1),
(15, 7, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `recipe_tags`
--

CREATE TABLE `recipe_tags` (
  `id` int NOT NULL,
  `r_id` int NOT NULL,
  `tag_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `recipe_tags`
--

INSERT INTO `recipe_tags` (`id`, `r_id`, `tag_id`) VALUES
(5, 3, 2),
(6, 4, 1),
(7, 5, 3),
(8, 5, 0),
(9, 6, 1),
(10, 7, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `tag_id` int NOT NULL,
  `tag_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(2, 'в лаваше'),
(1, 'вегетерианское'),
(3, 'перекус'),
(0, 'сочное');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `enable` int NOT NULL,
  `mail` varchar(100) NOT NULL,
  `Admin` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `name`, `lastname`, `password`, `login`, `enable`, `mail`, `Admin`) VALUES
(1, 'U', 'U', '1111', '1111', 1, 'uupikc@gmail.com', 1),
(2, 'upik2', 'upik2', '222', '222', 0, 'uupikc@gmail.com', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `faves`
--
ALTER TABLE `faves`
  ADD PRIMARY KEY (`faves_id`),
  ADD KEY `user_idx` (`user`),
  ADD KEY `recipe_idx` (`recipe`);

--
-- Индексы таблицы `Ingredients`
--
ALTER TABLE `Ingredients`
  ADD PRIMARY KEY (`Ingred_id`),
  ADD UNIQUE KEY `Ingred_name` (`Ingred_name`);

--
-- Индексы таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`rec_id`),
  ADD KEY `creactor_id_idx` (`creactor_id`);

--
-- Индексы таблицы `recipe_Ingred`
--
ALTER TABLE `recipe_Ingred`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_id_idx` (`r_id`),
  ADD KEY `Ingred_id` (`Ingred_id`);

--
-- Индексы таблицы `recipe_tags`
--
ALTER TABLE `recipe_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_id_idx` (`r_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `faves`
--
ALTER TABLE `faves`
  MODIFY `faves_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT для таблицы `Ingredients`
--
ALTER TABLE `Ingredients`
  MODIFY `Ingred_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `recipes`
--
ALTER TABLE `recipes`
  MODIFY `rec_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `recipe_Ingred`
--
ALTER TABLE `recipe_Ingred`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT для таблицы `recipe_tags`
--
ALTER TABLE `recipe_tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `faves`
--
ALTER TABLE `faves`
  ADD CONSTRAINT `recipe` FOREIGN KEY (`recipe`) REFERENCES `recipes` (`rec_id`),
  ADD CONSTRAINT `user` FOREIGN KEY (`user`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `creator_id` FOREIGN KEY (`creactor_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `recipe_Ingred`
--
ALTER TABLE `recipe_Ingred`
  ADD CONSTRAINT `Ingred_id` FOREIGN KEY (`Ingred_id`) REFERENCES `Ingredients` (`Ingred_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `r_id` FOREIGN KEY (`r_id`) REFERENCES `recipes` (`rec_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `recipe_tags`
--
ALTER TABLE `recipe_tags`
  ADD CONSTRAINT `r_id2` FOREIGN KEY (`r_id`) REFERENCES `recipes` (`rec_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
