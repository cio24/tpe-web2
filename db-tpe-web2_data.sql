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
INSERT INTO user (email, password, permission) VALUES
    ('cio@gmail.com', '$2y$10$upi5wgUxXhgbgAW1z0iKbekkqF0Q0496Cm6oIkLKBjcJgGJZZ3/MK', 1),
    ('ema@gmail.com', '$2y$10$/XesZLm8YNdddV6Oy.vQ3e/jbA2YMe5ZtcUFAf.KgVznoWGqcIxMy', 1),
    ('usuario@prueba.com', '$2y$10$Yd0Dd0W9c9vbK6tchWIzBeiTi32Cm5AVU9Rr.QwSeAvtSVxZoHh3W', 0);


INSERT INTO comment (subject_id, user_id,comment,difficulty) VALUES
(1,1,'Muy buena',4),
(2,2,'buena materia',5),
(3,1,'buenarda',4),
(4,2,'mala',5),
(5,1,'Malisimaa',1),
(6,2,'media media',2),
(7,1,'sin comentarios',3);