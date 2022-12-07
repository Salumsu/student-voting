<?php

    class CANDIDATE  {
        public $candidate_id, $position_index, $position, $student_id, $candidate_name, $year_level, $vote_count;

        public function __construct($candidate_id, $position_index, $position, 
                        $studentid, $candidate_name, $year_level, $votecount)
        {
            $this->candidate_id = $candidate_id;
            $this->position_index = $position_index;
            $this->position = $position;
            $this->student_id = $studentid;
            $this->candidate_name = $candidate_name;
            $this->year_level = $year_level;
            $this->vote_count = $votecount;
        }

        public function table_element($actions, $dashboard_paths, $paths) {
            echo    "<tr>
                        <td>$this->candidate_id</td>
                        <td>$this->student_id</td>
                        <td>$this->position_index</td>
                        <td>$this->candidate_name</td>
                        <td>$this->position</td>
                        <td>$this->year_level</td>
                        <td>$this->vote_count</td>";
            
            if ($actions) {
                echo "<td class='action-col'>
                        <a href='" . $dashboard_paths['BASE_PATH'] . "&current=update-candidate&candidateid=" . $this->candidate_id ."'><button>Update</button></a>
                        <form method='POST' action=" . $paths['CONTROLLER_PATH'] . "delete-candidate.php" . ">
                            <input type='hidden' name='candidateid' value='$this->candidate_id'>
                            <input type='submit' value='Delete'>
                        </form>
                        </td>"; 
            }  

            echo        "</tr>";
        }

    }