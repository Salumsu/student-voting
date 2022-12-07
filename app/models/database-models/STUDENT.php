<?php
    class STUDENT {
        public $student_id, $first_name, $middle_name, 
            $last_name, $program, $year_level, $vote_status, 
            $voters_key;

        public function __construct($student_id, $first_name, $middle_name, 
            $last_name, $program, $year_level, $vote_status, 
            $voters_key) {
            $this->student_id = $student_id;
            $this->first_name = $first_name;
            $this->middle_name  = $middle_name ;
            $this->last_name = $last_name;
            $this->program = $program;
            $this->year_level = $year_level;
            $this->vote_status = $vote_status;
            $this->voters_key = $voters_key;
        }

        public function voted($status) {
            if ($status) return "Voted";
            return "Not yet voted";
        }

        public function table_element ($actions, $dashboard_paths = [], $paths = []) {
            echo "<tr>
                <td>$this->student_id</td>
                <td>$this->first_name</td>
                <td>$this->middle_name</td>
                <td>$this->last_name</td>
                <td>$this->program</td>
                <td>$this->year_level</td>
                <td>" . $this->voted($this->vote_status) . "</td>
                <td>$this->voters_key</td>
                ";

            if ($actions) {
                echo "<td class='action-col'>
                        <a href='" . $dashboard_paths['BASE_PATH'] . "&current=update-student&studentid=" . $this->student_id ."'><button>Update</button></a>
                        <form method='POST' action=" . $paths['CONTROLLER_PATH'] . "delete-student.php" . ">
                            <input type='hidden' name='studentid' value='$this->student_id'>
                            <input type='submit' value='Delete'>
                        </form>
                        </td>";
            }    
            
            echo "</tr>";
        }

        public function table_solo() {
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
                </thead>
                <tbody>";
             echo "<tr>
                <td>$this->student_id</td>
                <td>$this->first_name</td>
                <td>$this->middle_name</td>
                <td>$this->last_name</td>
                <td>$this->program</td>
                <td>$this->year_level</td>
                <td>" . $this->voted($this->vote_status) . "</td>
                <td>$this->voters_key</td>
                <tr/>";

            echo "</tbody>
                </table>";
        }
    }