<?php require_once 'db.php';
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        if (isset($_POST['delete'])) {
            $id = $_POST['delete'];
            
            if (mysqli_query($con, "delete from post where id = {$id}")) {
                $msg =  "<div class=\"alert alert-success\">
                                <strong>Nice!</strong> Post deleted successfully.
                                </div>";
            }
            else {
                $msg =  "<div class=\"alert alert-danger\">
                                <strong>Error!</strong> Post could not be deleted try again later.
                                </div>";
            }
        }

        if (isset($_POST['edit'])) {
            $id = $_POST['edit'];
            $url = "edit.php?id=".$id;

            header('location:' .$url);
        }
    }
?>
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
                    echo "<a style='text-decoration: none;' class='btn btn-warning' href='logout.php'>Logout</a>";
                    echo "<a style='text-decoration: none;' class='btn btn-primary' href='index.php'>Home</a>";
                }else{
            ?>
                <a style='text-decoration: none;' class='btn btn-primary' href='login.php'>Login</a>
                <?php }?>
        </div>
    </div>

    <div class='container'>
        <a style='text-decoration: none;' class='btn btn-success' href="create.php">Create New Post</a>
        <h2>Your Post</h2>
        <p>listed here is a list of posts published by you:</p>       
        
        <?php
            if (isset($msg)) {
                echo $msg;
                unset($msg);
            }
        ?>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Excerpt</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

        <?php
            $post = mysqli_query($con, "SELECT * FROM `post` where user_id = $_SESSION[id] ORDER BY id");

            while ($a = $post->fetch_object()) {
                $action = "<form action='' method='post'>
                    <button type='submit' name='delete' value ='$a->id' class='btn btn-danger'>DELETE</button>
                    <button type='submit' name='edit' value ='$a->id' class='btn btn-warning'>EDIT</button>
                </form>";
                echo "
                        <tr>
                            <td>$a->title</td>
                            <td>$a->content</td>
                            <td>$action</td>
                        </tr>"
                ;
            }
        ?>
                    </tbody>
        </table>
    </div>
</body>
</html>