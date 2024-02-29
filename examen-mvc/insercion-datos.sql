SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: "mydb"
--

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla "usuario"
--

USE mydb;

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellido`, `sexo`, `edad`, `complexion` , `telefono`) VALUES
(1, "Diego", "Cadenillas", "M", 21, "Delgada", "665472493"),
(2, "Carlos", "Nájar", "M", 18, "Promedio", "668578492"),
(3, "Paco", "Barbero", "M", 36, "Promedio", "667723484"),
(4, "Elizabeth", "Meneses", "F", 67, "Robusta", "665434575"),
(5, "Andrey", "Garrido", "M", 24, "Delgada", "665245311"),
(6, "Mariana", "Catalá", "F", 26, "Delgada", "668345689"),
(7, "Yaneth", "Comino", "F", 38, "Robusta", "667668909"),
(8, "Silvana", "Blancas", "F", 44, "Promedio", "665431353"),
(9, "José", "Raposo", "M", 29, "Promedio", "664556423"),
(10, "Jaime", "Cerdá", "M", 48, "Promedio", "667321234");


--
-- Volcado de datos para la tabla "lugar"
--

INSERT INTO `lugar` (`idlugar`, `nombre`, `descripcion`, `tipo`, `provincia`, `localidad` , `direccion`) VALUES
(1, "Restaurante el Mirador", "Un restaurante", 1, "Cádiz", "Jerez de la Frontera", "Av. Mirador"),
(2, "Restaurante Pacotilla", "Otro restaurante", 1, "Cádiz", "El Puerto de Santa María", "Av. Pacotilla"),
(3, "Café/Bar Azaña", "Un café/bar", 2, "Cádiz", "Jerez de la Frontera", "Av. Azaña"),
(4, "Bar El Kiko", "Andaluz", 3, "Cádiz", "Jerez de la Frontera", "Av. Kiko"),
(5, "Bar Er Migué", "Más andaluz", 3, "Cádiz", "Jerez de la Frontera", "Av. Migué"),
(6, "Restaurante Comelón", "Comida por doquier", 1, "Cádiz", "El Puerto de Santa María", "Av. Comelón"),
(7, "Restaurante Faraway Sailor", "Inglés", 1, "Cádiz", "Jerez de la Frontera", "Av. Sailor"),
(8, "Restaurante Runaway Girl", "Kitchen Nightmares", 1, "Cádiz", "El Puerto de Santa María", "Av. Ramsay");

--
-- Volcado de datos para la tabla "review"
--

INSERT INTO `review` (`idreview`, `Descripcion`, `puntuacion`, `usuario_idusuario`) VALUES
(1, "Chico muy majo", 5, 5),
(2, "Tío un poco tacaño", 3, 3),
(3, "Epicardo", 5, 1),
(4, "Molón", 4, 9),
(5, "Divertida", 5, 8),
(6, "Cariñosa", 5, 7),
(7, "Asustadizo", 3, 6),
(8, "Interesante", 4, 4),
(9, "Curioso", 4, 2),
(10, "no", 1, 10);

--
-- Volcado de datos para la tabla "cita"
--

INSERT INTO `cita` (`usuario_propone`, `usuario_acepta`, `fecha`, `descripcion`, `lugar_idlugar`, `review_idreviewpropone` , `review_idreview`, `idcita`) VALUES
(1, 7, "2024-09-25", "Cita", 2, 6, 3, 1),
(5, 6, "2024-08-22", "Cita", 4, 7, 1, 2),
(3, 4, "2024-07-23", "Cita", 6, 8, 2, 3),
(8, 10, "2024-06-27", "Cita", 1, 10, 5, 4),
(2, 9, "2024-05-26", "Cita", 8, 4, 9, 5);