<?php
    function get_param ($name, $def = '') {
        return isset($_REQUEST[$name]) ? $_REQUEST[$name] : $def; 
    }