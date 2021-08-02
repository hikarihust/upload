<?php
require_once './libs/Json.php';

$table = './data/group.json';
$column = ['id', 'name', 'status'];
$objGroup = new Json($table, $column);
