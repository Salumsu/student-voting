<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'POSITIONS.php';

    if (isset($_POST['positionindex'])) {
        $position_index = validate($_POST['positionindex']);

        if (empty($position_index)) {
            header('location: ../../index.php?page=dashboard&current=position-list&error=Please provide a student id');
            exit();
        } else {
            $positions = new POSITIONS($conn);

            $success = $positions->delete_position($position_index);

            if ($success) {
                header('location: ../../index.php?page=dashboard&current=position-list&success=Position deleted');
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=position-list&error=Database error');
                exit();
            }
        }
    } else {
        header('location: ../../index.php?page=dashboard&current=position-list&error=Please provide a student id');
        exit();
    }



    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 