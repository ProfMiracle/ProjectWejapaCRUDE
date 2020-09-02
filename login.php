<?php
    require_once 'db.php';

    if (isset($_SESSION['token'])) {
        header('location: index.php');
    }

    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $pas = mysqli_real_escape_string($con, $_POST['pswd']);
        $uname = mysqli_real_escape_string($con, $_POST['username']);

        //echo $pas; exit;
        $check  = mysqli_query($con, "SELECT * FROM user WHERE username = '$uname'");

        //var_dump($check); exit;

        if (empty($check)) {
            $msg =  "<div class=\"alert alert-danger\">
                                <strong>Error!</strong> Sorry we don't know you :).
                                </div>";
            //exit;
        }

        $check = $check->fetch_object();
        if ($check->password != $pas) {
            $msg = "<div class=\"alert alert-danger\">
                                <strong>Error!</strong> wrong password :).
                                </div>";
            //exit;
        }else{

          $_SESSION['token'] = md5(mt_rand(89999, 99989989));
          $_SESSION['id'] = $check->id;

          header('location: index.php');
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
</head>
<body>
<div class='jumbotron text-center'>
        <h1>Welcome to a CRUD blog site</h1>
        <div class="btn-group">
            <?php 
                if (isset($_SESSION['token'])) {
                    echo "<a style='text-decoration: none;' class='btn btn-primary' href='logout.php'>Logout</a>";
                    echo "<a style='text-decoration: none;' class='btn btn-primary' href='home.php'>Dashboard</a>";
                }else{
            ?>
                <a style='text-decoration: none;' class='btn btn-primary' href='login.php'>Login</a>
                <?php }?>
        </div>
    </div>
<div class="container">
  <h2>Login form</h2>
  <?php
            if (isset($msg)) {
                echo $msg;
                unset($msg);
            }
        ?>
  <form action="" method='post'>
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" placeholder="Enter username" name="username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" placeholder="Enter password" name="pswd">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>