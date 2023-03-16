<?php
//$env = parse_ini_file('../.env');
//$host = $env['DB_HOST'];

function getDBConnection(){
    $host = 'mysql.comp.polyu.edu.hk';
    $username = '21026633d';
    $password = 'iqbesfsw';
    $db_name = '21026633d';

    $conn = new mysqli($host, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}
