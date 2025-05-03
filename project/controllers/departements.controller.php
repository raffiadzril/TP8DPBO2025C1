<?php
include_once 'connection.php';
include_once 'models/departements.class.php';
include_once 'models/faculties.class.php';
include_once 'views/departements.view.php';
include_once 'views/edit/edit_departments.view.php';

class Departements_controller{
    private $departements;

    public function __construct()
    {
        $this->departements = new departments(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
    }

    public function index()
    {
        $this->departements->open();
        $this->departements->getdepartments();
        $data = array();
        while ($row = $this->departements->getResult()) {
            array_push($data, $row);
        }
        $this->departements->close();

        // Fetch faculties data
        $faculties = new faculties(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
        $faculties->open();
        $faculties->getfaculties();
        $data['faculties'] = array();
        while ($row = $faculties->getResult()) {
            array_push($data['faculties'], $row);
        }
        $faculties->close();

        $view = new departementsView();
        $view->render($data);
    }
    function add($data)
    {
        $this->departements->open();
        $this->departements->add($data);
        $this->departements->close();

        header("location:departments.php");
    }
    function edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->departements->open();
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'faculty_id' => $_POST['faculties'] // Include faculty_id
            ];
            $this->departements->update($data);
            $this->departements->close();
            header("location:departments.php");
        } else {
            $this->departements->open();
            $this->departements->getdepartmentById($id);
            $department = $this->departements->getResult();
            
            $faculties = new faculties(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
            $faculties->open();
            $faculties->getfaculties();
            $department['faculties'] = array();
            while ($row = $faculties->getResult()) {
                array_push($department['faculties'], $row);
            }
            $faculties->close();

            $this->departements->close();

            $view = new EditDepartmentsView();
            $view->render($department);
        }
    }
    function delete($id)
    {
        $this->departements->open();
        $this->departements->delete($id);
        $this->departements->close();
        header("location:departments.php");
    }
}