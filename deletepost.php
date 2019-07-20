<?php 
    require("config/db.php");
    // require("config/config.php");

    # DELETE ONE POST
    if (isset($_POST["delete"])){
        // Get form data
        // print_r($_POST);
        $delete_id = mysqli_real_escape_string($conn, $_POST["delete_id"]);
        // echo $delete_id;

        $query = "DELETE FROM posts WHERE id = {$delete_id}";

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
?>