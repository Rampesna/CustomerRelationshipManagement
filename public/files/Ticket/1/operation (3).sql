-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Eyl 2021, 16:13:30
-- Sunucu sürümü: 10.4.13-MariaDB
-- PHP Sürümü: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `operation`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `shift_groups`
--

CREATE TABLE `shift_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_type` tinyint(1) NOT NULL,
  `per_day` tinyint(3) UNSIGNED DEFAULT NULL,
  `break_duration` tinyint(3) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_if_exist` tinyint(1) NOT NULL,
  `after_sunday` tinyint(1) NOT NULL,
  `set_group_weekly` tinyint(1) NOT NULL,
  `day0` tinyint(1) NOT NULL,
  `day0_start_time` time NOT NULL,
  `day0_end_time` time NOT NULL,
  `day1` tinyint(1) NOT NULL,
  `day1_start_time` time NOT NULL,
  `day1_end_time` time NOT NULL,
  `day2` tinyint(1) NOT NULL,
  `day2_start_time` time NOT NULL,
  `day2_end_time` time NOT NULL,
  `day3` tinyint(1) NOT NULL,
  `day3_start_time` time NOT NULL,
  `day3_end_time` time NOT NULL,
  `day4` tinyint(1) NOT NULL,
  `day4_start_time` time NOT NULL,
  `day4_end_time` time NOT NULL,
  `day5` tinyint(1) NOT NULL,
  `day5_start_time` time NOT NULL,
  `day5_end_time` time NOT NULL,
  `day6` tinyint(1) NOT NULL,
  `day6_start_time` time NOT NULL,
  `day6_end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `food_break_start` time DEFAULT NULL,
  `food_break_end` time DEFAULT NULL,
  `get_break_while_food_time` tinyint(1) NOT NULL,
  `get_food_break_without_food_time` tinyint(1) NOT NULL,
  `single_break_duration` int(11) NOT NULL,
  `get_first_break_after_shift_start` int(11) NOT NULL,
  `get_last_break_before_shift_end` int(11) NOT NULL,
  `get_break_after_last_break` int(11) NOT NULL,
  `daily_food_break_amount` int(11) NOT NULL,
  `daily_break_duration` int(11) NOT NULL,
  `daily_food_break_duration` int(11) NOT NULL,
  `daily_break_break_duration` int(11) NOT NULL,
  `momentary_food_break_duration` int(11) NOT NULL,
  `momentary_break_break_duration` int(11) DEFAULT NULL,
  `suspend_break_using` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `shift_groups`
--

INSERT INTO `shift_groups` (`id`, `order`, `company_id`, `name`, `add_type`, `per_day`, `break_duration`, `description`, `delete_if_exist`, `after_sunday`, `set_group_weekly`, `day0`, `day0_start_time`, `day0_end_time`, `day1`, `day1_start_time`, `day1_end_time`, `day2`, `day2_start_time`, `day2_end_time`, `day3`, `day3_start_time`, `day3_end_time`, `day4`, `day4_start_time`, `day4_end_time`, `day5`, `day5_start_time`, `day5_end_time`, `day6`, `day6_start_time`, `day6_end_time`, `created_at`, `updated_at`, `deleted_at`, `food_break_start`, `food_break_end`, `get_break_while_food_time`, `get_food_break_without_food_time`, `single_break_duration`, `get_first_break_after_shift_start`, `get_last_break_before_shift_end`, `get_break_after_last_break`, `daily_food_break_amount`, `daily_break_duration`, `daily_food_break_duration`, `daily_break_break_duration`, `momentary_food_break_duration`, `momentary_break_break_duration`, `suspend_break_using`) VALUES
(3, 1, 1, 'Parametrik Test', 1, NULL, 100, 'Test', 1, 0, 0, 0, '09:00:00', '18:00:00', 1, '09:00:00', '18:00:00', 1, '09:00:00', '18:00:00', 1, '09:00:00', '18:00:00', 1, '09:00:00', '18:00:00', 1, '09:00:00', '18:00:00', 1, '09:00:00', '18:00:00', '2021-09-01 11:56:15', '2021-09-01 08:56:15', NULL, '11:00:00', '14:00:00', 0, 0, 60, 45, 45, 60, 1, 100, 30, 70, 30, 15, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `shift_groups`
--
ALTER TABLE `shift_groups`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `shift_groups`
--
ALTER TABLE `shift_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
