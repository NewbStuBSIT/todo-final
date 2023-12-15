<?php
require_once("config/config.php");
include_once(ROOT_PATH.'/libs/function.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $task = $_POST['task'];

    $usercredentials = new DB_con();
    $query = "UPDATE tasks SET task='$task' WHERE id='$id'";
    $usercredentials->runUpdateQuery($query);

    header("location:dashboard.php");
}
?>