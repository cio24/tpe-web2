-- drop tables

DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS subject;
DROP TABLE IF EXISTS career;
DROP TABLE IF EXISTS user;


-- create tables

CREATE TABLE user (
  id int NOT NULL AUTO_INCREMENT,
  email varchar(100)  NOT NULL,
  password varchar(100) NOT NULL,
  permission boolean NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE career (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(250) NOT NULL,
  years int NOT NULL,
  faculty varchar(250) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE subject (
  id int NOT NULL AUTO_INCREMENT,
  semester int NOT NULL,
  year int NOT NULL,
  name varchar(250) NOT NULL,
  direct_requirement int,
  career int NOT NULL,
  image_path varchar(100),
  PRIMARY KEY (id),
  FOREIGN KEY (career) REFERENCES career(id),
  FOREIGN KEY (direct_requirement) REFERENCES subject(id)
);

CREATE TABLE comment (
  id int NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  subject_id int NOT NULL,
  comment varchar(250) NOT NULL,  
  difficulty int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (subject_id) REFERENCES subject(id),
  FOREIGN KEY (user_id) REFERENCES user(id)
);


-- insert data

-- password are cio, ema and test
INSERT INTO user (email, password, permission) VALUES
  ('cio@gmail.com', '$2y$10$upi5wgUxXhgbgAW1z0iKbekkqF0Q0496Cm6oIkLKBjcJgGJZZ3/MK', 1),
  ('ema@gmail.com', '$2y$10$/XesZLm8YNdddV6Oy.vQ3e/jbA2YMe5ZtcUFAf.KgVznoWGqcIxMy', 1),
  ('usuario@prueba.com', '$2y$10$Yd0Dd0W9c9vbK6tchWIzBeiTi32Cm5AVU9Rr.QwSeAvtSVxZoHh3W', 0);

INSERT INTO career (id, name, years, faculty) VALUES
  (NULL, 'Tecnicatura Universitaria en Desarrollo de Aplicaiones informaticas', 3, 'Facultad de Ciencias Exactas'),
  (NULL, 'Ingenieria de Sistemas', 5, 'Facultad de Ciencias Exactas');

INSERT INTO subject (semester, year, name, direct_requirement, career) VALUES
  (1, 1, 'Programación 1', NULL, 1),
  (1, 1, 'Web 1', NULL, 1),
  (1, 1, 'Taller de Matemática Compuracional ', NULL, 1),
  (1, 1, 'Inglés 1', NULL, 1),
  (2, 1, 'Tecnología de la Información en las Organizaciones', NULL, 1),
  (2, 1, 'Técnicas de Validación y Documentación', NULL, 1),
  (2, 1, 'Web 2', 2, 1),
  (2, 1, 'Programación 2', 1, 1),
  (2, 1, 'Inglés 2', 4, 1),
  (2, 1, 'Seminario TecnolÓgico 1', NULL, 1),
  (1, 1, 'Inglés', NULL, 2),
  (2, 1, 'Análisis y diseño de algoritmos I', NULL, 2),
  (2, 1, 'Análisis y diseño de algoritmos II', NULL, 2),
  (2, 1, 'Introducción a la Programación I', NULL, 2),
  (2, 1, 'Física General', NULL, 2),
  (2, 1, 'Álgebra Lineal', NULL, 2),
  (1, 2, 'Introducción a la Arquitectura de Sistemas', NULL, 2),
  (1, 5, 'Fundamentos de Economía y Proyectos de Inversion', NULL, 2),
  (2, 1, 'Ingeniería de Software', NULL, 2),
  (2, 1, 'Teoría de la Información', NULL, 2),
  (2, 1, 'Arquitectura I', NULL, 2);
 
 
INSERT INTO comment (subject_id, user_id,comment,difficulty) VALUES
  (1,1,'Muy buena',4),
  (2,2,'buena materia',5),
  (3,1,'buenarda',4),
  (4,2,'mala',5),
  (5,1,'Malisimaa',1),
  (6,2,'media media',2),
  (7,1,'sin comentarios',3),
  (8,1,'Muy buena',4),
  (9,2,'buena materia',5),
  (10,1,'buenarda',4),
  (10,2,'mala',5),
  (11,1,'Malisimaa',1),
  (11,2,'media media',2),
  (12,1,'sin comentarios',3);