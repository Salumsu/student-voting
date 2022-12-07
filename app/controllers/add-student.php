<?php
    require '../config/config.php';
    require $paths['DATABASE_MODEL_PATH'] . 'STUDENTS.php';

    if (isset($_POST['studentid']) && isset($_POST['firstname']) && 
        isset($_POST['lastname']) && isset($_POST['program']) 
        && isset($_POST['yearlevel']) ) {

        $studentid = validate($_POST['studentid']);
        $firstname = validate($_POST['firstname']);
        $middlename = validate($_POST['middlename']);
        $lastname = validate($_POST['lastname']);
        $program = validate($_POST['program']);
        $yearlevel = validate($_POST['yearlevel']);

        if (empty($studentid) || empty($firstname) || empty($lastname)
            || empty($program) || empty($yearlevel)) {
            header('location: ../../index.php?page=dashboard&current=create-student&error=Do not leave any field blank');
            exit();
        } else {
            $students = new STUDENTS($conn);

            $success = $students->save_new_student($studentid, $firstname, $middlename, 
            $lastname, $program, $yearlevel);

            if ($success) {
                header('location: ../../index.php?page=dashboard&current=student-list&success=Student created');
                exit();
            } else {
                header('location: ../../index.php?page=dashboard&current=create-student&error=Database error');
                exit();
            }

        }
    } else {
        header('location: ../../index.php?page=dashboard&current=create-student&error=Do not leave any field blank');
        exit();
    }

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    } 

    