<?php

class EditFacultiesView
{
    public function render($data){
        $id = $data['id'];
        $name = $data['name'];

        $template = new Template("templates/edit/edit_faculties.html");
        $template->replace("DATA_ID", $id);
        $template->replace("DATA_NAME", $name);
        $template->replace("JUDUL", "Edit Faculties");
        $template->write();
    }

}