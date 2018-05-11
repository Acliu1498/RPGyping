USE egr302;
DROP TABLE if EXISTS generalUser_TBL;
DROP TABLE if EXISTS student_TBL;
DROP TABLE if EXISTS teacher_TBL;
DROP TABLE if EXISTS parent_TBL;


CREATE TABLE parent_TBL(
    accountID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(25) NOT NULL,
    password varchar(25) NOT NULL,
    email varchar(25) NOT NULL,
    CONSTRAINT UC_parent UNIQUE(username, password, email)
);


CREATE TABLE teacher_TBL(
    teacherID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName varchar(25) NOT NULL,
    lastName varchar(25) NOT NULL,
    username varchar(25) NOT NULL,
    password varchar(25) NOT NULL,
    email varchar(25) NOT NULL,
    teacherAccessCode VARCHAR(6) NOT NULL,
    fk_schoolID INT NOT NULL,
    UNIQUE (teacherAccessCode),
    CONSTRAINT UC_teacher UNIQUE (username, password,email, teacherAcccessCode),
    CONSTRAINT teacher_fk FOREIGN KEY (teacherID) REFERENCES parent_TBL(accountID),
    CONSTRAINT school_fk FOREIGN KEY (fk_schoolID) REFERENCES school_TBL(schoolID)
);

CREATE TABLE student_TBL(
    studentID int NOT NULL AUTO_INCREMENT,
    firstName varchar(25) NOT NULL,
    lastName varchar(25) NOT NULL,
    username varchar(25) NOT NULL,
    password varchar(25) NOT NULL,
    email varchar(25) NOT NULL,
    fk_teacherAccessCode VARCHAR(6) NOT NULL,
    fk_teacherID int NOT NULL,
    fk_schoolID INT NOT NULL,
    PRIMARY KEY (studentID, fk_teacherID),
    CONSTRAINT UC_student UNIQUE (username, password, email),
    CONSTRAINT accessCode_fk FOREIGN KEY (fk_teacherAccessCode) REFERENCES teacher_TBL(teacherAccessCode),
    CONSTRAINT student_fk FOREIGN KEY (studentID) REFERENCES parent_TBL(accountID),
    CONSTRAINT schoolStudent_fk FOREIGN KEY (fk_schoolID) REFERENCES school_TBL(schoolID)
);

CREATE TABLE generalUser_TBL(
    fk_userID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    password varchar(25) NOT NULL,
    email varchar(25) NOT NULL,
    --fk_CharID INT NOT NULL,--
    CONSTRAINT UC_generalUser UNIQUE (username, password, email),
    CONSTRAINT generalUser_fk FOREIGN KEY (fk_userID) REFERENCES parent_TBL(accountID),
);