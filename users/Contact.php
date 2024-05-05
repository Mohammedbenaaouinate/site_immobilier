<?php
        session_start();
        include "init.php";
        include $tpl."header.php";
        include $tpl."navbar.php";
?>
<!-- contact section starts  -->
<section class="contact mt-5">
   <div class="part">
      <div class="image">
         <img src="./images/signup_image.jpg" alt="">
      </div>
      <form action="" method="post">
         <h3>get in touch</h3>
         <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="box">
         <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
         <input type="number" name="number" required maxlength="10" max="9999999999" min="0" placeholder="enter your number" class="box">
         <textarea name="message" placeholder="enter your message" required maxlength="1000" cols="30" rows="10" class="box"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>
   </div>
</section>
<!-- contact section ends -->
<?php
        include $tpl."footer.php";
?>