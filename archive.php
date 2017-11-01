<?php
require('database.php');
function monthcount($i)
{
$month = date('Y-m',strtotime('-'.$i.'month'));
return $month;
}
if(isset($_GET['mm']))
{
    if(preg_match("/[0-9]{4}-(0[1-9]|1[0-2])/",$_GET['mm']))
    {
    $daterecieved = $_GET['mm'];
    $query = "SELECT * FROM blog WHERE date_format(datecreated,'%Y-%m') =:daterecieved";
    $selectnotes = $db->prepare($query);
    $selectnotes->bindvalue(":daterecieved",$daterecieved);
    $selectnotes->execute();
    }
    else
    {
        echo("<h2>ERROR - Something went wrong.<br>Redirecting to homepage.</h2>");
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
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Your new Blog
                    <small>uniPoint PNP</small>
                </h1>
            <?php if (isset($_GET['mm'])):?>
                <?php if($selectnotes->RowCount() > 0):?>
                    <?php foreach($selectnotes as $note):?>
                        <div>
                            <!--Blog Post -->
                        <h2>
                            <a href="#"><?=$note['title']?></a>
                        </h2>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?= date_format(new DateTime($note['datecreated']),'F d, Y, h:i a');?></li></p>
                        <p><?=substr($note['post'],0,200)?></p>
                        <?php if(strlen($note['post']) >= 200):?>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <?php endif?>
                        <hr>
                        </div>
                    <?php endforeach?>
                <?php else:?>
                    <div >
                        <h1>There are no blog posts</h1>
                    </div>
                <?php endif?>
        <?php else:?>
         <div class="col-md-4">
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Archive</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
            
                                <?php for($i=0;$i< 12;$i++):?>
                                <li><a href="archive.php?mm=<?=monthcount($i)?>"><?=date('M Y',strtotime('-'.$i.'month'))?></a>
                                <?php endfor?>
                            </ul>
                        </div>
        <?php endif?>
                

               
                <!-- Pager -->
               

            </div>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12" style="position:relative;top:250px">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
