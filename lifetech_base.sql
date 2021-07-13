-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 12 2021 г., 09:32
-- Версия сервера: 10.4.17-MariaDB
-- Версия PHP: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lifetech_base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` enum('bor','yoq') NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `costs`
--

CREATE TABLE `costs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `costs`
--

INSERT INTO `costs` (`id`, `name`, `created_at`) VALUES
(1, 'Hodimlar oyligi', '2021-07-06 03:16:38'),
(2, 'Oziq ovqatga', '2021-07-06 03:16:38'),
(3, 'Reklamaga', '2021-07-06 03:16:42'),
(4, 'Boshqa chiqmlarga', '2021-07-06 03:16:42');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `month` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `name`, `price`, `month`, `created_at`) VALUES
(2, 'Java (Android)', '400000', '6', '2021-07-02 16:24:58'),
(4, 'Robotatexnika', '400000', '3', '2021-07-02 16:24:58'),
(5, 'Kompyuter grafikasi', '400000', '3', '2021-07-03 05:50:45'),
(11, 'Web dasturlash', '400000', '10', '2021-07-05 18:37:34'),
(12, 'Kompyuter savodhonligi', '250000', '2', '2021-07-05 22:47:15'),
(13, 'SMM', '500000', '2', '2021-07-05 22:47:31'),
(14, 'asdasd', '3000', '1', '2021-07-05 23:42:05');

-- --------------------------------------------------------

--
-- Структура таблицы `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `money` varchar(50) NOT NULL,
  `cost_id` int(11) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `money`, `cost_id`, `comment`, `updated_at`, `created_at`) VALUES
(1, 'Aftobusga', '120000', 3, '', '0000-00-00 00:00:00', '2021-07-06 03:18:01'),
(2, 'Abetga', '50000', 2, '', '0000-00-00 00:00:00', '2021-07-06 03:18:04');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `course_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `days` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `type` int(3) NOT NULL COMMENT '1-guruh; 2-indvidual',
  `status` int(3) NOT NULL COMMENT '1-new; 2-study; 3-graduated',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `course_id`, `teacher_id`, `days`, `time`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'web', 11, 3, '1;0;1;0;1;0;0', '10:30:00', 1, 2, '2021-07-06 11:05:48', '2021-07-06 11:05:48'),
(2, 'java', 2, 6, '0;1;0;1;0;1;0', '09:00:00', 1, 2, '2021-07-06 11:05:48', '2021-07-06 22:26:26'),
(4, 'smm', 13, 18, '1;0;1;0;1;0;0', '10:00:00', 1, 1, '2021-07-06 22:32:37', '2021-07-07 08:23:27'),
(5, 'roboto', 4, 18, '1;0;1;0;1;0;0', '09:00:00', 1, 1, '2021-07-08 10:37:42', '2021-07-08 10:37:42'),
(6, 'sv', 12, 3, '1;0;1;0;1;0;0', '10:30:00', 1, 1, '2021-07-08 10:49:55', '2021-07-08 10:49:55');

-- --------------------------------------------------------

--
-- Структура таблицы `group_students`
--

CREATE TABLE `group_students` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group_students`
--

INSERT INTO `group_students` (`group_id`, `student_id`) VALUES
(1, 4),
(1, 7),
(1, 17),
(2, 4),
(2, 11),
(4, 10),
(6, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `total` varchar(100) NOT NULL,
  `month` int(3) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `discount_type` int(3) NOT NULL COMMENT '0-no discount;\r\n1-cash;\r\n2-percent %;',
  `discount_val` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`id`, `group_id`, `student_id`, `total`, `month`, `discount`, `discount_type`, `discount_val`, `updated_at`, `created_at`) VALUES
(1, 2, 4, '400000', 1, '50000', 1, '50000', '0000-00-00 00:00:00', '2021-07-08 09:55:53'),
(2, 2, 4, '400000', 2, '40000', 2, '10', '0000-00-00 00:00:00', '2021-07-08 09:56:38'),
(3, 2, 4, '400000', 3, '0', 0, '0', '0000-00-00 00:00:00', '2021-07-08 09:56:46'),
(4, 1, 4, '400000', 1, '0', 0, '0', '0000-00-00 00:00:00', '2021-07-10 04:45:44'),
(5, 1, 7, '400000', 1, '40000', 1, '40000', '0000-00-00 00:00:00', '2021-07-10 04:50:13');

-- --------------------------------------------------------

--
-- Структура таблицы `payment_detalies`
--

CREATE TABLE `payment_detalies` (
  `id` int(11) UNSIGNED NOT NULL,
  `payment_id` int(11) UNSIGNED NOT NULL,
  `paid` varchar(100) NOT NULL,
  `payment_type` int(3) NOT NULL COMMENT '1-cash;\r\n2-plastic;\r\n3-click;',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment_detalies`
