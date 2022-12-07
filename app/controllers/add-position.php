<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'POSITIONS.php';

    if (isset($_POST['position']) && isset($_POST['valid_vote'])) {
        $position = validate($_POST['position']);
        $validvote = validate($_POST['valid_vote']);

        if (empty($position) || empty($validvote)) {
            header('location: ../../index.php?page=dashboard&current=create-position&error=Do not leave anything blank');
            exit();
        } else {
            $positions = new POSITIONS($conn);

            $success = $positions->save_new_position($position, $validvote);

            if ($success) {
                header('location: ../../index.php?page=dashboard&current=position-list&success=Position created successfully');
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=create-position&error=Database error');
                exit();
            }
        }
    } else {
        header('location: ../../index.php?page=dashboard&current=create-position&error=Do not leave anything blank');
        exit();
    }



    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 