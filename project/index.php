<?php

// include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/students.controller.php");

$students = new StudentsController();

if (isset($_POST['add'])) {
    // Lengkapi untuk menambahkan data
    $students->add($_POST);
} else if (!empty($_GET['id_hapus'])) {
    // Lengkapi untuk menghapus data
    $id = $_GET['id_hapus'];
    $students->delete($_GET['id_hapus']);
} else if (!empty($_GET['id_edit'])) {
    // Lengkapi untuk mengedit data
    $id = $_GET['id_edit'];
    $students->edit($_GET['id_edit']);
} else {
    $students->index();
}