--

INSERT INTO `payment_detalies` (`id`, `payment_id`, `paid`, `payment_type`, `updated_at`, `created_at`) VALUES
(1, 1, '350000', 1, '2021-07-09 09:29:41', '2021-07-09 09:29:41'),
(2, 2, '300000', 1, '2021-07-09 09:29:41', '2021-07-09 09:29:41'),
(3, 3, '250000', 1, '2021-07-09 10:51:12', '2021-07-09 10:51:12'),
(4, 3, '100000', 2, '0000-00-00 00:00:00', '2021-07-09 19:40:03'),
(5, 4, '350000', 1, '0000-00-00 00:00:00', '2021-07-10 04:46:27'),
(6, 5, '300000', 1, '0000-00-00 00:00:00', '2021-07-10 04:50:57'),
(7, 5, '60000', 2, '0000-00-00 00:00:00', '2021-07-10 04:51:11');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `utype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(3) NOT NULL COMMENT '1-new, 2-study, 3-graduated',
  `gender` int(3) NOT NULL,
  `born` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `advertising` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'reklama',
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `phone`, `utype`, `course_ids`, `status`, `gender`, `born`, `address`, `advertising`, `company`, `email`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ismoil', '$2y$10$zhMdf27Z/staHrq0AIVRn.bB5ns1ZkOTtn/w70zX43HP2K8gbVXDC', 'Ismoil', 'Maxmudov', '+998(99) 833 20-87', 'admin', '', 1, 1, '2021-06-12', 'Dangara tumani', '', 'lifetech', '', NULL, NULL, '2021-07-02 08:16:39', '2021-07-05 07:58:42'),
(2, '1625461310', '1', 'Ozodbek', 'Aliyev', '+998(97) 123 45-67', 'student', '4;13', 1, 1, '1998-04-03', 'uchko\'prik', 'aftobusda', 'maktab', 'student1625461310@gmail.com', NULL, NULL, '2021-07-05 00:01:50', '2021-07-05 16:55:34'),
(3, 'oybak', '$2y$10$9WdFANUWHXE42h.aALRIIuyvd67nTH0cz.u2Y4PyFyfCQjhthpa8y', 'Oybekjon', 'Soataliyev', '+998(91) 789 45-63', 'teacher', '11;12', 1, 1, '1992-07-07', 'Dangara tumani', '', 'lifetech', 'oybekjonsoataliyev@gmail.com', NULL, NULL, '2021-07-05 00:19:46', '2021-07-06 13:57:27'),
(4, '1625462561', '1', 'Bunyodjon', 'Ergashev', '+998(99) 899 89-05', 'student', '5;11', 2, 1, '2001-07-14', 'dangara tumani', 'ko\'chada', 'QDPI', 'student1625462561@gmail.com', NULL, NULL, '2021-07-05 00:22:41', '2021-07-05 16:56:19'),
(6, 'urinboy', '$2y$10$Kix4uqGTUgma4i4xydm9Gu5FhbMZenBvT2sqQD.HjSRa4uqxUIBtC', 'O\'rinboy', 'Naziraliyev', '+99899 3979617', 'teacher', '2;12', 1, 1, '1996-12-12', 'Bog\'dot tumani', '', 'lifetech', 'student1625463701@gmail.com', NULL, NULL, '2021-07-05 00:41:41', '2021-07-06 13:57:14'),
(7, '', '', 'yaxyobek', 'Maxmudov', '+998(99) 878 77-54', 'student', '4;10;11', 2, 1, '1212-12-12', 'fsdfd', '', 'ss', 'student1625464470@gmail.com', NULL, NULL, '2021-07-05 00:54:30', '2021-07-05 08:38:05'),
(8, '', '', 'Ismoil', '111', '+998(99) 899 84-24', 'student', '4;11', 2, 1, '2021-07-07', '22525', '', 'lifetech', 'student1625464551@gmail.com', NULL, NULL, '2021-07-05 00:55:51', '2021-07-05 12:57:14'),
(9, '', '', 'dsfsdf', 'sdfsdfds', '+998(99) 823 12-32', 'student', '4;10', 2, 1, '2021-07-08', 'sdsfdsf', '', 'lifetech', 'student1625464578@gmail.com', NULL, NULL, '2021-07-05 00:56:18', '2021-07-05 08:38:13'),
(10, '', '', 'Admadjon', 'rustamov', '+998(90) 123 45-67', 'student', '2;4;13', 2, 1, '2001-06-30', 'furqat tumani', 'telegramdan', 'beline ofis', 'student1625474150@gmail.com', NULL, NULL, '2021-07-05 03:35:50', '2021-07-05 16:57:25'),
(11, '', '', 'Risolat', 'Ergasheva', '+998(99) 899 89-45', 'student', '10;11', 2, 0, '2021-07-02', 'sdfsd', '', 'lifetech', 'student1625474190@gmail.com', NULL, NULL, '2021-07-05 03:36:30', '2021-07-05 08:38:20'),
(12, '', '', 'Rustam', 'Ahmedov', '+998(99) 899 89-72', 'student', '5;12', 1, 1, '2000-07-08', 'qoqon', '123', 'budbolka sexi', 'student1625474217@gmail.com', NULL, NULL, '2021-07-05 03:36:57', '2021-07-05 16:58:42'),
(15, '', '', '222', '3333', '+998(99) 856 56-56', 'student', '4;11;12', 2, 1, '0005-06-05', '656565', '', 'lifetech', 'student1625493222@gmail.com', NULL, NULL, '2021-07-05 08:53:42', '2021-07-08 01:44:03'),
(16, '', '', 'Oybekjon', 'toy bola', '+998(99) 899 89-72', 'student', '2;12;13', 2, 1, '2021-06-30', 'Dangara tumani', '', 'lifetech', 'student1625507874@gmail.com', NULL, NULL, '2021-07-05 12:57:54', '2021-07-05 12:58:42'),
(17, '', '', 'Sobirjon', 'Yusupov', '+998(99) 898 98-98', 'student', '4;11;13', 2, 1, '1997-07-08', 'Bogdot tumani', '', 'asdf', 'student1625510553@gmail.com', NULL, NULL, '2021-07-05 13:42:33', '2021-07-05 16:59:23'),
(18, 'Solijon', '$2y$10$DQRc2gKtA74JdPNfHNiUWeJgYl1mf1itKIw1L4V7O0MkdSXPODRMS', 'Solijon', 'Aliyev', '+998+998331891995', 'teacher', '4;12;13', 1, 1, '1995-07-02', 'asdasd', '', 'lifetech', 'teacher1625515145@gmail.com', NULL, NULL, '2021-07-05 14:59:05', '2021-07-06 13:57:37'),
(19, 'nodir', '$2y$10$1NaXHMdpDkkGOkT/aFjiI.mkRucM9cD6HShAgOborvOLvT6maevUy', 'Nodir', 'test', '+998+998 97 4156663', 'teacher', '11', 1, 1, '2021-07-02', 'asdasd', '', 'lifetech', 'teacher1625515221@gmail.com', NULL, NULL, '2021-07-05 15:00:21', '2021-07-06 13:57:46'),
(21, '', '', 'Dilshodjon', 'Haydarov', '+998(99) 898 99-85', 'student', '2;12;14', 2, 1, '2003-05-12', 'ozbekiston', '', 'lifetech', 'student1625522045@gmail.com', NULL, NULL, '2021-07-05 16:54:05', '2021-07-05 16:54:20');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`cost_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`course_id`,`teacher_id`);

--
-- Индексы таблицы `group_students`
--
ALTER TABLE `group_students`
  ADD KEY `group_id` (`group_id`,`student_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`group_id`,`student_id`);

--
-- Индексы таблицы `payment_detalies`
--
ALTER TABLE `payment_detalies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `costs`
--
ALTER TABLE `costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `payment_detalies`
--
ALTER TABLE `payment_detalies`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `group_students`
--
ALTER TABLE `group_students`
  ADD CONSTRAINT `group_students_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
