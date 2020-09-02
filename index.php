<?php require_once 'db.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class='jumbotron text-center'>
        <h1>Welcome to a CRUD blog site</h1>
        <div class="btn-group">
            <?php 
                if (isset($_SESSION['token'])) {
                    //echo $_SESSION['token'];
                    echo "<a style='text-decoration: none;' class='btn btn-primary' href='logout.php'>Logout</a>";
                    echo "<a style='text-decoration: none;' class='btn btn-primary' href='home.php'>Dashboard</a>";
                }else{
            ?>
                <a style='text-decoration: none;' class='btn btn-primary' href='login.php'>Login</a>
                <?php }?>
        </div>
    </div>

    <div class='container'>
        <?php
            $post = mysqli_query($con, 'SELECT * FROM `post` ORDER BY id');

            while ($a = $post->fetch_object()) {
                echo "
                    <div class='container text-center' style='border-style: solid;'>
                        <h3>$a->title</h3>
                        <br>
                        <p>$a->content</p>
                        <span>Author:" .getUsername($a->user_id) ."</span>
                    </div><br>"
                ;
            }
        ?>
    </div>
</body>
</html>