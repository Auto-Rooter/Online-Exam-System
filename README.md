# On-Line Exam System  :
<br>

## Technologies are used :
  - Front-end : Bootstrap, JQuery, CSS, HTML
  - Back-end : Laravel Framework (PHP)
  - Database : Mysql
<br>
__ [This Project based on LaraQuiz project](https://github.com/LaravelDaily/Laraquiz-QuickAdminPanel) __
<br><br>

## Usage: (First you need to install composer, and you need a mysql server that contain a database with name "online_exam"(don`t forget to change the database credentials in `.env` file))
<br>


```shell
$ git clone https://github.com/Auto-Rooter/Online-Exam-System.git && cd Online-Exam-System

# Download all required packages
$ composer install

# Create all related tables
$ php artisan migrate

# Seed the tables (users, roles)
$ php artisan db:seed

# Run the server
$ php artisan serve


```
<br>
<br><br>




## Login:
<br>
- You can login with an account added by the admin only :
<br>
__  (also only emails end with domain : `.uni-miskolc.hu` ) __
<br><br>

![](imgs/login.JPG)

## Users managment:
<br><br>
![](imgs/admin_add_user.JPG)

<br><br>


## Teacher Section :
<br><br>
![](imgs/teacher_exam.JPG)

<br>

![](imgs/teacher_add_exam.JPG)

<br>

![](imgs/teacher_subject.JPG)

<br>
- Add new Multi-Choices Question:
<br>

![](imgs/MC_exam.png)

<br>
- Add new Essay Question:
<br>

![](imgs/essay_q.png)

<br><br>

## Student Section:
<br>
- Student Incoming Exams and registered Subjects:
<br>

![](imgs/student_exam.png)


<br>
- Exam:
<br>

![](imgs/take_exam_student.png)


<br>
- Student Result (before Teacher correct the Essay Questions):
<br>

![](imgs/finish_exam.png)



<br>
- Teacher (List of Essay Questions to be corrected):
<br>

![](imgs/correct_q_index.png)



<br>
- Correct Question:
<br>

![](imgs/corrected.png)


<br>
- Student Final Result:
<br>

![](imgs/my_result.png)

<br>


