<?php
class EditStudentsView {
    public function render($data) {
        $id = $data['id'];
        $name = $data['name'];
        $nim = $data['nim'];
        $phone = $data['phone'];
        $join_date = $data['join_date'];
        $department_id = $data['department_id'];
        $lecturer_id = $data['lecturer_id'];

        $template = new Template('templates/edit/edit_students.html');

        // Replace placeholders with actual data
        $template->replace('DATA_ID', $id);
        $template->replace('DATA_NAME', $name);
        $template->replace('DATA_NIM', $nim);
        $template->replace('DATA_PHONE', $phone);
        $template->replace('DATA_JOIN_DATE', $join_date);

        // Generate department options
        $departmentOptions = '';
        foreach ($data['departments'] as $val) {
            $selected = ($val['id'] == $department_id) ? 'selected' : '';
            $departmentOptions .= "<option value='" . $val['id'] . "' " . $selected . ">" . $val['name'] . "</option>";
        }
        $template->replace('OPTION_DEPARTMENTS', $departmentOptions);

        // Generate lecturer options
        $lecturerOptions = '';
        foreach ($data['lecturers'] as $val) {
            $selected = ($val['id'] == $lecturer_id) ? 'selected' : '';
            $lecturerOptions .= "<option value='" . $val['id'] . "' " . $selected . ">" . $val['name'] . "</option>";
        }
        $template->replace('OPTION_LECTURERS', $lecturerOptions);

        $template->write();
    }
}