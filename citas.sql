-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2024 a las 05:12:16
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agendar_cita`
--

CREATE TABLE `agendar_cita` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `especialidad` varchar(100) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`id`, `nombre`) VALUES
(1, 'odontología'),
(2, 'Psicologia '),
(3, 'Pediatria '),
(6, 'Fisioterapeuta ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `Dia` date NOT NULL,
  `Hora` time NOT NULL,
  `especialidad` varchar(50) NOT NULL,
  `id_medico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id`, `Dia`, `Hora`, `especialidad`, `id_medico`) VALUES
(1, '2024-05-16', '12:49:00', 'Psicologia', 9),
(2, '2024-05-08', '12:09:24', '', 4),
(3, '2024-05-14', '11:22:00', '', 0),
(4, '2024-05-13', '06:00:00', '', 0),
(5, '2024-05-14', '06:00:00', '', 4),
(6, '2024-05-01', '16:21:00', '', 5),
(7, '2024-05-13', '21:23:00', '', 5),
(8, '2024-05-01', '10:00:00', '', 5),
(9, '2024-05-02', '09:00:00', 'odontología', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `TipoIdentificacion` varchar(100) NOT NULL,
  `Num_identificacion` int(11) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `Fecha_nacimiento` date NOT NULL,
  `rol` varchar(100) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `Contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `Nombre`, `Apellido`, `TipoIdentificacion`, `Num_identificacion`, `direccion`, `Fecha_nacimiento`, `rol`, `id_especialidad`, `correo`, `Contraseña`) VALUES
(1, 'Juan', 'Arrieta', 'CC', 1193358966, 'Calle 27a #31-5', '2003-04-19', 'administrador', 0, 'admin@example.com', 'admin'),
(2, 'Juan', 'Arrieta', 'Cédula de Ciudadanía (CC)', 1928384, 'Calle 27a #31-3', '2003-10-10', '', 0, 'juandanielarrieta23@gmail.com', '123'),
(3, 'Alex', 'Gonzalez', 'TI', 1193118830, 'Corozal', '2024-05-02', 'Administrador', 0, 'alexgonzalez@gmail.com', '12345'),
(4, 'Pedro', 'Gonzalez Monterroza', 'CC', 3244, 'Cra 24# 37a-13', '2024-05-07', 'Medico', 2, 'Alex@asda', 'sadd'),
(5, 'Alex', 'Gonzalez Monterroza', 'CC', 0, 'Cra 24# 37a-13', '0000-00-00', 'Medico', 1, 'Alex@dsasda', 'dsadsd'),
(6, 'Juan', 'saddsadsa', 'CC', 0, 'Cra 24# 37a-13', '2024-04-30', 'Medico', 6, 'Alex@sadad', 'dsadda'),
(7, 'Alex', 'Gonzalez Monterroza', 'CC', 1193118830, 'Cra 24# 37a-13', '0000-00-00', 'Medico', 0, 'Alex@gmail.com', 'dfdfd'),
(8, '', '', '', 0, '', '0000-00-00', '', 0, '', ''),
(9, 'Josee', 'Arrieta', 'CE', 1193358966, 'Calle 27a #31-5', '2024-05-07', 'Medico', 3, 'jose@gmail.com', '123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agendar_cita`
--
ALTER TABLE `agendar_cita`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_medico` (`id_medico`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agendar_cita`
--
ALTER TABLE `agendar_cita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
