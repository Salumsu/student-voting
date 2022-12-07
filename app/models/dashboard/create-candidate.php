<?php 
    $picked_student_id = get_param('studentid', null);
    $picked_student = $students->get_student_by_id($picked_student_id);

    $is_candidate = $candidates->is_candidate($picked_student_id);