<?php

// include_once("views/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/faculties.controller.php");

$faculties = new FacultiesController();

if (isset($_POST['add'])) {
    // Lengkapi untuk menambahkan data
    $faculties->add($_POST);
} else if (!empty($_GET['id_hapus'])) {
    // Lengkapi untuk menghapus data
    $id = $_GET['id_hapus'];
    $faculties->delete($_GET['id_hapus']);
} else if (!empty($_GET['id_edit'])) {
    // Lengkapi untuk mengedit data
    $id = $_GET['id_edit'];
    $faculties->edit($_GET['id_edit']);
} else {
    $faculties->index();
}