<?php
class EditLecturersView {
    public function render($data) {
        $id = $data['id'];
        $name = $data['name'];
        $nidn = $data['nidn'];
        $phone = $data['phone'];
        $department_id = $data['department_id'];

        $template = new Template('templates/edit/edit_lecturers.html');

        // Replace placeholders with actual data
        $template->replace('DATA_ID', $id);
        $template->replace('DATA_NAME', $name);
        $template->replace('DATA_NIDN', $nidn);
        $template->replace('DATA_PHONE', $phone);
        $template->replace('JUDUL', 'Edit Lecturers');

        // Generate department options
        $departmentsOptions = '';
        foreach ($data['departments'] as $val) {
            $selected = ($val['id'] == $data['department_id']) ? 'selected' : '';
            $departmentsOptions .= "<option value='" . $val['id'] . "' " . $selected . ">" . $val['name'] . "</option>";
        }
        $template->replace('OPTION_DEPARTMENTS', $departmentsOptions);

        $template->write();
    }
}