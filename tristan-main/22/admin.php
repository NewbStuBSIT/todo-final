<?php
session_start();

if(!isset($_SESSION["admin"])) {
    header('location:index.php');
    exit;
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">All Users</h1>
        <a href="logout.php" class="btn btn-warning m-2 ">Logout</a>        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>RegisterDate</th>
                    <th>Action</th>           
                </tr>
            </thead>
            <tbody>
                <?php
                require_once("config/config.php");
                require_once(ROOT_PATH.'/libs/function.php');

                $usercredentials = new DB_con();

                $query = "SELECT * FROM tblusers";
                $result = $usercredentials->runBaseQuery($query);

                foreach ($result as $user) {
                    echo "<tr><td>" . $user['Username'] . 
                         "</td><td>". $user['UserEmail'] . 
                         "</td><td>". $user['Password'] . 
                         "</td><td>". $user['RegDate'] . 
                         "</td><td>". "<a  href='delete.php?id=".$user['id']."'class='btn btn-danger'>Delete</a>" .
                         "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>