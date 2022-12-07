<?php
    require $paths['DATABASE_MODEL_PATH'] . 'CANDIDATE.php';

    class CANDIDATES {
        public $candidates = [];
        public $candidate_number = 0;
        public $conn;
        public $dashboard_paths, $paths;

        public function __construct($conn, $dashboard_paths = [], $paths = [])
        {   
            $this->dashboard_paths = $dashboard_paths;
            $this->paths = $paths;
            $this->conn = $conn;
            $query = "SELECT * FROM tblcandidate";

            if ($result = $this->conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $candidate = new CANDIDATE($row['candidateid'], $row['positionindex'], 
                    $row['position'], $row['studentid'], $row['candidatename'], $row['yearlevel'], $row['votecount']);
                    $this->candidates[$this->candidate_number++] = $candidate;
                }
            }

        }

        public function candidates_table($actions) {
            echo "<table>
                <theader>
                    <td>Candidate ID</td>
                    <td>Student ID</td>
                    <td>Position Index</td>
                    <td>Candidate name</td>
                    <td>Position</td>
                    <td>Year Level</td>
                    <td>Votecount</td>";
            
            if ($actions) {
                echo "<td>Actions</td>";
            }
            
            echo   "</theader>";

            for ($i = 0; $i < $this->candidate_number; $i++) {
                $candidate = $this->candidates[$i];

                $candidate->table_element($actions , $this->dashboard_paths, $this->paths);
            }

            echo "</table>";
        }

        public function get_candidates_by_position_index($position_index) {
            $candidates = [];
            $candidate_count = 0;

            for ($i = 0; $i < $this->candidate_number; $i++) {
                $current_candidate = $this->candidates[$i];
                if ($position_index == $current_candidate->position_index) {
                    $candidates[$candidate_count++] = $current_candidate;
                }
            }

            return [$candidates, $candidate_count];
        }

        public function get_candidate_by_id ($candidateid) {
            for ($i = 0; $i < $this->candidate_number; $i++) {
                $current = $this->candidates[$i];
                if ($current->candidate_id == $candidateid) {
                    return $current;
                }
            }
        }

        public function delete_candidate($candidateid) { 
            $query = "DELETE FROM tblcandidate WHERE candidateid = $candidateid";

            return $this->conn->query($query);
        }

        public function save_new_candidate($fullname, $studentid, $yearlevel, $position_index, $position_name) {
            $query = "INSERT INTO tblcandidate VALUES ('', $studentid, $position_index, '$fullname', '$position_name', $yearlevel, 0)";

            return $this->conn->query($query);
        }

        public function update_candidate($candidateid, $candidatename, $yearlevel, $position_index, $position_name) {
            $query = "UPDATE tblcandidate SET candidatename = '$candidatename', 
                        yearlevel = $yearlevel, positionindex = $position_index, 
                        position = '$position_name' WHERE candidateid = $candidateid";

            return $this->conn->query($query);
        }

        public function is_candidate($studentid) {
            for ($i = 0; $i < $this->candidate_number; $i++) {
                $current = $this->candidates[$i];
                if ($current->student_id === $studentid) {
                    return true;
                }
            }

            return false;
        }
    }