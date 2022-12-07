<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'CANDIDATES.php';

    if (isset($_POST['candidateid'])) {
        $candidateid = validate($_POST['candidateid']);
        if (empty($candidateid)) {
            header('location: ../../index.php?page=dashboard&current=candidate-list&error=Please provide a candidate id');
            exit();
        } else {
            $candidates = new CANDIDATES($conn);

            $success = $candidates->delete_candidate($candidateid);

            if ($success) {
                header('location: ../../index.php?page=dashboard&current=candidate-list&success=Candidate deleted');
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=candidate-list&error=Database error');
                exit();
            }

        }
    } else {
        header('location: ../../index.php?page=dashboard&current=candidate-list&error=Please provide a candidate id');
        exit();
    }

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 