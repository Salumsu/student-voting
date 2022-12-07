<?php
    require $paths['DATABASE_MODEL_PATH'] . 'POSITION.php';

    class POSITIONS {
        public $positions = [];
        public $position_count = 0;
        public $conn;
        public $dashboard_paths, $paths;

        public function __construct($conn, $dashboard_paths = [], $paths = [])
        {   
            $this->dashboard_paths = $dashboard_paths;
            $this->paths = $paths;
            $this->conn = $conn;
            $query = "SELECT * FROM tblposition";

            if ($result = $this->conn->query($query)) {
                while ($row = $result->fetch_assoc()) {
                    $position = new POSITION($row['positionindex'], $row['position'], $row['status'], $row['votecount'], $row['validvote']);
                    $this->positions[$this->position_count++] = $position;
                }
            }

        }

        public function form_select() {
            echo "<select name='position'>";
            for ($i = 0; $i < $this->position_count; $i++) {
                $this->positions[$i]->form_option();
            }
            
            echo "</select>";
        }

        public function positions_table($actions) {
            echo "<table>
                <theader>
                    <td>Position Index</td>
                    <td>Position</td>
                    <td>Status</td>
                    <td>Vote Count</td>
                    <td>Valid votes</td>
                </theader>";

            for ($i = 0; $i < $this->position_count; $i++) {
                $position = $this->positions[$i];

                $position->table_element($actions , $this->dashboard_paths, $this->paths);
            }

            echo "</table>";
        }

        public function get_position_by_index($index) {
            for ($i = 0; $i < $this->position_count; $i++) {
                $current = $this->positions[$i];
                if ($current->position_index == $index) {
                    return $current;
                }
            }
        }

        public function save_new_position($position_name, $validvote) {
            $query = "INSERT INTO tblposition VALUES ('', '$position_name', 1, 0, $validvote)";
            return $this->conn->query($query);
        }

        public function update_position ($position_index, $position_name) {
            $query = "UPDATE tblposition SET position = '$position_name' WHERE positionindex = $position_index";

            return $this->conn->query($query);
        }

        public function delete_position($position_index) { 
            $query = "DELETE FROM tblposition WHERE positionindex = $position_index";

            return $this->conn->query($query);
        }

    }