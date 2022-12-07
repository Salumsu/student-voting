<?php
    $dashboard_paths = [
        'VIEW_PATH' => $paths['VIEW_PATH'] . 'dashboard' . $DS,
        'MODEL_PATH' => $paths['MODEL_PATH'] . 'dashboard' . $DS,
        'BASE_PATH' => 'index.php?page=dashboard'
    ];

    $dashboard_page = get_param('current', 'student-list');
    $dashboard_model = $dashboard_paths['MODEL_PATH'] . $dashboard_page . '.php';
    $dashboard_view = $dashboard_paths['VIEW_PATH'] . $dashboard_page . '.phtml';

    $navigation_bar = $dashboard_paths['VIEW_PATH'] . 'partials' . $DS . 'navigation.phtml';

    require $paths['DATABASE_MODEL_PATH'] . 'STUDENTS.php';
    require $paths['DATABASE_MODEL_PATH'] . 'POSITIONS.php';
    require $paths['DATABASE_MODEL_PATH'] . 'CANDIDATES.php';

    $students = new STUDENTS($conn, $dashboard_paths, $paths);
    $positions = new POSITIONS($conn, $dashboard_paths, $paths);
    $candidates = new CANDIDATES($conn, $dashboard_paths, $paths);