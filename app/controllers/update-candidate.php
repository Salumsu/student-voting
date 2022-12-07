<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'CANDIDATES.php';

    if (isset($_POST['candidateid']) && isset($_POST['candidatename']) && isset($_POST['yearlevel']) && isset($_POST['position'])) {
        $candidatename = validate($_POST['candidatename']);
        $yearlevel = validate($_POST['yearlevel']);
        $candidateid = validate($_POST['candidateid']);
        $position = validate($_POST['position']);
        $position_index = substr($position, 0, strpos($position, ' '));
        $position_name = substr($position, 2, -1);

        if (empty($position_name) || empty($position_index) || empty($candidatename)|| empty($candidateid)|| empty($yearlevel)) {
            header("location: ../../index.php?page=dashboard&current=update-candidate&candidateid=$candidateid&error=Do not leave any field blank1");
            exit();
        } else {
            $candidates = new CANDIDATES($conn);

            $success = $candidates->update_candidate($candidateid, $candidatename, $yearlevel, $position_index, $position_name);

            if ($success) {
                header("location: ../../index.php?page=dashboard&current=candidate-list&success=Candidate updated successfully");
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=update-candidate&candidateid=$candidateid&error=Database error');
                exit();
            }
        }
    } else {
        header('location: ../../index.php?page=dashboard&current=update-candidate&error=Do not leave any field blank');
        exit();
    }



    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 