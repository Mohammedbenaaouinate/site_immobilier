<?php
             session_start();
             include "init.php";
             include $tpl."header.php";
             include $tpl."navbar.php";
             $action = isset($_GET['action'])?$_GET['action']:"noaction";
             if(isset($_SESSION) && $action=="Edit"){

                        $user_id=$_SESSION['user']['User_ID'];
                        $statement = $con->prepare("SELECT * FROM users WHERE User_ID=?");
                        $statement->execute(array($user_id));
                        $row=$statement->fetch();
                        if($statement->rowCount()>0){ ?>
                                <section class="MyProfile">
                                        <div class="containter active">
                                                <h5>
                                                        <span>Modifier Mes informations</span>
                                                        <i class="fas fa-angle-down"></i>
                                                </h5>
                                                <form action="EditProfile.php?action=Update" method="post" class="border border-primary p-2 pb-4" enctype="multipart/form-data"> 
                                                        <div class="my_image_profile d-flex align-items-center justify-content-center mt-5 mb-5">
                                                                <?php 
                                                                                if(!empty($row['Photo'])){
                                                                                        echo "<img src='".$row['Photo']."' class='rounded-circle  border border-primary'".">";
                                                                                }
                                                                                else{
                                                                                        echo "<img src='./images/default_images/image1.jpg' class='rounded-circle  border border-primary'>";
                                                                                }
                                                                ?>
                                                        </div>
                                                <div class="my_information_profile row gx-5">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 first_column">
                                                                <div class="mb-3">
                                                                        <label for="Username" class="form-label">Username:<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="Username" name="Username" aria-describedby="Username" value="<?php echo $row['Username']; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                        <label for="exampleInputEmail1" class="form-label">addresse mail:<span class="text-danger">*</span></label>
                                                                        <input type="email" class="form-control" id="exampleInputEmail1" name="addrresse_mail" aria-describedby="emailHelp" value="<?php echo $row['Email']; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                        <label for="formFile" class="form-label">Modifier L'image:</label>
                                                                        <input class="form-control" type="file" id="formFile" name="img_profile" accept="image/*">
                                                                </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12 second_column">
                                                                <div class="mb-3">
                                                                        <label for="Fullname" class="form-label">Fullname:<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="Fullname" name="Fullname" aria-describedby="Username" value="<?php echo $row['Fullname']; ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                                <label for="InputPassword1" class="form-label">Password:<span class="text-danger">*</span></label>
                                                                                <input type="password" class="form-control" id="InputPassword1" name="Password" value="<?php echo $row['Password'];?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                                <label for="InputPassword2" class="form-label">Confirm password:<span class="text-danger">*</span></label>
                                                                                <input type="password" class="form-control" id="InputPassword2" name="c_Password" value="<?php echo $row['Password'];?>" required>
                                                                </div>
                                                        </div>
                                                        <div class="forerrors">

                                                        </div>
                                                        <div class="btn_submit mt-3">
                                                                <button class="btn btn-primary mx-auto" type="submit">Update Profile</button>
                                                        </div>

                                                </div>
                                                </form>
                                         </div>
                                </section>


                        <?php  }
               }
               elseif($action=="Update"){
                   echo "<div class='container mt-5 p-5'>";
                                $user_id_session=$_SESSION['user']['User_ID'];
                                $Username= $_POST['Username'];
                                $addr_mail=$_POST['addrresse_mail'];
                                $Fullname=$_POST['Fullname'];
                                $password=$_POST['Password'];
                                $c_password=$_POST['c_Password'];
                                $img_name  =$_FILES['img_profile']['name'];
                                $img_size  =$_FILES['img_profile']['size'];
                                $errors=[];
                                if(empty($Username)){
                                        $errors[]="Username ne peut pas être vide";
                                }
                                if(empty($addr_mail)){
                                        $errors[]="L'addresse ne peut pas être vide";
                                }
                                if(empty($Fullname)){
                                        $errors[]="Le nom Complet ne peut pas être vide";
                                }
                                if($password!==$c_password){
                                        $errors[]="Le mot de passe et ça confirmation ne sont pas identique";
                                }
                                if(empty($errors)){
                                        if($img_size!=0){
                                                $path_image="./images/userprofile/".rand(1,100000000).$img_name;
                                                move_uploaded_file($_FILES["img_profile"]["tmp_name"],$path_image);
                                                $statement=$con->prepare("UPDATE users SET Username=?,Email=?,Fullname=?,Password=?,Group_ID=?,Photo=? WHERE User_ID=?");
                                                $statement->execute(array($Username,$addr_mail,$Fullname,$password,0,$path_image,$user_id_session)); 
                                                if($statement->rowCount()>0){
                                                        echo "<div class='container alert alert-success mt-5 p-5'><p class='text-center'> Vos informations sont modifier Avec Succès </p></div>";
                                                        GoBack();
                                                } 
                                                else{
                                                        echo "<div class='container alert alert-success mt-5 p-5'><p class='text-center'>Les informations n'ont pas été modifiées</p></div>";
                                                        GoBack();
                                                }
                                        }else{
                                                $statement=$con->prepare("UPDATE users SET Username=?,Email=?,Fullname=?,Password=?,Group_ID=? WHERE User_ID=?");
                                                $statement->execute(array($Username,$addr_mail,$Fullname,$password,0,$user_id_session)); 
                                                if($statement->rowCount()>0){
                                                        echo "<div class='container alert alert-success mt-5 p-5'><p class='text-center'> Vos informations sont modifier Avec Succès </p></div>";
                                                        GoBack();
                                                } 
                                                else{
                                                        echo "<div class='container alert alert-success mt-5 p-5'><p class='text-center'>Les informations n'ont pas été modifiées</p></div>";
                                                        GoBack();
                                                }
                                        }
                                }
                                else{
                                        foreach($errors as $error){
                                                echo "<div class='alert alert-danger p-2'>".$error."</div>";
                                        }
                                }
                   echo "</div>";
               }else{
                    echo "<div class='container alert alert-danger mt-5 p-5 text-center'>Vous n'avez pas le droit D'acceder directement A cette Page</div>";;
               }
?>
<?php
     include $tpl."footer.php";
?>