<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'CANDIDATES.php';

    if (isset($_POST['fullname']) && isset($_POST['studentid']) && isset($_POST['yearlevel']) && isset($_POST['position'])) {
        $fullname = validate($_POST['fullname']);
        $studentid = validate($_POST['studentid']);
        $yearlevel = validate($_POST['yearlevel']);
        $position = validate($_POST['position']);
        $position = validate($_POST['position']);
        $position_index = substr($position, 0, strpos($position, ' '));
        $position_name = substr($position, 2, -1);

        if (empty($fullname) || empty($fullname) || empty($fullname) || empty($fullname)) {
            header('location: ../../index.php?page=dashboard&current=create-candidate&error=Do not leave any field blank');
            exit();
        } else {
            $candidates = new CANDIDATES($conn);

            $success = $candidates->save_new_candidate($fullname, $studentid, $yearlevel, $position_index, $position_name);

            if ($success) {
                header('location: ../../index.php?page=dashboard&current=candidate-list&success=Candidate created successfully');
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=create-candidate&error=Database error');
                exit();
            }
        }
    } else {
        header('location: ../../index.php?page=dashboard&current=create-candidate&error=Do not leave any field blank');
        exit();
    }



    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 
