USE egr302;
DROP TABLE if EXISTS class_TBL;
DROP TABLE if EXISTS roster_TBL;

CREATE TABLE class_TBL (
classListID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
className varchar(25) NOT NULL,
fk_teacherID INT NOT NULL,
fk_studentID INT NOT NULL,
CONSTRAINT UC_className UNIQUE(className),
CONSTRAINT classTeacher_fk FOREIGN KEY (fk_teacherID) REFERENCES teacher_TBL(teacherID),
CONSTRAINT classStudent_fk FOREIGN KEY (fk_studentID) REFERENCES student_TBL(studentID)
);

--we believe we are going to use this but are unsure so we have commented it out for the time being
-- CREATE TABLE roster_TBL (
-- classRosterID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- fk_studentID INT NOT NULL, 
-- CONSTRAINT roster_fk FOREIGN KEY (fk_studentID) REFERENCES student_TBL(studentID) 
-- );