#1a
SELECT concat(stud.lname, ', ', stud.fname) as full_name
FROM _section as sec, _student as stud, _grade as g
WHERE stud.studentID = g.studentID and g.sectionID = sec.sectionID
and
sec.sectionID = '3'

#2a
SELECT r.roomNum as room_number
FROM _room as r, _room_feature as rf
WHERE r.roomID = rf.roomID
and
feature = 'projector'

#3a
SELECT concat(f.fname, ' ', f.lname) as full_name, c.title as title, count(c.title) as times_taught
FROM _faculty as f, _course as c, _section as s, _faculty_section as fs
WHERE f.facultyID = fs.facultyID
and fs.sectionID = s.sectionID
and s.courseID = c.courseID
GROUP BY title


#4a
SELECT distinct concat(stud.fname, ' ', stud.lname) as full_name
FROM _student as stud, _course as c, _grade as g, _section as sec
WHERE stud.studentID = g.studentID
and sec.sectionID = g.sectionID
and c.courseID = sec.courseID
and c.courseID = '8';


#5a
SELECT sem.semesterID as semesterID, sem.term as term,
c.title as course, g.grade as grade
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and stud.studentID = '1'
GROUP BY course
ORDER BY semesterID;


#5b
SELECT stud.studentID as studentID,
sem.semesterID as semesterID,
sem.term as term,
c.title as course,
g.grade as grade,
g.gpa as gpa,
c.credit_hours as credit_hours,
(g.gpa * c.credit_hours) as gpa_points
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and stud.studentID = '3'
UNION
SELECT stud.studentID as studentID,
'' as semesterID,
'' as term,
'' as course,
'' as grade,
(sum(g.gpa * c.credit_hours) / sum(c.credit_hours)) as gpa,
sum(c.credit_hours) as total_credit_hours,
'' as gpa_points
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and stud.studentID = '3'
GROUP BY studentID



#5c
SELECT
sem.term as term,
sem.startDate as startDate,
c.title as course,
g.grade as grade,
c.credit_hours as credit_hours
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and stud.studentID = '3'
UNION
SELECT
'' as term,
'TOTAL' as startDate,
'' as course,
(sum(g.gpa * c.credit_hours) / sum(c.credit_hours)) as grade,
sum(c.credit_hours) as total_credit_hours
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and g.gpa > 0
and stud.studentID = '3'
GROUP BY stud.studentID
ORDER BY startDate;



#7a
SELECT concat(stud.lname, ', ', stud.fname) as student_name, m.name as major
FROM _major as m,
_student as stud,
_faculty as f,
_major_student as ms,
_student_faculty as sf
WHERE m.majorID = ms.majorID
and ms.studentID = stud.studentID
and sf.facultyID = f.facultyID
and stud.studentID = sf.studentID
and f.facultyID  = '1'
GROUP BY student_name
ORDER BY student_name;

#8b

#9b
SELECT concat(stud.fname, ' ', stud.lname) as student_name, m.name as major, sum(c.credit_hours) as credit_hours, m.grad_credits as minimum_credits
FROM _student as stud,
_section as sec,
_grade as g,
_course as c,
_major as m,
_major_student as ms,
_major_course as mc
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and m.majorID = ms.majorID
and ms.studentID = stud.studentID
and c.courseID = mc.courseID
and mc.majorID = m.majorID
and g.gpa > '0'
and m.majorID = '1'
GROUP BY student_name
HAVING credit_hours > minimum_credits;

#extra1
SELECT concat(f.fname, ' ', f.lname) as faculty_name,
b.name as building, r.roomNum as room_num,
concat(b.streetADD, ', ', b.cityADD, ', ', b.stateADD, ' ', b.zipADD) as building_address
FROM _faculty as f, _room as r, _building as b
WHERE b.buildingID = r.buildingID
and f.roomID = r.roomID
and f.facultyID = '1';

#extra2
SELECT c.title as courseName, sec.sectionID as section_ID
FROM _course as c, _department as d, _semester as sem, _section as sec
WHERE c.deptID = d.deptID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and sem.semesterID = '1'
ORDER BY courseName;
