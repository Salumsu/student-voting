<?php 
    require $paths['DATABASE_MODEL_PATH'] . 'STUDENTS.php';
    require $paths['DATABASE_MODEL_PATH'] . 'POSITIONS.php';
    require $paths['DATABASE_MODEL_PATH'] . 'CANDIDATES.php';

    $students = new STUDENTS($conn);
    $positions = new POSITIONS($conn);
    $candidates = new CANDIDATES($conn);
    
    $voters_key = get_param('voterskey');
    $student = $students->get_student_by_voters_key($voters_key);

