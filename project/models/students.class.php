<?php

class students extends DB
{
    function getstudents()
    {
        $query = "SELECT students.id, students.name, students.nim, students.phone, students.join_date, departments.name as department_name, lecturers.name as lecturer_name FROM students INNER JOIN departments ON students.department_id = departments.id INNER JOIN lecturers ON students.lecturer_id = lecturers.id";
        return $this->execute($query);
    }

    function add($data)
    {
        // Lengkapi Query
        $name = $data['name_students'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $department_id = $data['departements'];
        $lecturer_id = $data['lecturers'];
        $query = "INSERT INTO students values ('', '$name', '$nim', '$phone', '$join_date', '$department_id', '$lecturer_id')";

        // Mengeksekusi query
        return $this->execute($query);
    }
    function delete($id)
    {
        // Lengkapi Query
        $query = "DELETE from students WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
    function update($data)
    {
        // Lengkapi Query
        $id = $data['id'];
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $department_id = $data['department_id'];
        $lecturer_id = $data['lecturer_id'];
        $query = "UPDATE students set name = '$name', nim = '$nim', phone = '$phone', join_date = '$join_date', department_id = '$department_id', lecturer_id = '$lecturer_id' WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
    function getStudentById($id)
    {
        $query = "SELECT * FROM students WHERE id = '$id'";
        return $this->execute($query);
    }
}