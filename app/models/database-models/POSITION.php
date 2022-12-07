<?php
    class POSITION {
        public $position_index, $position, $status, $votecount, $validvote;

        public function __construct($position_index, $position, $status, $votecount, $validvote)
        {
            $this->position_index = $position_index;
            $this->position = $position;
            $this->status = $status;
            $this->votecount = $votecount;
            $this->validvote = $validvote;
        }

        public function form_option() {
            echo "<option value='$this->position_index $this->position-'>
                $this->position_index $this->position
            </option>";
        }

        public function table_element($actions, $dashboard_paths, $paths) {
            echo "<tr>
                    <td>$this->position_index</td>
                    <td>$this->position</td>
                    <td>$this->status</td>
                    <td>$this->votecount</td>
                    <td>$this->validvote</td>";

            if ($actions) {
                echo "<td class='action-col'>
                        <a href='" . $dashboard_paths['BASE_PATH'] . "&current=update-position&positionindex=" . $this->position_index ."'><button>Update</button></a>
                        <form method='POST' action=" . $paths['CONTROLLER_PATH'] . "delete-position.php" . ">
                            <input type='hidden' name='positionindex' value='$this->position_index'>
                            <input type='submit' value='Delete'>
                        </form>
                        </td>"; 
            }  

            echo   "</tr>";
        }
    }