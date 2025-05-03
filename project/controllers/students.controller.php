<?php
include_once 'connection.php';
include_once 'models/students.class.php';
include_once 'models/departements.class.php';
include_once 'models/lecturers.class.php';
include_once 'views/students.view.php';
include_once 'views/edit/edit_students.view.php';

class StudentsController
{
    private $students;

    public function __construct()
    {
        $this->students = new students(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
    }

    public function index()
    {
        $this->students->open();
        $this->students->getstudents();
        $data = array();
        while ($row = $this->students->getResult()) {
            array_push($data, $row);
        }

        // Fetch departments and lecturers data
        $departments = new departments(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
        $departments->open();
        $departments->getdepartments();    
        $data['departments'] = array();
        while ($row = $departments->getResult()) {
            array_push($data['departments'], $row);
        }
        $departments->close();

        $lecturers = new lecturers(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
        $lecturers->open();
        $lecturers->getlecturers();
        $data['lecturers'] = array();
        while ($row = $lecturers->getResult()) {
            array_push($data['lecturers'], $row);
        }
        $lecturers->close();

        $this->students->close();

        $view = new studentsView();
        $view->render($data);
    }
    function add($data)
    {
        $this->students->open();
        $this->students->add($data);
        $this->students->close();

        header("location:index.php");
    }
    function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'nim' => $_POST['nim'],
                'phone' => $_POST['phone'],
                'join_date' => $_POST['join_date'],
                'department_id' => $_POST['departement'],
                'lecturer_id' => $_POST['lecturers']
            ];

            $this->students->open();
            $this->students->update($data);
            $this->students->close();

            header("location:index.php");
        } else {
            $this->students->open();
            $this->students->getStudentById($id);
            $student = $this->students->getResult();

            // Fetch departments and lecturers data
            $departments = new departments(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
            $departments->open();
            $departments->getdepartments();
            $student['departments'] = array();
            while ($row = $departments->getResult()) {
                array_push($student['departments'], $row);
            }
            $departments->close();

            $lecturers = new lecturers(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
            $lecturers->open();
            $lecturers->getlecturers();
            $student['lecturers'] = array();
            while ($row = $lecturers->getResult()) {
                array_push($student['lecturers'], $row);
            }
            $lecturers->close();

            $this->students->close();

            $view = new EditStudentsView();
            $view->render($student);
        }
    }
    function delete($id)
    {
        $this->students->open();
        $this->students->delete($id);
        $this->students->close();
        header("location:index.php");
    }
}

