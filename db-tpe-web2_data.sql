INSERT INTO career (id, name, years, faculty) VALUES
    (NULL, 'Tecnicatura Universitaria en Desarrollo de Aplicaiones informaticas', 3, 'Facultad de Ciencias Exactas');

INSERT INTO subject (id, semester, year, name, direct_requirement, career) VALUES
    (NULL, 1, 1, 'Programación 1', NULL, 1),
    (NULL, 1, 1, 'Web 1', NULL, 1),
    (NULL, 1, 1, 'Taller de Matemática Compuracional ', NULL, 1),
    (NULL, 1, 1, 'Inglés 1', NULL, 1),
    (NULL, 2, 1, 'Tecnología de la Información en las Organizaciones', NULL, 1),
    (NULL, 2, 1, 'Web 2', 2, 1),
    (NULL, 2, 1, 'Programación 2', 1, 1),
    (NULL, 2, 1, 'Inglés 2', 4, 1),
    (NULL, 2, 1, 'Seminario Tecnológico 1', NULL, 1);


-- password are cio, ema and test
INSERT INTO `user` (`email`, `password`, `permission`) VALUES
    ('cio@gmail.com', '$2y$10$JXb8s3mW0.igP.k93aGcNuXv/FwR5lUq3RSaupV/HzUsQzK/HkY96', 'admin'),
    ('ema@gmail.com', '$2y$10$16KKg0Zd2YfSoaaWBL0a3OEASzmOG5beIDYPaoZZfR0/zZicee/za', 'admin'),
    ('usuario@prueba.com', '$2y$10$waFHtBkoyZjciTX7MwcnNO7JGqogO6.ZZSMD5XE7YQw5H4IvFM10K', 'standard');

