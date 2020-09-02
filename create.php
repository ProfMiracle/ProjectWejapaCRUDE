<?php require_once 'db.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $cont = mysqli_real_escape_string($con, $_POST['content']);
        $title = mysqli_real_escape_string($con, $_POST['title']);

        if (mysqli_query($con, "INSERT INTO post (`user_id`, `title`, `content`) VALUE ('$_SESSION[id]', '$title', '$cont')")) {
            $msg =  "<div class=\"alert alert-success\">
                                <strong>Nice!</strong> Post created successfully.
                                </div>";
        }
        else {
            $msg =  "<div class=\"alert alert-danger\">
                                <strong>Error!</strong> Post could not be created try again later.
                                </div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog||eMiracle</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class='jumbotron text-center'>
        <h1>Create Post</h1>
        <div class="btn-group">
            <?php 
                if (isset($_SESSION['token'])) {
                    //echo $_SESSION['token'];
                    echo "<a style='text-decoration: none;' class='btn btn-warning' href='logout.php'>Logout</a>";
                    echo "<a style='text-decoration: none;' class='btn btn-primary' href='home.php'>Dashboard</a>";
                }else{
            ?>
                <a style='text-decoration: none;' class='btn btn-primary' href='login.php'>Login</a>
                <?php }?>
        </div>
    </div>

    <div class='container'>
        <?php
            if (isset($msg)) {
                echo $msg;
                unset($msg);
            }
        ?>
                    <form action='' method='post'>
                    <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" value="" name="title">
                    </div>
                    <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea name='content' cols="3" rows="10" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Create</button>
                    </form>
    </div>
</body>
</html>