<?php
session_start();
ini_set('display_errors', 1);
include 'Actions.php';
$actions = new Actions();
$actions->addToBasket();