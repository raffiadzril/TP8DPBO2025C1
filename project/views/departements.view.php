<?php

include_once("views/Template.view.php");
class departementsView
{
    public function render($data)
    {
        $no = 1;
        $dataDepartements = null;
        $dataFaculties = null;
        foreach ($data as $key => $val) {
            if (is_array($val) && isset($val['id'], $val['name'], $val['faculty_name'])) {
                $dataDepartements .= "<tr class='text-center align-middle'>
                    <td>" . $no++ . "</td>
                    <td>" . $val['name'] . "</td>
                    <td>" . $val['faculty_name'] . "</td>
                    <td>
                    <a href='departments.php?id_edit=" . $val['id'] . "' class='btn btn-warning'>Edit</a>
                    <a href='departments.php?id_hapus=" . $val['id'] . "' class='btn btn-danger'>Hapus</a>
                    </td>
                    </tr>";
            }
        }
        foreach ($data['faculties'] as $val) {
            list($id, $name) = $val;
            $dataFaculties .= "<option value='" . $id . "'>" . $name . "</option>";
        }

        $tpl = new Template("templates/departements.html");
        $tpl->replace("JUDUL", "Departements");
        $tpl->replace("OPTION", $dataFaculties);
        $tpl->replace("DATA_TABEL", $dataDepartements);
        $tpl->write();
    }
}