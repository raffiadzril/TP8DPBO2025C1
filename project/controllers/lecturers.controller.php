<?php
include_once 'connection.php';
include_once 'models/lecturers.class.php';
include_once 'models/departements.class.php';
include_once 'views/lecturers.view.php';
include_once 'views/edit/edit_lecturers.view.php';

class LecturersController
{
    private $lecturers;

    public function __construct()
    {
        $this->lecturers = new lecturers(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
    }

    public function index()
    {
        $this->lecturers->open();
        $this->lecturers->getlecturers();
        $data = array();
        while ($row = $this->lecturers->getResult()) {
            array_push($data, $row);
        }
        $this->lecturers->close();

        // Fetch departments data
        $departments = new departments(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
        $departments->open();
        $departments->getdepartments();
        $data['departments'] = array();
        while ($row = $departments->getResult()) {
            array_push($data['departments'], $row);
        }
        $departments->close();

        $view = new lecturersView();
        $view->render($data);
    }
    function add($data)
    {
        $this->lecturers->open();
        $this->lecturers->add($data);
        $this->lecturers->close();

        header("location:lecturers.php");
    }
    function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->lecturers->open();
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'nidn' => $_POST['nidn'],
                'phone' => $_POST['phone'],
                'department_id' => $_POST['departement'] // Include department_id
            ];
            $this->lecturers->update($data);
            $this->lecturers->close();
            header("location:lecturers.php");
        } else {
            $this->lecturers->open();
            $this->lecturers->getlecturerById($id);
            $lecturer = $this->lecturers->getResult();
            $departments = new departments(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
            $departments->open();
            $departments->getdepartments();
            $lecturer['departments'] = array();
            while ($row = $departments->getResult()) {
                array_push($lecturer['departments'], $row);
            }
            $departments->close();
            $this->lecturers->close();  
            $view = new EditLecturersView();
            $view->render($lecturer);
        }
    }
    function delete($id)
    {
        $this->lecturers->open();
        $this->lecturers->delete($id);
        $this->lecturers->close();
        header("location:lecturers.php");
    }
}
