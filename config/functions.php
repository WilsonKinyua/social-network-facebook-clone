<?php require "database.php";


/**=================================================HELPER FUNCTIONS ================================ */
/**=================================================HELPER FUNCTIONS ================================ */
/**=================================================HELPER FUNCTIONS ================================ */
/**=================================================HELPER FUNCTIONS ================================ */
/**=================================================HELPER FUNCTIONS ================================ */
/**=================================================HELPER FUNCTIONS ================================ */
/**
 * 
 * author:wilson kinyua
 * email: wilsonkinyuam@gmail.com
 * year created : Aug 2020
 * project: social network web app / Facebook clone
 * 
 */



function query($sql) {

    global $connection;

    return mysqli_query($connection,$sql);
    
}




function redirect($location) {

    return header("Location: $location");
}




function fetch_array($result) {

    global $connection;
  return  mysqli_fetch_array($result);
}




function last_id_insert() {

    global $connection;
    return mysqli_insert_id($connection);
}



function set_message($msg) {

    if(!empty($msg)) {

        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }

}



function display_message() {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }
}




function confirm($result){

    global $connection;
    
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}



function escape($string){
    global $connection;

    return mysqli_real_escape_string($connection,$string);
}


function count_rows($result) {

    return mysqli_num_rows($result);
}

/**=================================================Remove HTML tags from the input ======================================= */

function clean($string) {
    
    return strip_tags($string);
}


function token_generator() {

 return $token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));

}


function validation_form_errors($error_message) {


    $error_message = <<<DELIMETER
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> $error_message
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
DELIMETER;

return $error_message;
}
/**=================================================MAIL FUNCTION ======================================= */

function send_mail($email, $subject, $message, $headers) {

  return  mail($email, $subject, $message, $headers);

}

/**=================================================VALIDATION FUNCTIONS ================================ */
/**=================================================VALIDATION FUNCTIONS ================================ */
/**=================================================VALIDATION FUNCTIONS ================================ */
/**=================================================VALIDATION FUNCTIONS ================================ */
/**=================================================VALIDATION FUNCTIONS ================================ */
/**=================================================VALIDATION FUNCTIONS ================================ */


/**=================================================CHECK IF EMAIL EXIST ================================ */

function email_exists($email) {

    $query = query("SELECT id FROM users WHERE email = '$email' ");
    confirm($query);

    if(count_rows($query) == 1) {

        return true;

    } else {
        return false;
    }

}

/**=================================================CHECK IF USERNAME EXIST ================================ */

function username_exists($username) {

    $query = query("SELECT id FROM users WHERE username = '$username' ");
    confirm($query);

    if(count_rows($query) == 1) {

        return true;

    } else {
        return false;
    }

}

/**=================================================VALIDATION FUNCTIONS ================================ */

