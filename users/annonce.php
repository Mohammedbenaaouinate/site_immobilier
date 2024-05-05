<?php 
  session_start();
  $navbar="";
  include "init.php";
  include $tpl."header.php";
  include $tpl."navbar.php";
?>
<!-- Start Add Annonce Section -->
<section class="Add_Annonce container mt-5 mb-5">
                <div class="Progress_bar  mt-5">
                        <div class="P_container">
                                                <div class="steps">
                                                        <span class="circle active">1</span>
                                                        <span class="circle">2</span>
                                                        <span class="circle">3</span>
                                                        <div class="progress-bar">
                                                        <span class="indicator"></span>
                                                        </div>
                                                </div>
                        </div>
                </div>
     <form action="addannonce.php?action=Insert" method="post" enctype="multipart/form-data">
            <fieldset class="mb-5 mt-5">
                <div class="row mt-5">      <div class="information_generale mb-5">
                                                        <h5>Information générale</h5>
                                                        <hr>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 overflow-hidden mb-4">
                                                        <div class="header_container">
                                                                <label class="title title_label">
                                                                    Service <i class="text-danger">*</i>
                                                                </label>
                                                                <div class="ligne_decoration"></div>
                                                        </div>
                                                        <p class="errors" id="error_service">champs requis</p>
                                                        <div class="checkboxList">
                                                            <?php
                                                                        $statement = $con->prepare("SELECT * FROM service");
                                                                        $statement ->execute(array());
                                                                        $rows= $statement->fetchAll();
                                                                        foreach($rows as $row){
                                                                            echo "<div class='p-2'>";
                                                                            echo "<input type='radio' name='service' class='' value='".$row['Service_ID']."'>";
                                                                            echo "<label>&nbsp &nbsp".$row['Service_Name']."</label>";
                                                                            echo "</div>";
                                                                        }
                                                            ?>  
                                                        </div>
                                              </div>   
                                              <div class="col-lg-5 offset-lg-1 col-md-9 col-sm-12 mb-4">
                                                            <div class="header_container">
                                                                                <div class="ligne_decoration me-3 ms-0"></div>
                                                                                <label class="title title_label">
                                                                                    Type de bien<i class="text-danger">*</i>
                                                                                </label>
                                                                                <div class="ligne_decoration"></div>
                                                             </div>
                                                             <p class="errors" id="error_type_de_bien">champs requis</p>
                                                            <div class="checkboxList_two w-100 d-flex align-items-center justify-content-center">
                                                                            <?php
                                                                            $statement =$con -> prepare("SELECT * FROM logement");
                                                                            $statement ->execute(array());
                                                                            $rows = $statement->fetchAll();
                                                                            echo "<div class='w-50'>";
                                                                            for($i=0;$i<=2;$i++){
                                                                                echo "<div class='p-2 d-flex mb-2 '>";
                                                                                        echo "<input type='radio' name='logement' class='' value='".$rows[$i]['Logement_ID']."'>";
                                                                                        echo "<label>&nbsp &nbsp".$rows[$i]['Logement_Type']."</label>";
                                                                                echo "</div>";
                                                                            }
                                                                            echo "</div>";
                                                                            echo "<div class='w-50'>";
                                                                                        for($i=3;$i<=5;$i++){
                                                                                            echo "<div class='p-2 d-flex mb-2'>";
                                                                                                    echo "<input type='radio' name='logement' class='' value='".$rows[$i]['Logement_ID']."'>";
                                                                                                    echo "<label>&nbsp &nbsp".$rows[$i]['Logement_Type']."</label>";
                                                                                            echo "</div>";
                                                                                        }
                                                                            echo "</div>";
                                                                            ?>
                                                            </div>
                                              </div>
                                              <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-12 overflow-hidden mb-4">
                                                        <div class="header_container">
                                                                <label class="title title_label">
                                                                    Etat <i class="text-danger">*</i>
                                                                </label>
                                                                <div class="ligne_decoration"></div>
                                                        </div>
                                                        <p class="errors" id="etat_error">champs requis</p>
                                                        <div class="checkboxList">
                                                                <div class='p-2'>
                                                                                <input type='radio' name='etat' class='' value="Nouveau">
                                                                                <label>&nbsp &nbsp Nouveau</label>
                                                                </div>
                                                                <div class='p-2'>
                                                                                <input type='radio' name='etat' class='' value="BonEtat">
                                                                                <label>&nbsp &nbsp BonEtat</label>
                                                                </div>
                                                                <div class='p-2'>
                                                                                <input type='radio' name='etat' class='' value="Renover">
                                                                                <label>&nbsp &nbsp A rénover</label>
                                                                </div>
                                                        </div>
                                              </div>
                    </div>
                    <div class="row">
                                        <div class="emplacement">
                                                <h5>Emplacement</h5>
                                                <hr>
                                        </div>
                                                <div class="col-lg-5 col-md-6 col-sm-12 mt-4">
                                                                <div class="mb-3">
                                                                        <label for="Inputaddresse" class="form-label">addresse</label>
                                                                        <input type="text" class="form-control" id="Inputadresse" name="adresse">
                                                                </div>
                                                                <div class="region mt-3">
                                                                        <label for="Region">Region  <span class="text-danger">*</span> </label>
                                                                        <p class="errors" id="region_error">champs requis</p>
                                                                        <?php
                                                                                $statement=$con->prepare("SELECT * FROM region");
                                                                                $statement->execute(array());
                                                                                $rows=$statement->fetchAll();
                                                                                echo "<select name='region' id='region' class='form-select'>";
                                                                                echo  "<option value='0'>Séléctionnez</option>";
                                                                                foreach($rows as $row){
                                                                                        echo "<option value='".$row['Region_ID']."'>".$row['Region_Name']."</option>";
                                                                                }
                                                                                echo "</select>";
                                                                        ?>
                                                                </div>
                                                                <div class="ville mt-3">
                                                                                <label for="ville">Ville <span class="text-danger">*</span></label>
                                                                                <p class="errors" id="ville_error">champs requis</p>
                                                                                <?php
                                                                                        $statement =$con->prepare("SELECT * FROM ville");
                                                                                        $statement->execute(array());
                                                                                        $rows=$statement->fetchAll();
                                                                                        echo "<select name='ville' id='ville' class='form-select'>";
                                                                                        echo "<option value='0'>Séléctionnez</option>";
                                                                                                foreach($rows as $row){
                                                                                                        echo "<option value='".$row['Ville_ID']."'>".$row['Ville_Name']."</option>";
                                                                                                }
                                                                                        echo "</select>";
                                                                                ?>
                                                                </div> 
                                                </div>  
                                                <div class="col-lg-6 offset-lg-1 o col-md-6 col-sm-12 border border-primary mt-4">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d42689082.98918115!2d8.058375540058867!3d24.383957225765055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b88619651c58d%3A0xd9d39381c42cffc3!2sMaroc!5e0!3m2!1sfr!2sma!4v1711365020319!5m2!1sfr!2sma" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                </div>         
                        </div>
          </fieldset>
          <fieldset class="d_filedset mb-5 mt-5">
                        <div class="row row-cols-lg-auto g-3 align-items-center justify-content-center">
                                <div class="col-12">
                                                <label>Surface: <span class="text-danger">*</span></label>
                                                <p class="errors" id="surface_error">champs requis</p>
                                                <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Surface" name="surface" min="1">
                                                        <div class="input-group-text position-relative">m<span class="position-absolute carre">2</span></div>
                                                </div>
                                </div>
                                <div class="col-12 ms-lg-3">
                                                <label>Prix: <span class="text-danger">*</span></label>
                                                <p class="errors" id="prix_error">champs requis</p>
                                                <div class="input-group">
                                                        <input type="number" class="form-control" placeholder="Prix" name="prix">
                                                        <div class="input-group-text">DH</div>
                                                </div>
                                </div>
                                <div class="col-12 col-lg-3 ms-lg-3">
                                                <label>Age de bien</label>
                                                <select class="form-select" name="Age_de_bien">
                                                                <option  value ="0" selected>Séléctionnez</option>
                                                                <option value="Moins d'un an">Moins d'un an</option>
                                                                <option value="D'un an à 5 ans">D'un an à 5 ans</option>
                                                                <option value="De 5 ans à 10 ans">De 5 ans à 10 ans</option>
                                                                <option value="De 10 ans à 20 ans">De 10 ans à 20 ans</option>
                                                                <option value="De 20 ans à 30 ans">De 20 ans à 30 ans</option>
                                                                <option value="De 30 ans à 50 ans">De 30 ans à 50 ans</option>
                                                                <option value="De 50 ans à 70 ans">De 50 ans à 70 ans</option>
                                                                <option value="De 70 ans à 100 ans">De 70 ans à 100 ans</option>
                                                                <option value="Plus de 100 ans">Plus de 100 ans</option>
                                                </select>
                                </div>
                                <div class="col-12 col-lg-2 ms-lg-3">
                                                <label>Etage de bien</label>
                                                <select class="form-select" name="etage_de_bien">
                                                                <option  value ="0" selected>Séléctionnez</option>
                                                                <option value="1">0</option>
                                                                <option value="2">1</option>
                                                                <option value="3">2</option>
                                                                <option value="4">3</option>
                                                                <option value="5">4</option>
                                                                <option value="6">5</option>
                                                                <option value="7">6</option>
                                                                <option value="8">7</option>
                                                                <option value="9">8</option>
                                                                <option value="10">9</option>
                                                                <option value="11">10</option>
                                                </select>
                                </div>
                        </div>
                        <div class="row mt-5">
                                        <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-12">
                                                                <label class="mb-3">Nombre de pièces &nbsp<span class="text-danger">*</span></label>
                                                                <div class="input_pieces">
                                                                        <div class="me-2"><span class="numdecoration minus" style="padding-left: 8px;">-</span></div>
                                                                        <div>
                                                                                <input type="number" name="nbr_pieces" class="valeur" min="1" max="100" value="1" readonly>
                                                                        </div>
                                                                        <div class="ms-2"><span class="numdecoration plus">+</span></div>
                                                                </div>
                                                        
                                        </div>
                                        <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-12">
                                                                <label class="mb-3">Chambre &nbsp<span class="text-danger">*</span></label>
                                                                <div class="input_pieces">
                                                                        <div class="me-2"><span class="numdecoration minus" style="padding-left: 8px;">-</span></div>
                                                                        <div>
                                                                                <input type="number" name="nbr_chambre" class="valeur" min="1" max="100" value="1" readonly>
                                                                        </div>
                                                                        <div class="ms-2"><span class="numdecoration plus">+</span></div>
                                                                </div>
                                                        
                                        </div>
                                        <div class="col-lg-3 offset-lg-1  col-md-6 col-sm-12">
                                                                <label class="mb-3">Salle de bain &nbsp<span class="text-danger">*</span></label>
                                                                <div class="input_pieces">
                                                                        <div class="me-2"><span class="numdecoration minus" style="padding-left: 8px;">-</span></div>
                                                                        <div>
                                                                                <input type="number" name="salle_bain" class="valeur" min="1" max="100" value="1" readonly>
                                                                        </div>
                                                                        <div class="ms-2"><span class="numdecoration plus">+</span></div>
                                                                </div>
                                                        
                                        </div>
                        </div>
                        <div class="row mt-5">
                                        <div class="fonctionnalite">
                                                        <h5>Fonctionnalité</h5>
                                                        <hr>
                                        </div>
                                        <h5 class="mb-5 mt-3">Caractéristique Générale </h5>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="jardin_container container_element">
                                                                <a class="jardinlink">  
                                                                        <img src="./images/icons/jarden.png">                                            
                                                                </a>
                                                                <p class="text-center">Jardin</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="1">
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mb-3 mt-3">
                                                <div class="terasse_container container_element">
                                                                <a class="terasselink">  
                                                                        <img src="./images/icons/terrasse.PNG">  
                                                                </a>
                                                                <p class="text-center">Terrasse</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="2">
                                                        
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3">
                                                <div class="garage_container container_element mt-3">
                                                                <a class="garagelink">  
                                                                                <img src="./images/icons/Garage.png">
                                                                </a>
                                                                <p class="text-center">Garage</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="3">
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="ascenseur_container container_element">
                                                                <a class="ascensseurlink">  
                                                                                <img src="./images/icons/ascensseur.png">
                                                                </a>
                                                                <p class="text-center">Ascensseur</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="4">
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="vuemer_container container_element">
                                                                <a class="tvuemerlink">  
                                                                                <img src="./images/icons/vue_de_mer.png">
                                                                </a>
                                                                <p class="text-center"> Vue sur mer</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="5">
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="vuemontage_container container_element">
                                                                <a class="vuemontagelink">  
                                                                        <img src="./images/icons/vue_montagne.png">
                                                                </a>
                                                                <p class="text-center">Vue sur les montagnes</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="6">
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="piscine_container container_element">
                                                                <a class="piscinelink">  
                                                                        <img src="./images/icons/piscine.png">
                                                                </a>
                                                                <p class="text-center">Piscine</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="7">

                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="concierge_container container_element">
                                                                <a class="conciergelink">  
                                                                        <img src="./images/icons/concierge.png">
                                                                </a>
                                                                <p class="text-center">Concierge</p>
                                                                <input type="checkbox" name="cara[]"  class="disable_input" value="8">

                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="crangement_container container_element">
                                                                <a class="crangementlink">  
                                                                        <img src="./images/icons/chambre_de_rangement.png">
                                                                </a>
                                                                <p class="text-center">Chambre de rengement</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="9">
                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="Meuble_container container_element">
                                                                <a class="Meublelink">  
                                                                                <img src="./images/icons/meuble.png">
                                                                </a>
                                                                <p class="text-center">Meublé</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="10">

                                                </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                <div class="façade_container container_element">
                                                                <a class="façadelink">  
                                                                        <img src="./images/icons/façade_exetrieur.png">
                                                                </a>
                                                                <p class="text-center">Façade Exetérieur</p>
                                                                <input type="checkbox" name="cara[]" class="disable_input" value="11">
                                                </div>
                                        </div>
                        </div>
                        <div class="row">
                                        <h5 class="mb-5 mt-3">Intérieur</h5>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="salon_marocain container_element">
                                                                        <a class="salon_marocain">  
                                                                                <img src="./images/icons/salon_marocain.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Salon Marocain</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="12">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="salon_europien container_element">
                                                                        <a class="salon_europien">  
                                                                                <img src="./images/icons/salon_europien.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Salon europien </p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="13">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="antenne_parapolique container_element">
                                                                        <a class="antenne_parapolique">  
                                                                                <img src="./images/icons/Antenne.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Antenne parabolique</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="14">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="cheminee container_element">
                                                                        <a class="cheminee">  
                                                                                <img src="./images/icons/cheminé.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Cheminée</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="15">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="climatisation container_element">
                                                                        <a class="climatisation">  
                                                                                <img src="./images/icons/climatisation.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Climatisation</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="16">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="chauffage_centrale container_element">
                                                                        <a class="chauffage_centrale">  
                                                                                <img src="./images/icons/cheffage_central.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Chauffage central</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="17">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="Securité container_element">
                                                                        <a class="Securité">  
                                                                                <img src="./images/icons/securité.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Securité</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="18">
                                                        </div>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                        <div class="Porte_blindé container_element">
                                                                        <a class="Porte_blindé">  
                                                                                <img src="./images/icons/porte_blindé.png">                                            
                                                                        </a>
                                                                        <p class="text-center">Porte Blindé</p>
                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="19">
                                                        </div>
                                        </div>

                        </div>
                        <div class="row">
                                                <h5 class="mb-5 mt-3">Options supplémentaires</h5>
                                                <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                                        <div class="Cuisine container_element">
                                                                                        <a class="Cuisine ">  
                                                                                                <img src="./images/icons/cuisine_equipé.png">                                            
                                                                                        </a>
                                                                                        <p class="text-center">Cuisine équipée</p>
                                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="20">
                                                                        </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                                        <div class="Refrigerateur container_element">
                                                                                        <a class="Refrigerateur">  
                                                                                                <img src="./images/icons/refrégerateur.png">                                            
                                                                                        </a>
                                                                                        <p class="text-center">Réfrigérateur</p>
                                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="21">
                                                                        </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                                        <div class="Four container_element">
                                                                                        <a class="Four">  
                                                                                                <img src="./images/icons/four.png">                                            
                                                                                        </a>
                                                                                        <p class="text-center">Four</p>
                                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="22">
                                                                        </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                                        <div class="Machine container_element">
                                                                                        <a class="Machine">  
                                                                                                <img src="./images/icons/machine_a_laver.png">                                            
                                                                                        </a>
                                                                                        <p class="text-center">Machine à laver</p>
                                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="23">
                                                                        </div>
                                                </div>
                                                <div class="col-lg-2 col-md-3 col-sm-6  mb-3 mt-3">
                                                                        <div class="micro_onde container_element">
                                                                                        <a class="micro_ondes">  
                                                                                                <img src="./images/icons/micro_ondes.png">                                            
                                                                                        </a>
                                                                                        <p class="text-center">Micro-ondes</p>
                                                                                        <input type="checkbox" name="cara[]" class="disable_input" value="24">
                                                                        </div>
                                                </div>
                        </div>
          </fieldset>
          <fieldset class="mb-5 mt-5">
                <div class="mb-5">
                                <div class="d-flex justufy-content-between align-items-center">
                                                        <p class="fw-bold">Télécharger des photos <span class="text-danger">*</span><span class="spanstyle" style="font-size: 10px; font-weight:normal;">&nbsp;&nbsp;&nbsp;Sélectionnez jusqu'à cinq images maximum</span></p>
                                </div>
                                <div class="card upload_section">
                                        <div class="card-body row">
                                                <div class="offset-lg-1 col-lg-2 col-md-4 col-sm-6 mt-2 mb-2">
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div id="first_image" class="upload_image add_container">
                                                                                <span onclick="document.getElementById('imageOne').click()">
                                                                                        <i class="fa-solid fa-plus"></i>
                                                                                </span>
                                                                                <span>Ajouter</span>
                                                                                <input type="file" name="images[]" id="imageOne" class="d-none images_input" accept="image/*">
                                                                        </div>
                                                                </div>
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="img_container text-center" id="img_first">
                                                                                        <span id="first_icon" class="x_mark"><i class="fa-solid fa-xmark"></i></span>
                                                                        </div>
                                                                </div>
                                                               
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-sm-6 mt-2 mb-2">
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="upload_image add_container" id="second_image">
                                                                                        <span onclick="document.getElementById('imageTwo').click()">
                                                                                                <i class="fa-solid fa-plus"></i>
                                                                                        </span>
                                                                                        <span>Ajouter</span>  
                                                                                        <input type="file" name="images[]"  id="imageTwo" class="d-none images_input" accept="image/*"> 
                                                                        </div>
                                                                </div>
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="img_container text-center" id="img_second">
                                                                                        <span id="second_icon" class="x_mark"><i class="fa-solid fa-xmark"></i></span>
                                                                        </div>
                                                                </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-sm-6 mt-2 mb-2">
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="upload_image add_container" id="third_image">
                                                                                        <span onclick="document.getElementById('imageThree').click()">
                                                                                                <i class="fa-solid fa-plus"></i>
                                                                                        </span>
                                                                                        <span>Ajouter</span>
                                                                                        <input type="file" name="images[]" id="imageThree" class="d-none images_input" accept="image/*">  
                                                                        </div>
                                                                </div>
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="img_container text-center" id="img_third">
                                                                                        <span id="third_icon" class="x_mark"><i class="fa-solid fa-xmark"></i></span>
                                                                        </div>
                                                                </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-sm-6 mt-2 mb-2">
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="upload_image add_container" id="fourthly_image">
                                                                                <span onclick="document.getElementById('imageFour').click()">
                                                                                        <i class="fa-solid fa-plus"></i>
                                                                                </span>
                                                                                <span>Ajouter</span> 
                                                                                <input type="file" name="images[]"  id="imageFour" class="d-none images_input" accept="image/*">  
                                                                        </div>
                                                                </div>
                                                                <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="img_container text-center" id="img_fourth">
                                                                                        <span id="fourth_icon" class="x_mark"><i class="fa-solid fa-xmark"></i></span>
                                                                        </div>
                                                                </div>
                                                </div>
                                                <div class="col-lg-2 col-md-4 col-sm-6 mt-2 mb-2">
                                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                                                <div class="upload_image add_container" id="last_image">
                                                                        <span onclick="document.getElementById('imageFive').click()">
                                                                                <i class="fa-solid fa-plus"></i>
                                                                        </span>
                                                                        <span>Ajouter</span> 
                                                                        <input type="file" name="images[]" id="imageFive" class="d-none images_input" accept="image/*">
                                                                </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center flex-column">
                                                                        <div class="img_container text-center" id="img_last">
                                                                                        <span id="last_icon" class="x_mark"><i class="fa-solid fa-xmark"></i></span>
                                                                        </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>                    
                </div>
                <div class="row">
                                <div class="publication_information">
                                                <h5>Information de la publication </h5>
                                                <hr>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                                <div class="mb-3">
                                                        <label for="Titre" class="form-label">Titre <span class="text-danger">*</span><span class="spanstyle" style="font-size: 10px; font-weight:normal;">&nbsp;&nbsp;&nbsp;50 caractères max</span></label>
                                                        <p class="errors" id="titre_error">champs requis</p>
                                                        <input type="text" class="form-control" id="Titre" name="titre">
                                                </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                                <label for="Telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                                <p class="errors" id="telephone_error">champs requis</p>
                                                <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">+212</span>
                                                                <input type="number" class="form-control" placeholder="Numéro" aria-label="numero_telephone" aria-describedby="basic-addon1" id="Telephone" name="Telephone">
                                                </div>
                                </div>
                                <div class="col-12">
                                                <div class="mb-3">
                                                                <label for="description" class="form-label">Description <span class="text-danger">*</span><span class="spanstyle" style="font-size: 10px; font-weight:normal;">&nbsp;&nbsp;&nbsp;5000 caractères max</span></label>
                                                                <p class="errors" id="description_error">champs requis</p>
                                                                <textarea class="form-control" name="description" id="description" style="height: 150px;"></textarea>
                                                </div>
                                </div>
                </div>
          </fieldset>
          <div class="buttons mb-5 mt-5 row">
                                        <input id="prev" disabled class="button col-lg-3  col-md-4 col-sm-12 mt-2" value="Prev" readonly>
                                        <input id="next" class="button col-lg-3 offset-lg-3 col-md-4 col-sm-12 mt-2" value="next" readonly>
                                        <input type="submit" value="submit" class="button col-lg-5 col-md-5 col-sm-12 mt-3" id="submit">
                </div>  
        </form>
        
</section>
<!-- End Add Annonce Section -->
<?php
      include $tpl."footer.php";
?>
 
                            
                                   