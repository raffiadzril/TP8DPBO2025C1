<?php

class facultiesView
{
    public function render($data)
    {
        $no = 1;
        $dataFaculties = null;
        foreach ($data as $val) {
            list($id, $name) = $val;
            $dataFaculties .= "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $name . "</td>
                    <td>
                    <a href='faculties.php?id_edit=" . $id . "' class='btn btn-warning''>Edit</a>
                    <a href='faculties.php?id_hapus=" . $id . "' class='btn btn-danger''>Hapus</a>
                    </td>
                    </tr>";
        }

        $tpl = new Template("templates/faculties.html");
        $tpl->replace("JUDUL", "Faculties");
        $tpl->replace("DATA_TABEL", $dataFaculties);
        $tpl->write();
    }
}