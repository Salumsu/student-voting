<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'STUDENTS.php';

    if (isset($_POST['studentid'])) {
        $studentid = validate($_POST['studentid']);
        if (empty($studentid)) {
            header('location: ../../index.php?page=dashboard&error=Please provide a student id');
            exit();
        } else {
            $students = new STUDENTS($conn);

            $success = $students->delete_student($studentid);

            if ($success) {
                header('location: ../../index.php?page=dashboard&success=Student deleted');
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&error=Database error');
                exit();
            }

        }
    } else {
        header('location: ../../index.php?page=dashboard&error=Please provide a student id');
        exit();
    }

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 