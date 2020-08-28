<?php
require("config/functions.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register on Social Network</title>
    <link rel="stylesheet" href="assets/css/register.css">
    
</head>

<body>
<?php  

// if(isset($_POST['register'])) {
//     echo '
//     <script>

//     $(document).ready(function() {
//         $("#first").hide();
//         $("#second").show();
//     });

//     </script>

//     ';
// }


?>
    <div class="wrapper">
        <div class="login_box">
        <div class="login_header">
            <h1>Social Network!!</h1>
            Login or Signup below!!!
        </div>
        <div id="first">
            <form class="form-horizontal" method="post" action="register.php">

            <?php validate_user_login(); ?>

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>" placeholder="Enter your Email" required />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password" required />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="remember" class="cols-sm-12 control-label">Remember Me <span></span> <input type="checkbox" name="remember" /></label>
            </div>
            <div class="form-group ">
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-block login-button">Login</button> <br>
                <a href="#" id="signup" class="signup">Don't have an account?Create one</a>
            </form>
        </div>


        <div id="second">

                <form class="form-horizontal" method="post" action="register.php">

                <?php validate_user_registration(); ?>

                <div class="form-group">
                    <div class="cols-sm-10">
                        <div class="input-group">

                            <input type="text" class="form-control" name="first_name" required id="first_name" value="<?php echo isset($_POST["first_name"]) ? $_POST["first_name"] : ""; ?>" placeholder="Enter your First Name" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="last_name" required id="last_name" value="<?php echo isset($_POST["last_name"]) ? $_POST["last_name"] : ""; ?>" placeholder="Enter your Last Name" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" required id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>" placeholder="Enter your Email" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="confirm_email" required id="confirm_email" value="<?php echo isset($_POST["confirm_email"]) ? $_POST["confirm_email"] : ""; ?>" placeholder="Confirm Email" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" required id="password" placeholder="Enter your Password" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <input type="password" class="form-control" name="confirm_password" required id="confirm_password" placeholder="Confirm your Password" />
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <button type="submit" name="register" class="btn btn-primary btn-lg btn-block login-button">Register</button> <br>
                    <a href="#" id="signin" class="signin">Already have an account?Login here</a>
                </form>
        </div>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
                //On click signup, hide login and show registration form
                $("#signup").click(function() {
                    $("#first").slideUp("slow", function() {
                        $("#second").slideDown("slow");
                    });
                });

                //On click signup, hide registration and show login form
                $("#signin").click(function() {
                    $("#second").slideUp("slow", function() {
                        $("#first").slideDown("slow");
                    });
                });

        });
    </script>
    <!-- <script src="assets/js/register.js"></script> -->
</body>

</html>