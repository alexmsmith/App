<?php
    require_once('../template/header.php');

    class Stat {
        public $week;
        public $deaths;
        
        function __construct($week, $deaths) {
            $this->week = $week;
            $this->deaths = $deaths;
        }

        function get_deaths() {
            return $this->deaths;
        }

        function get_week() {
            return $this->week;
        }
    }