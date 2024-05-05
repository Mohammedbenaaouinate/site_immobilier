<?php
            session_start();
            include "init.php";
            include $tpl."header.php";
            $action= isset($_GET['action'])?$_GET['action']:"no_action";
            if($action=="Insert"){
                        if(isset($_SESSION['user'])){
                                    if($_SERVER['REQUEST_METHOD']=="POST"){
                                                $User_ID=$_SESSION['user']['User_ID'];
                                                $service = $_POST['service'];
                                                $array_services=array();
                                                $statement =$con->prepare("SELECT Service_ID FROM service");
                                                $statement->execute(array());
                                                $res_service=$statement->fetchAll();
                                                for($i=0;$i<count($res_service);$i++){
                                                    $array_services[$i]=$res_service[$i]["Service_ID"];
                                                }
                                                $type_de_logement = $_POST['logement'];
                                                $array_logement= array();
                                                $statement =$con->prepare("SELECT Logement_ID FROM logement");
                                                $statement->execute(array());
                                                $res_logement=$statement->fetchAll();
                                                for($i=0;$i<count($res_logement);$i++){
                                                    $array_logement[$i]=$res_logement[$i]["Logement_ID"];
                                                }
                                                $etat =$_POST['etat'];
                                                $array_etat=array("Nouveau","BonEtat","Renover");
                                                $adresse = $_POST['adresse'];
                                                $region  = $_POST['region'];
                                                $array_region=array();
                                                $statement = $con->prepare("SELECT Region_ID FROM region");
                                                $statement->execute(array());
                                                $res_region = $statement->fetchAll();
                                                for($i=0;$i<count($res_region);$i++){
                                                        $array_region[$i]=$res_region[$i]['Region_ID'];
                                                }
                                                $ville   = $_POST['ville'];
                                                $array_ville=array();
                                                $statement = $con->prepare("SELECT Ville_ID FROM ville");
                                                $statement->execute(array());
                                                $res_ville=$statement->fetchAll();
                                                for($i=0;$i<count($res_ville);$i++){
                                                        $array_ville[$i]=$res_ville[$i]['Ville_ID'];
                                                }
                                                $surface = $_POST['surface'];
                                                $prix    =$_POST['prix'];
                                                $Age_de_bien =$_POST['Age_de_bien'];
                                                $array_Age_de_bien=array(0,"Moins d'un an","D'un an à 5 ans","De 5 ans à 10 ans","De 10 ans à 20 ans","De 20 ans à 30 ans","De 30 ans à 50 ans","De 50 ans à 70 ans","De 70 ans à 100 ans","Plus de 100 ans");
                                                $etage_de_bien =$_POST['etage_de_bien'];
                                                $array_etage_de_bien=array(0,1,2,3,4,5,6,7,8,9,10,11);
                                                $nombre_de_piece=$_POST['nbr_pieces'];
                                                $nombre_de_chambre =$_POST['nbr_chambre'];
                                                $nbr_salle_bain    =$_POST['salle_bain'];
                                                if(isset($_POST['cara'])){
                                                       $cara_array =$_POST['cara'];
                                                }
                                                $statement = $con->prepare("SELECT max(characteristic_ID) FROM characteristics");
                                                $statement->execute(array());
                                                $rows = $statement->fetchAll();
                                                $max = $rows[0]['max(characteristic_ID)'];
                                                $statement = $con->prepare("SELECT min(characteristic_ID) FROM characteristics");
                                                $statement->execute(array());
                                                $rows = $statement->fetchAll();
                                                $min = $rows[0]['min(characteristic_ID)'];
                                                 /*La troisième Page */
                                                $titre= $_POST['titre'];
                                                $telephone=$_POST['Telephone'];
                                                $description =$_POST['description'];
                                                $number_null_images=0;
                                                for($i=0;$i<count($_FILES['images']['size']);$i++){
                                                            if($_FILES['images']['size'][$i]==0){
                                                                $number_null_images++;
                                                            }
                                                }
                                                if(!(in_array($service,$array_services))){
                                                          $errors[]="La valeur que Vous avez Saisie dans le champs service est Inccorect";
                                                }
                                                if(!(in_array($type_de_logement,$array_logement))){
                                                    $errors[]="La valeur que Vous avez Saisie dans le champs type de bien est Inccorect";
                                                }
                                                if(!(in_array($etat,$array_etat))){
                                                    $errors[]="La valeur que Vous avez Saisie dans le champs Etat de bien est Inccorect";
                                                }
                                                if(strlen($adresse)>80){
                                                    $errors[]="la taille de l'adresse ne peut pas dépasser 80 caractères";
                                                }
                                                if(!(in_array($region,$array_region))){
                                                    $errors[]="La valeur que Vous avez Saisie dans le champs Région est Inccorect";
                                                }
                                                if(!(in_array($ville,$array_ville))){
                                                    $errors[]="La valeur que Vous avez Saisie dans le champs Ville est Inccorect";
                                                }
                                                if(!(is_numeric($surface))|| $surface<0){
                                                    $errors[]="La valeur que Vous avez Saisie dans le Surface prix est Inccorect";
                                                }
                                                if(!(is_numeric($prix))|| $prix<0){
                                                        $errors[]="La valeur que Vous avez Saisie dans le champs prix est Inccorect";
                                                }
                                                if(!(in_array($Age_de_bien,$array_Age_de_bien))){
                                                    $errors[]="La valeur que Vous avez Saisie dans le champs Age de bien est Inccorect";
                                                }
                                                if(!(in_array($etage_de_bien,$array_etage_de_bien))){
                                                    $errors[]="La valeur que Vous avez Saisie dans le champs Etage de bien est Inccorect";
                                                }
                                                if(!(is_numeric($nombre_de_piece))||$nombre_de_piece<1){
                                                    $errors[]="La valeur que Vous avez Saisie dans le nombre de pièce  est Inccorect";
                                                }
                                                if(!(is_numeric($nombre_de_piece))||$nombre_de_piece<1){
                                                    $errors[]="La valeur que Vous avez Saisie dans le nombre de pièce  est Inccorect";
                                                }
                                                if(!(is_numeric($nombre_de_chambre))||$nombre_de_chambre<1){
                                                    $errors[]="La valeur que Vous avez Saisie dans le nombre de chambre  est Inccorect";
                                                }
                                                if(!(is_numeric($nbr_salle_bain ))||$nbr_salle_bain<1){
                                                    $errors[]="La valeur que Vous avez Saisie dans le nombre de chambre  est Inccorect";
                                                }
                                                if(isset($_POST['cara'])){
                                                        foreach($cara_array as $ID){
                                                            if(!($ID>=$min  && $ID<=$max)){
                                                                $errors[]="L'un ou Plusieurs valeurs que Vous avez Saisie dans les champs de caractéristiques sont Inccorect";
                                                                break;
                                                            }
                                                        }
                                               }
                                                if(strlen($titre)>50){
                                                        $errors[]="Le champs Titre ne peut pas dépasser 50 caractère au maximaum";
                                                }
                                                if(strlen((string)$telephone)>10 || strlen((string)$telephone)<9){
                                                        $errors[]="Le Numéro de Téléphone que Vous Avez Saisie est Incorrecte";
                                                }
                                                if(strlen($description)>=5000){
                                                    $errors[]="Le champs Description ne peut pas dépasser 5000 caractère au maximaum";
                                                }
                                                if($number_null_images==count($_FILES['images']['size'])){
                                                    $errors[]="Vous devez choisir au moins une image";       
                                                }
                                                $upload_file="./images/annonce_images/";
                                                for($i=0;$i<count($_FILES['images']['size']);$i++){
                                                                if($_FILES['images']['size'][$i]!=0){
                                                                    $path=$upload_file.rand(1,10000000).$_FILES['images']['name'][$i];
                                                                    move_uploaded_file($_FILES["images"]["tmp_name"][$i],$path);
                                                                    echo "This the path that you chould Insert In Database<br><br>";
                                                                    echo "$path<br><br>";
                                                                }
                                                }
                                                if(empty($errors)){
                                                                        // echo "<div class='alert alert-success'>Now We can Insert In Data Base</div>";
                                                                        // $statement =$con->prepare("INSERT INTO 
                                                                        // annonce(User_ID,Service_ID,Logement_ID,immobiler_etat,Adresse,
                                                                        // Ville_ID,Surface,Prix,Age_de_bien,Etage_de_bien,
                                                                        // Nbr_Chambre,nbr_piece,nbr_salle_bain,Titre,Phone_number,Description)
                                                                        //                             VALUES
                                                                        // (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                                        // $statement->execute(array($User_ID,$service,$type_de_logement,$etat,$adresse,$ville,
                                                                        // $surface,$prix,$Age_de_bien,$etage_de_bien,$nombre_de_chambre,$nombre_de_piece,$nbr_salle_bain,
                                                                        // $titre,$telephone,$description));
                                                                        // if($statement->rowCount()>0){
                                                                                
                                                                        //     echo "<div class='alert alert-success'>Votre information est Inséré dans la base de données</div>";
                                                                        // }
                                                                        // else{
                                                                        //      echo "<div class='alert aler-danger'>Une erreur est servenue lors de L'insertion de Votre dans la base de données</div>";
                                                                        // }
                                                                        $statement = $con->prepare("SELECT Annonce_ID FROM annonce ORDER BY Annonce_ID DESC LIMIT 1");
                                                                        $statement->execute(array());
                                                                        $row =$statement->fetch();
                                                                        echo "<pre>";
                                                                        print_r($row);
                                                                        echo  "</pre>";
                                                }
                                                else{
                                                    echo "<div class='alert alert-danger'>You Can't Insert In DataBase because you chenged And you try ti hack me</div>";
                                                    foreach($errors as $error){
                                                        echo  "<div class='alert alert-danger'>".$error."</div>";
                                                    }
                                                }
                                                echo "<pre>";
                                                            print_r( $_SESSION['user']['User_ID']);
                                                echo "</pre>";
                                                

                                    }
                                    else{
                                        echo "<div class='alert alert-danger'>Vous N'avez pas le droit de l'accès direct a cette page </div>";
                                    }
                        }
                        else{
                            echo "<div class='alert alert-danger'>Vous devez authentifier avant de publier une annonce. </div>"; 
                        }
            }else{
                echo "<div class='alert alert-danger'>Vous N'avez pas le droit de l'accès direct a cette page </div>";
            }
?>
<?php
       include $tpl."footer.php";
?>