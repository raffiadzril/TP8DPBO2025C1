<?php

class lecturers extends DB
{
    function getlecturers()
    {
        $query = "SELECT lecturers.id, lecturers.name, nidn, phone, departments.name as department_name FROM lecturers INNER JOIN departments ON lecturers.department_id = departments.id";
        return $this->execute($query);
    }

    function add($data)
    {
        // Lengkapi Query
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $department_id = $data['departements'];
        $query = "INSERT INTO lecturers values ('', '$name', '$nidn', '$phone', '$department_id')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        // Lengkapi Query
        $query = "DELETE from lecturers WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        // Lengkapi Query
        $id = $data['id'];
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $department_id = $data['department_id'];
        $query = "UPDATE lecturers set name = '$name', nidn = '$nidn', phone = '$phone', department_id = '$department_id' WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
    function getLecturerById($id)
    {
        $query = "SELECT * FROM lecturers WHERE id = '$id'";
        return $this->execute($query);
    }

}
