<?php 
// if config/db.php is required, it comes with config/config.php
  require("config/db.php");
    //  require("config/config.php");

  // Create query
  $query = "SELECT * FROM posts ORDER BY created_at DESC";


  // Get the result of the query using the connection and the query
  $result = mysqli_query($conn, $query);

  // Fetch data in associative array datatype
  // Associative array has a key value pair, it is like a JavaScript object
  $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
//   var_dump($posts);

  // Free result
  // This free the result from the memory
  mysqli_free_result($result);

  // Close the connection
  mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP Blog</title>
    <link rel="stylesheet" href="https://bootswatch.com/3/cerulean/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-control="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="#" class="navbar-brand">PHP Blog</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
                    <li><a href="<?php echo ROOT_URL; ?>addpost.php">Add Post</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>POSTS</h1>
        <?php foreach ($posts as $post): ?>
            <div class="well">
                <h3><?php echo $post["title"]; ?></h3>
                <small>
                    Created on <?php echo $post["created_at"]; ?> By <?php echo $post["author"]; ?>
                </small>
                <p>
                    <?php echo $post["body"]; ?>
                </p>
                <a class="btn btn-default" href=" <?php echo ROOT_URL ?>post.php?id=<?php echo $post["id"]; ?>">Read More</a>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="../public/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>