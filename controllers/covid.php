<?php
    require_once('../template/header.php');

    class Covid {
        function fetchCovidDeaths() {
            $json = file_get_contents('https://opendata.bristol.gov.uk/api/records/1.0/search/?dataset=covid-19-deaths&q=&facet=area_name&facet=week_number&facet=place_of_death');

            $obj = json_decode($json);

            return $obj->records;
        }
    }