function validate_user_registration() {

  
    $errors     = [];
    $min        = 2;
    $max        = 30;
    $min_pass   = 8;

    if(isset($_POST['register'])) {
        
      $first_name       =  clean($_POST['first_name']);
      $first_name       =  str_replace(' ', '', $first_name); // Remove spaces
      $first_name       =  ucfirst(strtolower($first_name)); // Uppercase first letter
      
      $last_name        =  clean($_POST['last_name']);
      $last_name        =  str_replace(' ', '', $last_name);
      $last_name        =  ucfirst(strtolower($last_name)); 
      
      $email            =  clean($_POST['email']);
      $email            =  str_replace(' ', '', $email);
      $email            =  strtolower($email); 
      
      $confirm_email    =  clean($_POST['confirm_email']);
      $confirm_email    =  str_replace(' ', '', $confirm_email);
      $confirm_email    =  strtolower($confirm_email); 
      
      $password         =  clean($_POST['password']);
      $confirm_password =  clean($_POST['confirm_password']);

      


      /*******************first name validation************************************** */

      if(strlen($first_name) < $min) {

        $errors[] = "<div class ='alert alert-danger'>Your firstname cannot be less than {$min} characters<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
     
      }

      if(strlen($first_name) > $max) {

        $errors[] = "<div class ='alert alert-danger'>Your firstname cannot be more than {$max} characters<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if(empty($first_name)) {

        $errors[] = "<div class ='alert alert-danger'>Your firstname cannot be empty<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      /************************last name validation*********************************** */

      if(strlen($last_name) < $min) {

        $errors[] = "<div class ='alert alert-danger'>Your lastname cannot be less than {$min} characters<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if(strlen($last_name) > $max) {

        $errors[] = "<div class ='alert alert-danger'>Your lastname cannot be more than {$max} characters<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if(empty($last_name)) {

        $errors[] = "<div class ='alert alert-danger'>Your lastname cannot be empty<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      /***********************Email validation******************************************** */

      if(email_exists($email)) {

        $errors[] = "<div class ='alert alert-danger'>Email already exists please proceed to login!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
          
      }

      if(empty($email)) {

        $errors[] = "<div class ='alert alert-danger'>Email cannot be empty!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if(empty($confirm_email)) {

        $errors[] = "<div class ='alert alert-danger'>Confirm Email cannot be empty!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if($email !== $confirm_email) {

        $errors[] = "<div class ='alert alert-danger'>Your email input does not match to each other!!!! Please try again<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      /***********************Password validation******************************************** */

      if(strlen($password) < $min_pass) {

        $errors[] = "<div class ='alert alert-danger'>Password cannot be less than {$min_pass} characters<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }


      if(empty($password)) {

        $errors[] = "<div class ='alert alert-danger'>Password field cannot be empty!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if(empty($confirm_password)) {

        $errors[] = "<div class ='alert alert-danger'>Confirm Password field cannot be empty!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }

      if($password !== $confirm_password) {

        $errors[] = "<div class ='alert alert-danger'>Your password inputs does not match to each other!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
      }


      /***********************Displaying the errors**************************************** */

      if(!empty($errors)) {
          foreach ($errors as $error) {

            echo $error;
          }

      } else {

        if(register_user($first_name, $last_name, $email, $password)) {

            echo "<div class ='alert alert-success text-center'>User registered successfully.Please proceed to login.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

        } else {

            echo "<div class ='alert alert-danger text-center'>Failed to register!!!!Please try again<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
      }


    }
}

/**=================================================FUNCTIONS TO REGISTER USER ================================ */

function register_user($first_name, $last_name, $email, $password) {

   $first_name      = escape($first_name);
   $last_name       = escape($last_name);
   $email           = escape($email);
   $password        = escape($password);
   $date            =  date('Y-m-d');

    if(email_exists($email)) {

        return false;

    } else {

        // $password                = password_hash($password,PASSWORD_BCRYPT,array("cost" => 9));
        $password                   = md5($password);
        // Generate a username auto
        $username                   = strtolower($first_name  . "_" . $last_name);
        //  Check if username already exist
        $i = 0;
        $z = 4;
        if(username_exists($username)) {
            $i++;
            $z++;
            $username = $username . $i . $z;
            if(username_exists($username)) {
                $i++;
                $z++;
                $username = $username . $i . $z . $z;
            }
        }
        //  Generate  auto profile picture
        $rand = rand(1,2);
        if($rand == 1) {
            $profile_picture = "assets/images/profile_pics/defaults/head_emerald.png";
        } else {
            $profile_picture = "assets/images/profile_pics/defaults/head_green_sea.png";
        }
        // Generate a unique validation code to be used incase of forgot password
        $validation_code            = md5($username . microtime());
        // $validation_code            = md5(uniqid(rand(), true));

        $sql    = "INSERT INTO users (first_name, last_name, username, email, password, date, profile_photo, num_posts, num_likes, user_closed, friend_array, validation_code, active)";
        $sql   .= " VALUES('$first_name', '$last_name', '$username', '$email', '$password', '$date','$profile_picture', 0, 0, 'no', ',', '$validation_code', 1)";
        $result = query($sql);
        confirm($result);

        $subject = "ACTIVATION OF ACCOUNT";
        $message = " Please click the link below to activate your account
                         http://localhost/login/activate.php?email=$email&code=$validation_code
                    ";
        $headers  = "From: noreply@codetheguy.com";

        send_mail($email, $subject, $message, $headers);
        return true;
    }

}





/**=================================================USER LOGIN VALIDATION FUNCTIONS ============================== */

function validate_user_login() {


    $errors  = [];

    if(isset($_POST['login'])) {
        
     $email            =  clean($_POST['email']);
     $password         =  clean($_POST['password']);
     $remember_me      =  isset($_POST['remember']);

      /***********************email validation******************************************** */

      if(empty($email)) {

        $errors[] = "<div class ='alert alert-danger'>The email field cannot be empty!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
     
    }

      /***********************password validation******************************************** */

      if(empty($password)) {

        $errors[] = "<div class ='alert alert-danger'>The password field cannot be empty!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
     
    }

      /***********************Displaying the errors**************************************** */

      if(!empty($errors)) {

        foreach ($errors as $error) {
            
          echo $error;
        }

        
    } else {

        if(login_user($email, $password, $remember_me)) {

            redirect("admin.php");

        } else {

          echo "<div class ='alert alert-danger'>Error occurred while trying to login!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
    }
     
    }
}


/**=================================================LOGIN USER FUNCTIONS ======================================== */


function login_user($email, $password, $remember_me) {

    $sql = query("SELECT password, id FROM users WHERE email = '". escape($email) ."' AND active = 1 ");
    $result = $sql;
    confirm($result);

    if(count_rows($result) == 1) {

        $row = fetch_array($result);

        $db_password = $row['password'];

        /********************pulling out the password and changing it to its original************************************** */
        if(md5($password) === $db_password) {

          /**============setting and checking the cookie******************************************************************** */

          if($remember_me == "on") {

            setcookie("email", $email, time() + 86400);

          }
          /**============setting session for the email to be available in the whole site************************************* */
            $_SESSION['email'] = $email;

            return true;

        } else {

            return false;
        }

        return true;

    } else {

        return false;

    }

}


/**=================================================LOGGED IN FUNCTION ======================================== */


function logged_in_user() {

    if(isset($_SESSION['email']) || isset($_COOKIE['email'])) {

        return true;

    } else {
        
        return false;
    }

}

/**=================================================RECOVER PASSWORD FUNCTION ==================================== */

function recover_password() {

  if($_SERVER['REQUEST_METHOD'] == "POST"){

      if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {

        $email = escape($_POST['email']);

        if(email_exists($email)) {

          // $reset_code = md5($email . microtime());

          $reset_code      = md5(uniqid(rand(), true));

          setcookie("temp_reset_code",$reset_code, time() + 9000 );

          $sql = query("UPDATE users SET validation_code = '". escape($reset_code) ."' WHERE email = '". escape($email) ."' ");
          confirm($sql);

          $subject = "RESET CODE";
          $message = "Here is the password reset code {$reset_code} <br>
                   Click here to reset your password http://localhost/login/code.php?email=$email&code=$reset_code
                      ";
          $headers  = "From: noreply@wilsonkinyua.com";

          if(send_mail($email, $subject, $message, $headers)) {

            echo "<div class ='alert alert-success'>Check your email for the reset code!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

          } else {

            echo "<div class ='alert alert-danger'>Reset code was not sent. Please try again later!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

          }

        } else {

          echo "<div class ='alert alert-danger'>Email does not exist!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }

      } else {

        redirect("login.php");

      }
    
  }

        if(isset($_POST['cancel_submit'])) {

          redirect("login.php");
          
        }
}


/**=================================================VALIDATION OF THE CODE FUNCTION ==================================== */


function validate_code() {

    if(isset($_COOKIE['temp_reset_code'])) {

        if(!isset($_GET['email']) && !isset($_GET['code'])) {

          redirect("index.php");

        } elseif (empty($_GET['email']) || empty($_GET['code']) ) {

          redirect("index.php");

        } else {

          if(isset($_POST["code"])) {

           $email           = clean($_GET['email']);
           $validation_code = clean($_POST["code"]);

           $sql = "SELECT id FROM users WHERE validation_code = '". escape($validation_code) ."' AND email =  '". escape($email) ."'";
           $result = query($sql);

            if(count_rows($result) == 1) {

                setcookie("temp_reset_code",$validation_code, time() + 3000 );
                redirect("reset.php?email=$email&code=$validation_code");

            } else {

              set_message("<div class ='alert alert-danger text-center'>Sorry wrong validation code!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
              redirect("reset.php");
            }

          }
        }
 
      

      

    } else {
      set_message("<div class ='alert alert-danger text-center'>Sorry your validation code has expired!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
      redirect("recover.php");

    }
}


/**=================================================PASSWORD RESET FUNCTION ==================================== */


function password_reset() {

        if(isset($_COOKIE['temp_reset_code'])) {

          if(isset($_GET['email']) && isset($_GET['code'])) {

          if(isset($_SESSION['token']) && isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {

            if($_POST['password'] === $_POST['confirm_password']) {

              $password = $_POST['password'];
              $email    = $_GET['email'];

              $password             = md5($password);
              $sql                  = "UPDATE users SET password = '". escape($password) ."', validation_code = 0 WHERE email = '".escape($email) ."' ";
              $result               = query($sql);

              set_message("<div class ='alert alert-success text-center'>Password updated successfully. You can now login!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
              redirect("login.php");

            } 

            } 
            
          }

          } else {

            set_message("<div class ='alert alert-danger text-center'>Sorry your time has expired!!!!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
            redirect("recover.php");

          }

}