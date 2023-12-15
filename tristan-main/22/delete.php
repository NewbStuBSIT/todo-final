<?php
require_once("config/config.php");
require_once(ROOT_PATH.'/libs/function.php');
    


if(isset($_GET['id'])){
    $taskId = $_GET['id'];
    $db = new DB_con();
    $result = $db->deleteTask($taskId);
    header('location:dashboard.php');
}
if(isset($_GET['id'])){
    $userId = $_GET['id'];
    $db = new DB_con();
    $result = $db->deleteUser($userId);
    header('location:admin.php');
}
?>