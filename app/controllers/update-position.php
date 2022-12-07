<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'POSITIONS.php';

    if (isset($_POST['position_name']) && isset($_POST['positionindex'])) {
        $position_name = validate($_POST['position_name']);
        $positionindex = validate($_POST['positionindex']);

        if (empty($position_name) || empty($positionindex)) {
            header('location: ../../index.php?page=dashboard&current=update-position&error=Please provide a new position name');
            exit();
        } else {
            $positions = new POSITIONS($conn);

            $success = $positions->update_position($positionindex, $position_name);

            if ($success) {
                header("location: ../../index.php?page=dashboard&current=position-list&success=Position of $position_name updated");
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=update-position&error=Database error');
                exit();
            }
        }
    } else {
        header('location: ../../index.php?page=dashboard&current=update-position&error=Please provide a new position name');
        exit();
    }



    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 