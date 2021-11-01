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
  PRIMARY KEY (id),
  FOREIGN KEY (career) REFERENCES career(id),
  FOREIGN KEY (direct_requirement) REFERENCES subject(id)
);

CREATE TABLE user (
  id int NOT NULL AUTO_INCREMENT,
  email varchar(100)  NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE comment{
  subject_id int NOT NULL,
  user_id INT NOT NULL,
  comment varchar(250) NOT NULL,  
  difficulty int NOT NULL,
  PRIMARY KEY (subject_id,user_id),
  FOREIGN KEY (subject_id) REFERENCES subject(id),
  FOREIGN KEY (user_id) REFERENCES user(id),
}