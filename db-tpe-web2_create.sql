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
  email varchar(100)  NOT NULL,
  password varchar(100) NOT NULL,
  PRIMARY KEY (email)
);
