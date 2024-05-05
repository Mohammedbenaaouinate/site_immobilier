<?php
  session_start();
  include "init.php";
  include $tpl."header.php";
  $action =isset($_GET['action'])?$_GET['action']:"noaction";
  if($action=="signup"){
                if($_SERVER['REQUEST_METHOD']=="POST"){
                                $username=$_POST['username'];
                                $password=$_POST['password'];
                                $con_password=$_POST['con-password'];
                                $email =$_POST['email'];
                                $fullname=$_POST['fullname'];
                                $errors =[];
                                $email_exist="";
                                if(empty($username)){
                                        $errors[]="The Username Can't be Empty.";
                                }
                                if(empty($password)){
                                        $errors[]="The Password Can't Be Empty.";
                                }
                                if(empty($con_password)){
                                        $errors[]="The Password Confirmation Can't Be Empty.";
                                }
                                if(empty($email)){
                                        $errors[]="The Email Can't Be Empty";
                                }
                                if(empty($fullname)){
                                        $errors[]="The Fullname Can't be Empty";
                                }
                                if($password!=$con_password){
                                        $errors[]="Please ensure that the password and password confirmation fields match exactly.";
                                }
                                $statement1=$con->prepare("SELECT * FROM users WHERE Email=?");
                                $statement1->execute(array($email));
                                if($statement1->rowCount()>0){ 
                                        $email_exist="The Email Aleardy Exists";
                                }
                                if(empty($errors) && empty($email_exist)){
                                                $statement=$con->prepare("INSERT INTO users(Username,Email,Password,Group_ID,Fullname)
                                                                        VALUES
                                                                        (?,?,?,?,?)
                                                ");
                                                $statement->execute(array($username,$email,$password,0,$fullname));
                                                if($statement->rowCount()>0){
                                                       $statement2=$con->prepare("SELECT * FROM users Where Email=?");
                                                       $statement2->execute(array($email));
                                                       $row=$statement2->fetch();
                                                       $_SESSION['user']=$row;
                                                      header("Location:Success_Sign_Up.php");
                                                      exit();
                                                }
                                 }    
                }
}
?>



<!-- Start Sign up Section  -->
<section class="sign-up-section">
                <div class="container container-sign-up">
                    <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <h2 class="text-center mb-4">Sign Up</h2>
                                <div id="r_errors_repetition">
                                                <?php
                                                        if(isset($email_exist) && !empty($email_exist)){
                                                                echo "<p class='text-danger'>*The Email Aleardy Exist In DataBase </p>";
                                                        }
                                                ?>
                                        </div>
                                <form class="sign-up-form" action="?action=signup" method="POST">
                                        <div class="input-field input-field-sign-up">
                                                <i class="fa-regular fa-user icons"></i>
                                                <input type="text" name="username" class="input-field-text input-sign-up" placeholder="Saisir Votre Username" required>
                                        </div>
                                        <div id="user_error"></div>
                                        <div class="input-field input-field-sign-up">
                                                <i class="fa-solid fa-unlock icons"></i>
                                                <input type="password" name="password" class="input-field-text input-sign-up" placeholder="Saisir Votre Password" required>
                                        </div>
                                        <div id="password_error"></div>
                                        <div class="input-field input-field-sign-up">
                                                <i class="fa-regular fa-circle-check icons"></i>
                                                <input type="password" name="con-password" class="input-field-text input-sign-up" placeholder="Confirmer Votre Password" require>
                                        </div>
                                        <div id="cpassword_error"></div>
                                        <div class="input-field input-field-sign-up">
                                                <i class="fa-solid fa-at icons"></i>
                                                <input type="email" name="email" class="input-field-text input-sign-up" placeholder="Saisir Votre Adresse mail" id="email_user" required>
                                        </div>
                                        <div id="email_error"></div>
                                        <div class="input-field input-field-sign-up">
                                                <i class="fa-regular fa-circle-user icons"></i>
                                                <input type="text" name="fullname" class="input-field-text input-sign-up" placeholder="Saisir Votre Fullname" required>
                                        </div>
                                        <div id="fullname_error"></div>
                                        <div class="login-button">
                                                <input type="submit" value="SignUp" id="button-submit">
                                        </div>
                                        <div class="sign-up-footer mt-2">
                                                <p class="sign-up-registration">If you have an account, <a href="signin.php">sign in</a></p>
                                        </div>
                                </form>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="sign_up_image">
                                                <img src="images/signup_image.jpg">
                                        </div>
                            </div>
                    </div>
                </div>
</section>

<!-- End Sign Up Section  -->

<?php include $tpl."footer.php";?>