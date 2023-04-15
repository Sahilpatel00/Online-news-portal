<?php
    $db = mysqli_connect('localhost','root','','newsportal');
    if(isset($_SESSION['userid'])!=""){
        header("Location:index.php");
    }
    //registration part
    if(isset($_POST['reg_user'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $fullname = mysqli_real_escape_string($db, $_POST['fullname']);
        $dob = mysqli_real_escape_string($db, $_POST['dob']);

        $duplicate=mysqli_query($db,"select * from tbluser where username='$username' or email='$email'");
        if (mysqli_num_rows($duplicate)>0){
            header("Location: userlogin.php?message=User name or Email id already exists.");
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
                $email_error = "Please Enter Valid Email ID";
                if(strlen($password) < 5) {
                    $password_error = "Password must be minimum of 5 characters";
                }
            }
            
        }else{
            if(mysqli_query($db, "INSERT INTO tbluser(userid, fullname, username, email,password, dateofbirth) VALUES('".NULL."','" . $fullname . "','" . $username . "', '" . $email . "', '" . $password . "','".$dob."')")) {
                    function_as("Account created");
            } else {
                    echo "Error: " ."$sql". mysqli_error($db);
                }
        }
        mysqli_close($db);       
    }
?>

<?php 
//login part
    $db = mysqli_connect('localhost','root','','newsportal');
    /*if(isset($_SESSION['userid'])!=""){
        header("Location:index.php");
    }*/
    if(isset($_POST['login_user'])){
        $email = mysqli_real_escape_string($db,$_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        
        $sql = "select * from tbluser where email='$email' and password ='$password'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $active = $row['active'];
        $count = mysqli_num_rows($result);

        if($count == 1){ 
            header("location: index.php");
        }else{
            function_lnun("Incorrect Email or Password");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css" />
    <title>INDIA NEWS | User Panel</title>
</head>

<body>
    
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                
                <form action="userlogin.php" class="sign-in-form" method="POST">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Email" name="email"/>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password"/>
                    </div>
                    <input type="submit" value="Login" class="btn solid" name="login_user"/>
                    <?php
                        function function_lnun($msg){
                            echo "<script type='text/javascript'>alert('$msg');</script>";
                        }
                    ?>
                    <a href="home.php"><input type="button" value="Home" class="btn solid" /></a>
                </form>

                <form action="userlogin.php" class="sign-up-form" method="POST">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Username" name="username"/>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email"/>
                    </div>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" />
                    </div>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Full Name" name="fullname"/>
                    </div>

                    <div class="input-field">
                        <i class="fa fa-calendar" aria-hidden="true"></i>
                        <input type="Date" placeholder="Date Of Birth" name="dob"/>
                    </div>
                    
                    <input type="submit" class="btn" value="Sign up" name="reg_user"/>
                    <?php
                        function function_as($msg){
                            echo "<script type='text/javascript'>alert('$msg');</script>";
                        }
                    ?>
                    <a href="home.php"><input type="button" value="Home" class="btn solid" /></a>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Click on sign up button and create an account for regular news updates!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Click on sign in button and enter your Username and password to login!
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="./js/app.js"></script>
    
</body>

</html>