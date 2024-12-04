-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: proxysql-01.dd.scip.local
-- Tiempo de generación: 04-12-2024 a las 17:42:15
-- Versión del servidor: 10.10.2-MariaDB-1:10.10.2+maria~deb11
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ddb238778`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `books`
--

CREATE DATABASE IF NOT EXISTS `ddb238778` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `ddb238778`;

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
(51, '978-0765377104', 'Death’s End', 'Cixin Liu', 1),
(55, '978-8440220770', 'nbhvhv', 'fdgc', 1),
(57, '978-8466657662', 'Stormlight 2', 'Brandon Sanderson', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `o_auth_accounts`
--

CREATE TABLE `o_auth_accounts` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `photo_profile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `o_auth_accounts`
--

INSERT INTO `o_auth_accounts` (`id`, `username`, `email`, `bio`, `photo_profile`, `created_at`, `updated_at`) VALUES
('107800185000533061309', 'El menda', 'oAuthAccount@andreu sánchez guerrero-64545046oyfezd.com', 's', '107800185000533061309.jpg', '2024-11-30 18:10:53', '2024-11-30 22:57:39'),
('123182864', 'andreu sánchez guerrero-74865151wvidzn', 'oAuthAccount@andreu sánchez guerrero-74865151wvidzn.com', '', '123182864.png', '2024-11-30 22:59:47', '2024-11-30 23:00:30'),
('108099231908400187533', 'andreu sánchez guerrero-14191545sgtfyc', 'oAuthAccount@andreu sánchez guerrero-14191545sgtfyc.com', '', '108099231908400187533.enc', '2024-12-02 14:49:43', '2024-12-02 14:50:34');

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
  `email` varchar(255) NOT NULL,
  `photo_profile` varchar(255) DEFAULT 'default-user.png',
  `bio` text DEFAULT 'This is my bio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`, `email`, `photo_profile`, `bio`) VALUES
(1, 'xavi', '$2y$10$h8Fo1rT7VodZ4wfmUHamo.i2O1TbQ3saGpA7DYV4P5SpYh3G/oMLK', '2024-10-16 18:16:55', '2024-11-22 18:28:45', 'backendisthedarkside@gmail.com', '1.webp', 'This is my bio'),
(7, 'onieva03', '$2y$10$6nnhPZeU7UaduSPsQaANs./zxpV9vndS0W6eH9Gblm9qyZsQqUK/u', '2024-10-21 13:07:15', '2024-10-29 18:24:42', 's.onieva@sapalomera.cat', 'default-user.png', 'This is my bio'),
(8, 'admin', '$2y$10$WeISudShxxw7EqJxDPGpnewXqkVuiWWM3SR.hZrh7pLlvbgiNa71S', '2024-10-29 18:45:02', '2024-11-22 18:20:26', 'a.sanchez11@sapalomera.cat', '8.jpg', 'Hola Admin'),
(13, 'andreu', '$2y$10$VVFJwNqPiQEGrMDqArkm3e/RPP6HV8MZgXeUNMNtj0LhWlqlcuA/i', '2024-11-01 16:59:27', '2024-11-19 19:16:47', 'andreu.s.g30@gmail.com', '13.jpg', 'El bicho'),
(14, 'Prueba', '$2y$10$NUMYtr0X0DWETr6pcS8hgeH9ddhBhIW2fr5fQ45YgAo8bkSWeSpim', '2024-11-28 14:40:36', '2024-11-28 14:40:36', 'prueba@prueba.com', 'default-user.png', 'This is my bio'),
(15, 'Andreu2', '$2y$10$e/.ChWTsiHwvtv6PZ6lyRuGHEmsrVoESi5Rp.LuFn6Al7Je2ZMWb.', '2024-12-04 14:36:21', '2024-12-04 14:36:21', 'abdnha@dnsjdn.com', 'default-user.png', 'This is my bio');

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
-- Indices de la tabla `o_auth_accounts`
--
ALTER TABLE `o_auth_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
