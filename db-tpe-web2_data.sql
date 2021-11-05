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


-- password are cio and ema
INSERT INTO user(id,email, password) VALUES
    (NULL,'cio@gmail.com', '$2y$10$tVl7v1N.jR3lnCVsM1JpLu7MfjOmHjtxn07dcUKiBBBsauEokrqkO'),
    (NULL,'ema@gmail.com', '$2y$10$16KKg0Zd2YfSoaaWBL0a3OEASzmOG5beIDYPaoZZfR0/zZicee/za');


INSERT INTO comment (subject_id, user_id,comment,difficulty) VALUES
(1,1,'Muy buena',4),
(2,2,'buena materia',5),
(3,1,'buenarda',4),
(4,2,'mala',5),
(5,1,'Malisimaa',1),
(6,2,'media media',2),
(7,1,'sin comentarios',3);






