<?php
    $picked_candidate_id = get_param('candidateid', null);
    $picked_candidate = $candidates->get_candidate_by_id($picked_candidate_id);