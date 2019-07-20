<?php 
  require("config/db.php");
//   require("config/config.php");
  
  // Check for submit
  if (isset($_POST["submit"])){
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $body = mysqli_real_escape_string($conn, $_POST["body"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);

    $query = "INSERT INTO posts(title, body, author) VALUES('$title', '$body', '$author')";
    // mysqli_query($conn, $query);

    if (mysqli_query($conn, $query)){

        // Redirect to the home page
        header('Location: '.ROOT_URL.'');
    } else{
        echo "Error: " . mysqli_error($conn);
    }
  }

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
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" class="form-control">
            </div>
            <div class="form-group">
                <label>Body</label>
                <textarea name="body" class="form-control"></textarea>
            </div>
            <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </form>
    </div>
    <script src="../public/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>