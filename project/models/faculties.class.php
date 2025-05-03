<?php

class faculties extends DB
{
    function getfaculties()
    {
        $query = "SELECT * FROM faculties";
        return $this->execute($query);
    }

    function add($data)
    {
        // Lengkapi Query
        $nama_faculties = $data['name'];

        $query = "INSERT INTO faculties values ('', '$nama_faculties')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        // Lengkapi Query
        $query = "DELETE from faculties WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($data)
    {
        // Lengkapi Query
        $id = $data['id'];
        $name = $data['name'];
        $query = "UPDATE faculties set name = '$name' WHERE id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
    function getFacultyById($id)
    {
        $query = "SELECT * FROM faculties WHERE id = '$id'";
        return $this->execute($query);
    }
}
