<?php 
  require("config/db.php");
  // require("config/config.php");

  # QUERY ONE INDIVIDUAL POST
    // Get ID
    // The function is use for security purpose because it converts any harmful characters to harmless featurres
    // $_GET["id"] is the property that comes with the GET Request

    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    // Create query
    $query = "SELECT * FROM posts WHERE id = {$id}";
  
  
    // Get the result of the query using the connection and the query
    $result = mysqli_query($conn, $query);
  
    // This takes one post and turn it into an associative array
    // The associative is like JavaScript object
    $post = mysqli_fetch_assoc($result);
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
    <!-- <link rel="stylesheet" href="../public/bootstrap.css"> -->
    <link rel="stylesheet" href="https://bootswatch.com/3/cerulean/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a class="btn btn-default" href="<?php echo ROOT_URL ?>">Back</a>
        <h1><?php echo $post["title"]; ?></h1>
        <small>
            Created on <?php echo $post["created_at"]; ?> By <?php echo $post["author"]; ?>
        </small>
        <p>
            <?php echo $post["body"]; ?>
        </p>
        <hr>

        <!-- Delete button -->
        <form method="POST" action="<?php echo ROOT_URL; ?>deletepost.php" class="pull-right">
            <input type="hidden" name="delete_id" value="<?php echo $post["id"]; ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-danger">
        </form>

        <a href="<?php echo ROOT_URL ?>editpost.php?id=<?php echo $post["id"]?>" class="btn btn-default">Edit</a>
    </div>
</body> 
</html>