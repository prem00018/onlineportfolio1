<?php
include('connection.php');

if (isset($_POST['submit'])) {
    // Sanitize user input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);

    // Prepare SQL statement
    $sql = "SELECT * FROM `login` WHERE username = '$username' AND password = '$password'";


    // Execute query and handle potential errors
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }

    // Check if exactly one user matches
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        header("Location: trialhome.html");
        exit(); // Ensure no further code is executed
    } else {
        echo '<script>
                alert("Login failed. Invalid username or password!");
                window.location.href = "index.php";
              </script>';
    }
}
?>
