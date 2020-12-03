<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Confirmation: The Tackle Box</title>
  
  <!--This file is for all files-->
  <link rel="stylesheet" type="text/css" href="../Universal/style.css" />
  
  <!-- <script type="text/javascript" src="../Universal/function.js"> </script> -->

  <meta charset="UTF-8">
</head>

<body>
<!--Container separates body from footer-->
<div class="main-container">
  <h1 class ="companyName">The Tackle Box</h1>
    <!-- <script>
      document.write(setUpMenu());
      document.write(setUpSideNav());
    </script> -->

    <?php
        include_once '../Universal/function.php';
    ?>
  
  <div class="content-container">
    <?php
    $db = mysqli_connect("localhost", "group5", "k9mWTDJZ7V0w");
    if(!$db){
        print "<h2> Error - Could not connect to server </h2>";
        exit;
    }

    $selectdb = mysqli_select_db($db, "group5");

    if(!$selectdb){
        print "<h2> Error - Unable to select specific database </h2>";
        exit;
    }

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['Pass'];

    $emailQuery = htmlspecialchars(stripcslashes($email));
    $usernameQuery = htmlspecialchars(stripcslashes($username));
    $passwordQuery = htmlspecialchars(stripcslashes($password));

    $query = "SELECT * FROM User WHERE email = '$emailQuery' AND display_name='$usernameQuery'";
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) > 0){
        $query = "UPDATE User SET password='$passwordQuery' WHERE email='$emailQuery' AND display_name='$usernameQuery'";
        $result = mysqli_query($db, $query);
        if($result){
            print"<h2>You successfully updated your password.</h2>";
        }
        else{
            print"<h2>Was unable to change password.  Try again!</h2>";
        }
    }
    else{
        print"<h2>Incorrect credentials to change password.</h2>";
    }
    ?>
    <h2>Click <a href="../Homepage/Homepage.php">here</a> to go back to the homepage.</h2>
  </div>

<!--Separate footer from body-->
</div>    
<!-- <script>
  document.write(setUpFooter());
</script> -->
<?php
    include_once '../Universal/footer.php';
?>
</body>
</html>
