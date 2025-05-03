<?php

class departments extends DB
{
    function getdepartments()
    {
        $query = "SELECT departments.id, departments.name, faculties.name as faculty_name FROM departments INNER JOIN faculties ON departments.faculty_id = faculties.id";
        return $this->execute($query);
    }

    function add($data)
    {
        // Lengkapi Query
        $nama_departments = $data['name'];
        $faculty_id = $data['faculties'];
        $query = "INSERT INTO departments values ('', '$nama_departments', '$faculty_id')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        // Lengkapi Query
        $query = "DELETE from departments WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        // Lengkapi Query
        $id = $data['id'];
        $name = $data['name'];
        $faculty_id = $data['faculty_id'];
        $query = "UPDATE departments set name = '$name', faculty_id = '$faculty_id' WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
    function getDepartmentById($id)
    {
        $query = "SELECT * FROM departments WHERE id = '$id'";
        return $this->execute($query);
    }
}
