-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-04-2017 a las 23:45:00
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `global_death`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `user_admin` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id_admin`, `user_admin`, `password`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contador`
--

CREATE TABLE `contador` (
  `id` int(11) NOT NULL,
  `ip` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `num_votos` varchar(30) COLLATE utf8_spanish2_ci NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `contador`
--

INSERT INTO `contador` (`id`, `ip`, `num_votos`, `fecha`) VALUES
(1, '127.0.0.1', '1', '2017-03-26 19:54:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conversation`
--

CREATE TABLE `conversation` (
  `id_conversations` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `user_name` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `message` mediumtext COLLATE utf8_spanish2_ci NOT NULL,
  `date_message` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `entrada_users` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `salida_users` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `user` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `id_de` int(11) NOT NULL,
  `id_para` int(11) NOT NULL,
  `message` varchar(10000) COLLATE utf8_spanish2_ci NOT NULL,
  `date_registry` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `visto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id_blog` int(11) NOT NULL,
  `categoria` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `tema` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `article` mediumtext COLLATE utf8_spanish2_ci NOT NULL,
  `img` longblob NOT NULL,
  `alt` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `nameimg` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `date` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `autor` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `rango` int(11) NOT NULL DEFAULT '0',
  `users` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `date_registry` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `date_update` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `online` datetime NOT NULL,
  `limite` datetime NOT NULL,
  `block` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `foto_user` longblob NOT NULL,
  `name_foto` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  `alt_foto` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indices de la tabla `contador`
--
ALTER TABLE `contador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id_conversations`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contador`
--
ALTER TABLE `contador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id_conversations` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
