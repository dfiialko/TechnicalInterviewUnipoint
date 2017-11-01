<?php
require('database.php');

function monthcount($i)
{
$month = date('Y-m',strtotime('-'.$i.'month'));
return $month;
}
$query = "SELECT * FROM blog ORDER BY datecreated LIMIT 5";
$selectnotes = $db->prepare($query);
$selectnotes->execute();
function blogcount($datemonth,$db)
{
    $dateposted = $datemonth;
    $archiveQuery = "SELECT COUNT(*) AS TOTAL FROM blog where date_format(datecreated,'%Y-%m') = :dateposted";
    $blogcount =$db->prepare($archiveQuery);
    $blogcount->bindvalue(":dateposted",$dateposted);
    $blogcount->execute();
    foreach($blogcount as $count)
    {
        return $count['TOTAL'];
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
            <?php if($selectnotes->RowCount() > 0):?>
                <?php foreach($selectnotes as $note):?>
                    <div>
                        <!--Blog Post -->
                    <h2>
                        <a href="fullpost.php?id=<?=$note['id']?>"><?=$note['title']?></a>
                    </h2>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?= date_format(new DateTime($note['datecreated']),'F d, Y, h:i a');?></li></p>
                    <p><?=substr($note['post'],0,200)?></p>
                    <?php if(strlen($note['post']) >= 200):?>
                    <a class="btn btn-primary" href="fullpost.php?id=<?=$note['id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <?php endif?>
                    <hr>
                    </div>
                <?php endforeach?>
            <?php else:?>
                <div >
                    <h1>There are no blog posts</h1>
                </div>
        <?php endif?>
                

               
             
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">


                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Archive</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
            
                                <?php for($i=0;$i< 12;$i++):?>
                                <li><a href="archive.php?mm=<?=monthcount($i)?>"><?=date('M Y',strtotime('-'.$i.'month'))?>  (<?= blogcount(monthcount($i),$db)?>)</a>
                                <?php endfor?>
                            </ul>
                        </div>

               
        </div>
        <!-- /.row -->
         <!-- Side Widget Well -->
                <div class="well">
                    <h4>Info</h4>
                    <p>This blog was created with bootstrap template.</p>
                    Added functionality:<br>
                    <ul>
                    <li> Displays 5 blog posts on the page,ordered by the time created.</li>
                    <li>Post that is bigger than 200 characters,gets cut and displays a button "Read More"
                    that takes the user to the page with full post</li>
                    <li>Archive displays 12 months starting from todays month and shows count of how many posts were posted in that specific month</li>
                    </ul>
                </div>

            </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12" style="position:relative;left:-780px;top:-100px">
                    <p>Denys Fiialko</p>
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
