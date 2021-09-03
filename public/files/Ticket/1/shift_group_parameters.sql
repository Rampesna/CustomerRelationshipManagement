-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Eyl 2021, 16:09:45
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
-- Tablo için tablo yapısı `shift_group_parameters`
--

CREATE TABLE `shift_group_parameters` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
-- Tablo döküm verisi `shift_group_parameters`
--

INSERT INTO `shift_group_parameters` (`id`, `food_break_start`, `food_break_end`, `get_break_while_food_time`, `get_food_break_without_food_time`, `single_break_duration`, `get_first_break_after_shift_start`, `get_last_break_before_shift_end`, `get_break_after_last_break`, `daily_food_break_amount`, `daily_break_duration`, `daily_food_break_duration`, `daily_break_break_duration`, `momentary_food_break_duration`, `momentary_break_break_duration`, `suspend_break_using`) VALUES
(1, '11:00:00', '14:00:00', 0, 1, 60, 45, 45, 60, 1, 100, 30, 70, 30, 15, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `shift_group_parameters`
--
ALTER TABLE `shift_group_parameters`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `shift_group_parameters`
--
ALTER TABLE `shift_group_parameters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
