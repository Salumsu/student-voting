<?php
    require $paths['DATABASE_MODEL_PATH'] . 'STUDENT.php';

    class STUDENTS {
        public $students = [];
        public $student_number;
        public $conn;
        public $dashboard_paths;
        public $paths;

        public function __construct($conn, $dashboard_paths = [], $paths = [])
        {
            $this->paths = $paths;
            $this->dashboard_paths = $dashboard_paths;
            $this->student_number = 0;
            $this->conn = $conn;

            $query = "SELECT * FROM tblstudent WHERE active = 1";

            if($result = $this->conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $this->add_student_raw($row['studentid'], $row["firstname"], $row["middlename"], $row["lastname"], $row["program"], $row["yearlevel"], $row["votestatus"], $row["voterskey"] );
                }
            } 
        }

        public function add_student_raw($student_id, $first_name, $middle_name, 
            $last_name, $program, $year_level, $vote_status, 
            $voters_key) {
            $student = new STUDENT($student_id, $first_name, $middle_name, 
            $last_name, $program, $year_level, $vote_status, 
            $voters_key);
            $this->students[$this->student_number++] = $student;
            return $student;
        }

        public function students_table($actions = false) {
            echo "<table>
                <thead>
                    <td>Student ID</td>
                    <td>First name</td>
                    <td>Middle name</td>
                    <td>Last Name</td>
                    <td>Program</td>
                    <td>Year Level</td>
                    <td>Vote Status</td>
                    <td>Voter's Key</td>
                ";
            if ($actions) {
                echo "<td>Actions</td>";
            }

            echo "
                </thead>
                <tbody>
            ";

            for ($i = 0; $i < $this->student_number; $i++) {
                $student = $this->students[$i];
                $student->table_element($actions, $this->dashboard_paths, $this->paths);
            }

            echo "</tbody>
            </table>";
        }

        public function save_new_student ($student_id, $first_name, $middle_name, 
            $last_name, $program, $year_level) {

            $voters_key = time();

            $exists = $this->get_student_by_id($student_id);
            if ($exists) {
                return 0;
            }

            $query = "INSERT INTO tblstudent 
                    (studentid, firstname, middlename, lastname, program, yearlevel, voterskey) VALUES 
                    ($student_id, '$first_name', '$middle_name', '$last_name', '$program', $year_level, $voters_key)";

            return $this->conn->query($query);
        }

        public function update_student ($student_id, $first_name, $middle_name, 
            $last_name, $program, $year_level) {

            $query = "UPDATE tblstudent SET firstname = 
                        '$first_name', middlename = '$middle_name', 
                        lastname = '$last_name', program = '$program', 
                        yearlevel = $year_level
                        WHERE studentid = $student_id";

            return $this->conn->query($query);
        }

        public function get_student_by_id($id) {
            for ($i = 0; $i < $this->student_number; $i++) {
                $current = $this->students[$i];

                if ($current->student_id === $id) {
                    return $current;
                }
            }
        }

        public function delete_student ($id) {
            $query = "UPDATE tblstudent SET active = 0 WHERE studentid = $id";

            return $this->conn->query($query);
        }

        public function get_student_by_voters_key($voters_key) {
            for ($i = 0; $i < $this->student_number; $i++) {
                $current = $this->students[$i];

                if ($current->voters_key === $voters_key) {
                    return $current;
                }
            }
        }
    }