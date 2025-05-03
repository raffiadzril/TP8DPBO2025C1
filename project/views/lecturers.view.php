<?php
include_once("views/Template.view.php");

class lecturersView{
    public function render($data){
        $no = 1;
        $dataLecturers = null;
        $dataDepartements = null;
        foreach ($data as $val) {
            if(is_array($val) &&  isset($val[0], $val[1], $val[2], $val[3], $val[4])){
                // Check if the array has at least 5 elements
                list($id, $name, $nidn, $phone, $department_name) = $val;
                $dataLecturers .= "<tr class='text-center align-middle'>
                        <td>" . $no++ . "</td>
                        <td>" . $name . "</td>
                        <td>" . $nidn . "</td>
                        <td>" . $phone . "</td>
                        <td>" . $department_name . "</td>
                        <td>
                        <a href='lecturers.php?id_edit=" . $id . "' class='btn btn-warning''>Edit</a>
                        <a href='lecturers.php?id_hapus=" . $id . "' class='btn btn-danger''>Hapus</a>
                        </td>
                        </tr>";
            }
        }
        foreach ($data['departments'] as $val) {
            list($id, $name) = $val;
            $dataDepartements .= "<option value='" . $id . "'>" . $name . "</option>";
        }

        $tpl = new Template("templates/lecturers.html");
        $tpl->replace("JUDUL", "Lecturers");
        $tpl->replace("OPTION", $dataDepartements);
        $tpl->replace("DATA_TABEL", $dataLecturers);
        $tpl->write();
    }
}