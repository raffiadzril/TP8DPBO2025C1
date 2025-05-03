<?php
class EditDepartmentsView {
    public function render($data) {
        $id = $data['id'];
        $name = $data['name'];
        $faculty_id = $data['faculty_id'];

        $template = new Template('templates/edit/edit_departments.html');

        // Replace placeholders with actual data
        $template->replace('DATA_ID', $id);
        $template->replace('DATA_NAME', $name);
        $template->replace('JUDUL', 'Edit Departments');

        // Generate department options
        $facultyOptions = '';
        foreach ($data['faculties'] as $val) {
            $selected = ($val['id'] == $faculty_id) ? 'selected' : '';
            $facultyOptions .= "<option value='" . $val['id'] . "' " . $selected . ">" . $val['name'] . "</option>";
        }
        $template->replace('OPTION_FACULTIES', $facultyOptions);

        $template->write();
    }
}