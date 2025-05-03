<?php
include_once("views/Template.view.php");
class studentsView{
    public function render($data){
        $no = 1;
        $dataStudents = null;
        foreach ($data as $key => $val) {
            if (is_array($val) && count($val) >= 7) {
                list($id, $name, $nim, $phone, $join_date, $department_name, $lecturer_name) = $val;
                $dataStudents .= "<tr class='text-center align-middle'>
                        <td>" . $no++ . "</td>
                        <td>" . $name . "</td>
                        <td>" . $nim . "</td>
                        <td>" . $phone . "</td>
                        <td>" . $join_date . "</td>
                        <td>" . $department_name . "</td>
                        <td>" . $lecturer_name . "</td>
                        <td>
                        <a href='index.php?id_edit=" . $id . "' class='btn btn-warning''>Edit</a>
                        <a href='index.php?id_hapus=" . $id . "' class='btn btn-danger''>Hapus</a>
                        </td>
                        </tr>";
            }
        }
        $dataDepartments = null;
        foreach ($data['departments'] as $val) {
            list($id, $name) = $val;
            $dataDepartments .= "<option value='" . $id . "'>" . $name . "</option>";
        }
        $dataLecturers = null;
        foreach ($data['lecturers'] as $val) {
            list($id, $name) = $val;
            $dataLecturers .= "<option value='" . $id . "'>" . $name . "</option>";
        }

        $tpl = new Template("templates/index.html");
        $tpl->replace("OPTION_DEPARTMENTS", $dataDepartments);
        $tpl->replace("OPTION_LECTURERS", $dataLecturers);
        $tpl->replace("JUDUL", "Students");
        $tpl->replace("DATA_TABEL", $dataStudents);
        $tpl->write();
    }

}