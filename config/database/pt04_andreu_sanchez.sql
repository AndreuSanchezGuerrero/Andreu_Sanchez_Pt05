

CREATE DATABASE IF NOT EXISTS `pt04_andreu_sanchez` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `pt04_andreu_sanchez`;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 16:48:32
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt04_andreu_sanchez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `books`
--

INSERT INTO `books` (`id`, `isbn`, `name`, `author`, `user_id`) VALUES
(44, '978-8440220776', 'El misterio de Salem\'s Lot', 'Stephen King', 1),
(45, '978-0765311788', 'The Final Empire', 'Brandon Sanderson', 1),
(46, '978-8498382549', 'Viaje al Reino de la Fantasia', 'L\'avi Pep', 7),
(47, '978-0765316899', 'The Well of Ascension', 'Brandon Sanderson', 1),
(48, '978-0765326355', 'The Hero of Ages', 'Brandon Sanderson', 1),
(49, '978-0765382030', 'The Three-Body Problem', 'Cixin Liu', 1),
(50, '978-0765386694', 'The Dark Forest', 'Cixin Liu', 1),
(51, '978-0765377104', 'Death’s End', 'Cixin Liu', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`, `email`) VALUES
(1, 'admin', '$2y$10$X3DuNPatwvBheXqMdQYYU.DloDeHVk6J.LKHsvtrh4v3Q/t6dSWB.', '2024-10-16 18:16:55', '2024-10-20 20:57:46', 'admin@admin.com'),
(2, 'andreu', '$2y$10$U6ZJsKF5c81PYkl8o5phMOcjKDJWA3P3td8ZWKnmKX8tuMqfTi4Zm', '2024-10-19 17:18:25', '2024-10-19 17:18:25', 'a@a.com'),
(7, 'onieva03', '$2y$10$6nnhPZeU7UaduSPsQaANs./zxpV9vndS0W6eH9Gblm9qyZsQqUK/u', '2024-10-21 13:07:15', '2024-10-21 13:07:15', 'a@a.w');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
