
<?php
  session_start();
  include "init.php";
  include $tpl."header.php";
  $action=isset($_GET['action'])?$_GET['action']:"noaction";
  $error="";
  if($action=="signin"){
        if($_SERVER['REQUEST_METHOD']=="POST"){
                $username=$_POST['email'];
                $password=$_POST['password'];
                $statament=$con->prepare("SELECT * FROM users WHERE Email =? AND  Password=?");
                $statament->execute(array($username,$password));
                $row=$statament->fetch();
                if($statament->rowCount()>0){
                        $_SESSION['user']=$row;
                        header("Location:index.php");
                        exit();

                }
                else{
                        $error="Incorrect email or Password";
                }
        }
  }
  ?>
  <!-- Start Login Section (Sign-up) And (Sign-in) -->
  <section class="login-section">
        <div class="container d-container">
            <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">  
                  <div class="login_image">
                            <img src="images/login_image.jpg">
                  </div>    
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                   <form class="sign-in-page" action="?action=signin" method="post">
                          <h2 class="text-center mb-4">Sign in</h2>
                          <?php 
                              if(!empty($error)){
                                    echo "<div class='signin-filed-error'>";
                                          echo '<span id="sign-in-error"><i class="fa-solid fa-xmark" ></i></span>';
                                          echo "<p>".$error."</p>"; 
                                    echo "</div>";
                              }
                          ?>
                          <div class="input-field" >
                              <i class="fa-regular fa-user input-field-icon icons"></i>
                              <input type="email" name="email" class="input-field-text" placeholder="Saisir Votre email" required>
                          </div>
                          <div class="input-field">
                              <i class="fa-solid fa-unlock icons"></i>
                              <input type="password" name="password" class="input-field-text" placeholder="Saisir Votre Password" required>
                          </div>
                          <div class="login-button">
                              <input type="submit" value="Login">
                          </div>
                          <div class="mt-3 signin-register">
                                <p class="signin-register">Don't have an account ?<a href="signup.php">  Register</a></p>
                          </div>
                  </form>
            </div>
            </div>
        </div>
  </section>
  <!-- End Login Section (Sign-up) And (Sign-in) -->

 <?php include $tpl."footer.php";?>
