<?php
            session_start();
            include "init.php";
            include $tpl."header.php";
            include $tpl."navbar.php";
            if(isset($_GET['Annonce_ID']) && !empty($_GET['Annonce_ID'])){
?>
 <!-- view property section starts  -->
            <section class="view-property">
                          <div class="details">
                          <?php 
                                  $Annonce_ID=$_GET['Annonce_ID'];
                                  $statement=$con->prepare("SELECT annonce.Annonce_ID,users.Username,logement.Logement_Type,
                                    annonce.Description,annonce.Prix,annonce.nbr_salle_bain,annonce.immobiler_etat,
                                    annonce.Etage_de_bien,annonce.Age_de_bien,annonce.Phone_number,
                                    annonce.nbr_piece,service.Service_Name,ville.Ville_Name,annonce.Titre,annonce.Adresse,
                                    annonce.Nbr_Chambre,annonce.nbr_salle_bain,
                                    annonce.Surface,annonce.Annonce_Date,region.Region_Name FROM annonce 
                                    INNER JOIN service ON annonce.Service_ID=service.Service_ID 
                                    INNER JOIN logement ON annonce.Logement_ID=logement.Logement_ID 
                                    INNER JOIN users ON annonce.User_ID=users.User_ID 
                                    INNER JOIN ville ON annonce.Ville_ID=ville.Ville_ID
                                    INNER JOIN region ON ville.Region_ID=region.Region_ID
                                    WHERE
                                    annonce.Annonce_ID=?
                                    ");
                                    $statement->execute(array($Annonce_ID));
                                    $row=$statement->fetch();
                                    $statement2 = $con->prepare("SELECT characteristics.characteristic_Name FROM selected_charcteristics 
                                                              INNER JOIN characteristics ON selected_charcteristics.characteristic_ID=characteristics.characteristic_ID 
                                                              WHERE selected_charcteristics.Annonce_ID=?");
                                    $statement2->execute(array($Annonce_ID));
                                    $elements=$statement2->fetchAll();
                                  $statement3 = $con->prepare("SELECT Image_Path FROM logement_images WHERE Annonce_ID=?");
                                  $statement3->execute(array($Annonce_ID));
                                  $images=$statement3->fetchAll();
                          ?>
                          <div class="thumb">
                                      <?php
                                                if($statement3->rowCount()>0){
                                                      echo "<div class='big-image'>";
                                                              echo "<img src='".$images[0]['Image_Path']."' alt=''>";
                                                      echo  "</div>";
                                                      echo "<div class='small-images'>";
                                                      foreach($images as $image){
                                                            echo "<img src='".$image['Image_Path']."' alt=''>";
                                                      }
                                                      echo "</div>";
                                                }else{ ?>
                                                      <div class="big-image">
                                                            <img src="./images/default_images/image1.jpg" alt="">
                                                      </div>
                                              <?php }
                                      ?>
                          </div>
                          <h3 class="name"><?php  echo $row['Titre']; ?></h3>
                          <p class="location"><i class="fas fa-map-marker-alt"></i><span><?php echo $row['Adresse'].",".$row['Ville_Name'].",".$row['Region_Name'] ?></span></p>
                          <div class="info">
                                  <p><i class="fa-solid fa-money-check-dollar"></i><span><?php echo $row['Prix'];?> DH</span></p>
                                  <p><i class="fas fa-user"></i><span><?php echo $row['Username']; ?></span></p>
                                  <p><i class="fas fa-phone"></i><a>+212 <?php echo $row['Phone_number'];?></a></p>
                                  <p><i class="fas fa-building"></i><span><?php echo $row['Logement_Type'];?></span></p>
                                  <p><i class="fas fa-house"></i><span><?php echo $row['Service_Name'];?></span></p>
                                  <p><i class="fas fa-calendar"></i><span><?php echo $row['Annonce_Date'];?></span></p>
                          </div>
                          <h3 class="title">Plus D'information</h3>
                          <div class="flex">
                                  <div class="box">
                                      <p><i>Etat d'immobilier  :</i><span><?php echo $row['immobiler_etat']; ?></span></p>
                                      <p><i>Etage de Bien :</i><span><?php echo $row['Etage_de_bien']; ?></span></p>
                                      <p><i>Age de bien:</i><span><?php echo $row['Age_de_bien']; ?></span></p>
                                      <p><i>Nombre de pièce :</i><span><?php echo $row['nbr_piece']; ?></span></p>
                                  </div>
                                  <div class="box">
                                      <p><i>Surface :</i><span><?php echo $row['Surface'];?> m<sup>2</sup></span></p>
                                      <p><i>Nombre de Chambre  :</i><span><?php echo $row['Nbr_Chambre']; ?></span></p>
                                      <p><i>Nombre Salle de bain :</i><span><?php echo $row['nbr_salle_bain']; ?></span></p>
                                  </div>
                          </div>
                          <h3 class="title">Caractéristique</h3>
                          <div class="flex">
                                    <?php
                                      if($statement2->rowCount()>0){
                                          echo "<div class='box'>";
                                      $reset=0;
                                              foreach($elements as $element){
                                                      if($reset>3){
                                                              echo "<div class='box'>";
                                                              $reset=0;
                                                      }elseif($reset==3)
                                                      {
                                                          echo "</div>";
                                                          $reset++;
                                                      }
                                                      else{
                                                                  echo "<p><i class='fas fa-check'></i><span>".$element['characteristic_Name']."</span></p>";
                                                                  $reset++;
                                                      }

                                              }
                                          }
                                    ?>
                          </div>
                          <h3 class="title">description</h3>
                          <p class="description"><?php echo $row['Description'];?></p>
                          
                  </div>
              </section>
<?php }
  else{
              echo "<div class='container mt-5'>";
                        echo "<div class='alert alert-danger mt-5'>Vous n'avez pas le droit d'accéder  directement  à cette page. </div>";
              echo "</div>";        
  } 
 ?>
<?php
                include $tpl."footer.php";
?>