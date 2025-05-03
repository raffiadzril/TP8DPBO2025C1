<?php
include_once 'connection.php';
include_once 'models/faculties.class.php';
include_once 'views/faculties.view.php';
include_once 'views/edit/edit_faculties.view.php';
include_once 'views/Template.view.php';

class FacultiesController
{
    private $faculties;

    public function __construct()
    {
        $this->faculties = new faculties(Conn::$host, Conn::$user, Conn::$pass, Conn::$db);
    }

    public function index()
    {
        $this->faculties->open();
        $this->faculties->getfaculties();
        $data = array();
        while ($row = $this->faculties->getResult()) {
            array_push($data, $row);
        }
        $this->faculties->close();

        $view = new facultiesView();
        $view->render($data);
    }
    function add($data)
    {
        $this->faculties->open();
        $this->faculties->add($data);
        $this->faculties->close();

        header("location:faculties.php");
    }
    function edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->faculties->open();
            $data = [
                'id' => $_POST['id'],
                'name' => $_POST['name']
            ];
            $this->faculties->update($data);
            $this->faculties->close();
            header("location:faculties.php");
        } else {
            $this->faculties->open();
            $this->faculties->getfacultyById($id);
            $faculty = $this->faculties->getResult();
            $view = new EditFacultiesView();
            $view->render($faculty);
            $this->faculties->close();
        }
    }
    function delete($id)
    {
        $this->faculties->open();
        $this->faculties->delete($id);
        $this->faculties->close();
        header("location:faculties.php");
    }
}