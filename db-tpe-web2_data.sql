--
-- Volcado de datos para la tabla `career`
--

INSERT INTO `career` (`id`, `name`, `years`, `faculty`) VALUES
(1, 'Tecnicatura Universitaria en Desarrollo de Aplicaiones informaticas', 3, 'Facultad de Ciencias Exactas');
--
-- Volcado de datos para la tabla `subject`
--

INSERT INTO `subject` (`id`, `semester`, `year`, `name`, `direct_requirement`, `career`) VALUES
(1, 1, 1, 'Programación 1', NULL, 1),
(2, 1, 1, 'Web 1', NULL, 1),
(3, 1, 1, 'Taller de Matemática Compuracional ', NULL, 1),
(4, 1, 1, 'Inglés 1', NULL, 1),
(5, 2, 1, 'Tecnología de la Información en las Organizaciones', NULL, 1),
(6, 2, 1, 'Web 2', 2, 1),
(7, 2, 1, 'Programación 2', 1, 1),
(8, 2, 1, 'Inglés 2', 4, 1),
(9, 2, 1, 'Seminario Tecnológico 1', NULL, 1);