<?php
session_start();
ini_set('display_errors', 1);
include 'Actions.php';
$actions = new Actions();
if ($_POST && $_POST['id']) {
    $actions->deleteItem($_POST['id']);
}