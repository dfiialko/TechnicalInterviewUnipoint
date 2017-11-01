<?php
function post()
{
    if(!empty($_POST["post"]) && !empty($_POST["title"]) && strlen($_POST["post"]) >= 1)
    {
        require("database.php");
        $inputPost = filter_input(INPUT_POST,'post',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $inputTitle = filter_input(INPUT_POST,'title',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "INSERT INTO blog(post,title) Values (:inputPost,:inputTitle)";
        $statement = $db->prepare($query);
        $statement->bindvalue(':inputPost',$inputPost);
        $statement->bindvalue(':inputTitle',$inputTitle);
        $statement->execute();
        echo("Post created");
        header("Location:index.php");
    }
    else
    {
        echo("<h2>ERROR - Post cannot be empty.<br>Redirecting to homepage.</h2>");
        header("Refresh: 3;URL=index.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="post.php">Post</a>
                    </li>
                    <li>
                        <a href="archive.php">Archive</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Your new Blog
                    <small>uniPoint PNP</small>
                </h1>
                <form method="post">
                    <div>
                        <!--Blog Post -->
                     <div class="form-group">
                        <input type="text" class="form-control" name="title" placeholder="Title">
                        </button>
                        </span>
                    </div>
                    <div class="col-md-12 form-group" style="margin-left:0px;padding:0px;">
                        <label class="sr-only">Enter your post here</label>
                        <textarea class="form-control" id="comment" name="post" placeholder="Post"></textarea>
                    </div>
                    <br>
                    <input type="submit" class="btn btn-primary " name="submitpost" href="#" value="Submit">
                </form>
                <?php if($_POST && isset($_POST['submitpost']))
                    {
                        post();
                    }
                    ?>
            </div>
        </div>

    
        <footer>
            <div class="row">
                <div class="col-lg-12" style="position:relative;top:300px">
                    <p>Denys Fiialko</p>
                </div>
            </div>
        </footer>

    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
