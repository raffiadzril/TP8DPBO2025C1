<?php

// include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/lecturers.controller.php");

$departments = new LecturersController();

if (isset($_POST['add'])) {
    // Lengkapi untuk menambahkan data
    $departments->add($_POST);
} else if (!empty($_GET['id_hapus'])) {
    // Lengkapi untuk menghapus data
    $id = $_GET['id_hapus'];
    $departments->delete($_GET['id_hapus']);
} else if (!empty($_GET['id_edit'])) {
    // Lengkapi untuk mengedit data
    $id = $_GET['id_edit'];
    $departments->edit($_GET['id_edit']);
} else {
    $departments->index();
}