-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2021-09-28 19:41:01.001

-- tables
-- Table: career
CREATE TABLE career (
    id int NOT NULL,
    name varchar(25) NOT NULL,
    years int NOT NULL,
    faculty varchar(25) NOT NULL,
    CONSTRAINT career_pk PRIMARY KEY (id)
);

-- Table: subject
CREATE TABLE subject (
    id int NOT NULL,
    semester int NOT NULL,
    year int NOT NULL,
    name varchar(25) NOT NULL,
    direct_requirement int NULL,
    career int NOT NULL,
    CONSTRAINT subject_pk PRIMARY KEY (id)
);

-- foreign keys
-- Reference: Career_subject (table: subject)
ALTER TABLE subject ADD CONSTRAINT Career_subject FOREIGN KEY Career_subject (career)
    REFERENCES career (id);

-- Reference: requirements (table: subject)
ALTER TABLE subject ADD CONSTRAINT requirements FOREIGN KEY requirements (direct_requirement)
    REFERENCES subject (id);

-- End of file.

