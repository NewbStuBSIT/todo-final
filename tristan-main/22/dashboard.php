<?php
session_start();
  
require_once("config/config.php");

if(!isset($_SESSION['uid'])){
    // user is not logged in, redirect them to the login page
    header("Location: index.php");
    exit;
}

if(isset($_SESSION["uid"]) || isset($_COOKIE['user_login'])) { 
  include_once(ROOT_PATH.'/libs/function.php');
  $usercredentials=new DB_con();



  //fetching username from either session or cookies condition
  $uname = $uun = $uup = "";
  if (isset($_SESSION["uname"])) {
    $uname  = $_SESSION['uname'];
  }
  if (isset($_COOKIE['user_login'])) {
    $uname  = $_COOKIE['user_login'];
  }

  $query="SELECT*FROM tblusers  WHERE Username='$uname'";
  

      $result= $usercredentials->runBaseQuery($query);

      foreach ($result as $k => $v) 
      {
        $id = $result[$k]['id'];
        $uun = $result[$k]['Username'];
        $uup = $result[$k]['Password'];
      }
//session  condition  end  but it follows until bottom of the page
$tasks = "SELECT*FROM tasks WHERE user_id = '$id'";
$alltask = $usercredentials->runBaseQuery($tasks);

if(isset($_POST['btn-tasks'])){
  $task = $_POST['tasks'];
  
  $sql = "INSERT INTO tasks(task,user_id) VALUES('$task','$id')";
  $usercredentials->runInsertQuery($sql);
    header("location:dashboard.php");
  
}

?> 


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

     <!-- font awesome  -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/static/css/login_form_style.css">


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   
    <!-- <link href="assests/style.css" rel="stylesheet"> -->
    <title>Dashboard</title>
    <style>

        
        
  </style>

  </head>
  <body>


    <!-- nnn -->
<div class="container-fluid bg-light">
<div class="container text-center">
  <div class="row" style="min-height: 100vh;">
    <div class="col-sm-12 p-4 bg-white">

      <h1>Hello, <strong><?php echo $uun;?>!</strong></h1>
      <a href="logout.php" class="btn btn-warning">Logout</a>
      <h2>Todo List</h2>
    <form method="post">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"></label>
        <input type="text" name="tasks" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <br>
        <button type="submit" name="btn-tasks" class="btn btn-primary">Submit</button>
      </div>
    </form>
  
    <table class="table">
    <thead>
      <tr>
        <th scope="col">TASK</th> 
        <th scope="col">ACTION</th>
    </thead>
    <tbody>
    <?php if ($alltask != null): ?>
      <?php foreach ($alltask as $task): ?>
        <tr>
          <td><?=$task['task']?></td>
          <td>
           <!-- Button trigger modal -->
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Edit
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="text-lg-center" id="exampleModalLabel">Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="edit.php" method="post">
                        <input type="hidden" name="id" value="<?=$task['id']?>">
                        <input type="text" class="form-control" name="task" value="<?=$task['task']?>">
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>

          <a href="delete.php?id=<?=$task['id']?>" class="btn btn-danger">DELETE</a></td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </table>
    </div>
  </div>
</div>
</div>
    


<!-- should be in bottom -->
<script type="text/javascript" src="<?php echo base_url();?>/static/js/login_form_custom.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
</script>   

  </body>
</html>

<?php } else{
   header('location:login/logout.php');
  } 
?>

