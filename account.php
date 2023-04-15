<?php
include('includes/config.php');

if(isset($_SESSION['userid'])!=""){
  header("Location:index.php");
}

if (isset($_POST["submit"])) {
    $fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
    $password = mysqli_real_escape_string($con, ($_POST["password"]));
    $username = mysqli_real_escape_string($con, ($_POST["username"]));
    $email = mysqli_real_escape_string($con, ($_POST["email"]));
    $dateofbirth = mysqli_real_escape_string($con, ($_POST["dateofbirth"]));
  
    $sql = "UPDATE tbluser SET fullname='$fullname', password='$password', username='$username', email='$email', dateofbirth='$dateofbirth' WHERE id='{$_SESSION["user_id"]}'";
    $result = mysqli_query($con, $sql);
    if ($result) {
      echo "<script>alert('Profile Updated successfully.');</script>";
    } else {
        echo "<script>alert('Profile can not Updated.');</script>";
        echo  $con->error;
      }
    }
    
else {
    echo "<script>alert('Password not matched. Please try again.');</script>";
  }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/profilestyle.css">
    <title>INDIA NEWS | Profile Page</title>
</head>

<body class="profile-page">
    <div class="wrapper">
        <h2>Profile</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <?php

            $sql = "SELECT * FROM tbluser WHERE userid='{$_SESSION["userid"]}'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="inputBox">
                        <input type="text" id="fullname" name="fullname" placeholder="Full Name" value="<?php echo $row['fullname']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="text" id="username" name="username" placeholder="User Name" value="<?php echo $row['username']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="Date" id="dateofbirth" name="dateofbirth" placeholder="Date of Birth" value="<?php echo $row['dateofbirth']; ?>" required>
                    </div>
                    <div class="inputBox">
                        <input type="email" id="email" name="email" placeholder="Email Address" value="<?php echo $row['email']; ?>" disabled required>
                    </div>
                    <div class="inputBox">
                        <input type="password" id="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>" required>
                    </div>
            <?php
                }
            }

            ?>
            <div>
                <button type="submit" name="submit" class="btn">Update Profile</button>
                <button type="button" name="logout" class="btn"><a href="logout.php" class="lgout">LOGOUT</a></button>
            </div>
        </form>
    </div>
</body>

</html>