<?php
//$env = parse_ini_file('../.env');
//$host = $env['DB_HOST'];

function getDBConnection(){
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'comp3421_project';

    $conn = new mysqli($host, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}
