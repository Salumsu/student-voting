<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'STUDENTS.php';

    if (isset($_POST['studentid']) && isset($_POST['firstname']) && 
        isset($_POST['middlename']) && isset($_POST['lastname']) && 
        isset($_POST['program']) && isset($_POST['yearlevel'])) {

        $studentid = validate($_POST['studentid']);
        $firstname = validate($_POST['firstname']);
        $middlename = validate($_POST['middlename']);
        $lastname = validate($_POST['lastname']);
        $program = validate($_POST['program']);
        $yearlevel = validate($_POST['yearlevel']);
        
        if (empty($studentid) || empty($firstname) || empty($middlename)
            || empty($lastname)|| empty($program) || empty($yearlevel)) {
            header("location: ../../index.php?page=dashboard&current=update-student&studentid=$studentid&error=Do not leave any field blank");
            exit();
        } else {
            $students = new STUDENTS($conn);

            $success = $students->update_student($studentid, $firstname, $middlename, 
            $lastname, $program, $yearlevel);

            if ($success) {
                header("location: ../../index.php?page=dashboard&success=Student updated");
                exit();
            } else {
                header("location: ../../index.php?page=dashboard&current=update-student&studentid=$studentid&error=Database error");
                exit();
            }

        }
    } else {
        header('location: ../../index.php?page=dashboard');
    }

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 
