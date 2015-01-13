
## Software Engineer Final Project <br/> Student's Grade Management System


### Requirement
+	Login form (manager)
+	Logout option.
+	Manage students’ grade following the student ID, semester, courses student joined.
+	Input the students’ grade from Excel file
+	Print the student’s grade sheet follows each semester/year.

### Specification
+	**index.html** <br/> For login.
+	**login.php** <br/> Verify user name and password. If succeed, set variable and redirect the user to *student.php*, *manager.php* or *teacher.php* according to their identity. If failed, show error message and redirect the user to index.html after 5 seconds.
+	**student.php** <br/> Main page for a student, showing grades of a student. A student is only able to log out.
+	**manager.php** <br/> Main page for the manager. A manager is able to create new accounts.
+	**teacher.php** <br/> Main page for a teacher. A teacher is able to manage students' grade.
+	**logout.php** <br/> After login, every page has a link to this file. Destroy session and redirect the user to *index.html*.
+	...
