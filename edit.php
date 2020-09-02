<?php require_once 'db.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $cont = mysqli_real_escape_string($con, $_POST['content']);
        $title = mysqli_real_escape_string($con, $_POST['title']);

        if (mysqli_query($con, "UPDATE post set title = '$title', content = '$cont' WHERE id = '$_POST[id]'")) {
            $msg =  "<div class=\"alert alert-success\">
                                <strong>Nice!</strong> Post updated successfully.
                                </div>";
        }
        else {
            $msg =  "<div class=\"alert alert-danger\">
                                <strong>Error!</strong> Post could not be updated try again later.
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
        <h1>Edit Post</h1>
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
        <?php
            $post = mysqli_query($con, "SELECT * FROM `post` where id = '$_GET[id]'");

            while ($a = $post->fetch_object()) {
                echo "
                    <form action='' method='post'>
                    <div class=\"form-group\">
                    <label for=\"title\">Title:</label>
                    <input type=\"text\" class=\"form-control\" value=\"$a->title\" name=\"title\">
                    <input type=\"hidden\" class=\"form-control\" value=\"$_GET[id]\" name=\"id\">
                    </div>
                    <div class=\"form-group\">
                    <label for=\"content\">Content:</label>
                    <textarea name='content' cols=\"3\" rows=\"10\" class=\"form-control\">$a->content</textarea>
                    </div>
                    <button type=\"submit\" class=\"btn btn-success\">Edit</button>
                    </form>"
                ;
            }
        ?>
    </div>
</body>
</html>