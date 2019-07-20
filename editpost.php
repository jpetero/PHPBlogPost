<?php 
  require("config/db.php");
//   require("config/config.php");
  
  # UPDATING THE POST
  // Check for submit
  if (isset($_POST["submit"])){
    // Get form data
    $updated_id = mysqli_real_escape_string($conn, $_POST["updated_id"]);
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $body = mysqli_real_escape_string($conn, $_POST["body"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    $query = "UPDATE posts SET title='$title', body='$body', author='$author' WHERE id={$updated_id}";

    // This shows you the current query to the database
    // die($query);

    // mysqli_query($conn, $query);
    if (mysqli_query($conn, $query)){

        // Redirect to the home page
        header('Location: '.ROOT_URL.'');
        // echo ROOT_URL;
        
    } else{
        echo "Error: " . mysqli_error($conn);
    }
  }

  #  QUERY EACH INDIVIDUAL POST
    // Get ID
    // The function is use for security purpose because it converts any harmful characters to harmless featurres
    // $_GET["id"] is the property that comes with the GET Request
    $id = mysqli_real_escape_string($conn, $_GET["id"]);

  // Create query
  $query = "SELECT * FROM posts WHERE id = $id";


  // Get the result of the query using the connection and the query
  $result = mysqli_query($conn, $query);

  // This takes one post and turn it into an associative array
  // The associative is like JavaScript object
  $post = mysqli_fetch_assoc($result );
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
        <h1>Add Post</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post["title"]; ?>">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post["author"]; ?>">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"><?php echo $post["body"]; ?></textarea>
            </div>
            <input type="hidden" name="updated_id" value="<?php echo $post["id"]; ?>">
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </form>
    </div>
    <script src="../public/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>