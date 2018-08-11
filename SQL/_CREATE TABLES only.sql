CREATE TABLE _student (
studentID int UNIQUE AUTO_INCREMENT,
fname varchar(30) NOT NULL,
lname varchar(30) NOT NULL,
phone varchar(15),
email varchar(50),
streetADD varchar(30),
cityADD varchar(20),
stateADD varchar(2),
zipADD int(5),
pFname varchar(30),
pLname varchar(30),
pPhone varchar(15),
primary key (studentID)
)
engine = innodb;


CREATE TABLE _department (
deptID int UNIQUE AUTO_INCREMENT,
name varchar(50) NOT NULL,
fchairname varchar(30),
lchairname varchar(30),
primary key (deptID)
)
engine = innodb;


CREATE TABLE _major (
majorID int UNIQUE AUTO_INCREMENT,
name varchar(50),
grad_credits int,
min_gpa float,
deptID int NOT NULL,
primary key (majorID),
foreign key (deptID) references _department(deptID)
)
engine = innodb;



CREATE TABLE _building (
buildingID int UNIQUE AUTO_INCREMENT,
name varchar(30),
streetADD varchar(30),
cityADD varchar(20),
stateADD varchar(2),
zipADD int(5),
primary key (buildingID)
)
engine = innodb;


CREATE TABLE _room (
roomID int UNIQUE AUTO_INCREMENT,
roomNum int,
capacity int,
type varchar(30),
buildingID int NOT NULL,
primary key (roomID),
foreign key (buildingID) references _building(buildingID)
)
engine = innodb;



CREATE TABLE _room_feature (
roomID int,
feature varchar(30),
foreign key (roomID) references _room(roomID)
)
engine = innodb;



CREATE TABLE _faculty (
facultyID int UNIQUE AUTO_INCREMENT,
rank varchar(30),
fname varchar(30),
lname varchar(30),
phone varchar(15),
email varchar(50),
expertise varchar(30),
hire_date DATE,
roomID int,
primary key (facultyID),
foreign key (roomID) references _room(roomID)
)
engine = innodb;



CREATE TABLE _semester (
semesterID int UNIQUE AUTO_INCREMENT,
term varchar(10),
startDate date,
endDate date,
primary key (semesterID)
)
engine = innodb;



CREATE TABLE _course (
courseID int UNIQUE AUTO_INCREMENT,
title varchar(30),
credit_hours int(2),
courseNum int,
subject varchar(30),
prerequisiteID int,
deptID int,
primary key (courseID),
foreign key (prerequisiteID) references _course(courseID),
foreign key (deptID) references _department(deptID)
)
engine = innodb;


CREATE TABLE _section (
sectionID int UNIQUE AUTO_INCREMENT,
startTime time,
endTime time,
daysMet varchar(5),
semesterID int NOT NULL,
courseID int NOT NULL,
primary key (sectionID),
foreign key (semesterID) references _semester(semesterID),
foreign key (courseID) references _course(courseID)
)
engine = innodb;



CREATE TABLE _grade (
sectionID int,
studentID int,
grade varchar(2),
gpa float,
foreign key (sectionID) references _section(sectionID),
foreign key (studentID) references _student(studentID)
)
engine = innodb;


CREATE TABLE _major_course (
majorID int,
courseID int,
foreign key (majorID) references _major(majorID),
foreign key (courseID) references _course(courseID)
)
engine = innodb;


CREATE TABLE _major_student (
majorid int,
studentID int,
foreign key (majorID) references _major(majorID),
foreign key (studentID) references _student(studentID)
)
engine = innodb;


CREATE TABLE _student_faculty (
studentID int,
facultyID int,
foreign key (studentID) references _student(studentID),
foreign key (facultyID) references _faculty(facultyID)
)
engine = innodb;

CREATE TABLE _department_faculty (
deptID int,
facultyID int,
foreign key (deptID) references _department(deptID),
foreign key (facultyID) references _faculty(facultyID)
)
engine = innodb;

CREATE TABLE _section_room (
sectionID int,
roomID int,
foreign key (sectionID) references _section(sectionID),
foreign key (roomID) references _room(roomID)
)
engine = innodb;


CREATE TABLE _faculty_section (
facultyID int,
sectionID int,
foreign key (facultyID) references _faculty(facultyID),
foreign key (sectionID) references _section(sectionID)
)
engine = innodb;
