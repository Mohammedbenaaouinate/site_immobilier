// Add Border in input Field on Mouse Enter And Mouse leave And on click
const elements = document.getElementsByClassName("input-field");
if (elements != null) {
  for (let i = 0; i < elements.length; i++) {
    elements[i].addEventListener("mouseover", function () {
      this.style.border = "2px solid blue";
    });
    elements[i].addEventListener("mouseout", function () {
      this.style.border = "2px solid black";
    });
    elements[i].addEventListener("click", function () {
      this.style.border = "2px dashed blue";
    });
  }
}

// Page Sign In Modification
const sign_in_error = document.getElementById("sign-in-error");
if (sign_in_error != null) {
  sign_in_error.addEventListener("click", function () {
    document.getElementsByClassName("signin-filed-error")[0].remove();
  });
}

// Verification The Input With JavaScript
let button = document.getElementById("button-submit");
if (button != null) {
  button.addEventListener("click", function (event) {
    let inputs_value = document.getElementsByClassName("input-sign-up");
    let compteur = 0;
    let username = document.getElementById("user_error");
    username.innerHTML = "";
    let password = document.getElementById("password_error");
    password.innerHTML = "";
    let cpassword = document.getElementById("cpassword_error");
    cpassword.innerHTML = "";
    let email = document.getElementById("email_error");
    email.innerHTML = "";
    let fullname = document.getElementById("fullname_error");
    fullname.innerHTML = "";
    if (inputs_value[0].value.length < 5) {
      let textnode = document.createTextNode(
        "*The length of caraters of Username should be More Than 5 caracters"
      );
      let paragraph = document.createElement("p");
      paragraph.style.color = "red";
      paragraph.style.fontSize = "12px";
      paragraph.appendChild(textnode);
      username.appendChild(paragraph);
      compteur++;
    }

    if (inputs_value[1].value.length < 6) {
      let textnode = document.createTextNode(
        "*The length of caraters of motpasse should be More Than 6 caracters"
      );
      let paragraph = document.createElement("p");
      paragraph.style.color = "red";
      paragraph.style.fontSize = "12px";
      paragraph.appendChild(textnode);
      password.appendChild(paragraph);
      compteur++;
    }
    if (inputs_value[1].value !== inputs_value[2].value) {
      let textnode = document.createTextNode(
        "*The Password And password Confirmation should be identical"
      );
      let paragraph = document.createElement("p");
      paragraph.style.color = "red";
      paragraph.style.fontSize = "12px";
      paragraph.appendChild(textnode);
      cpassword.appendChild(paragraph);
      compteur++;
    }
    if (inputs_value[3].value.length <= 20) {
      let textnode = document.createTextNode(
        "*The Length of Email should be more Than 10 caracteres"
      );
      let paragraph = document.createElement("p");
      paragraph.style.color = "red";
      paragraph.style.fontSize = "12px";
      paragraph.appendChild(textnode);
      email.appendChild(paragraph);
      compteur++;
    }
    if (inputs_value[4].value.length <= 10) {
      let textnode = document.createTextNode(
        "*The Length of Fullname should be more Than 10 caracteres"
      );
      let paragraph = document.createElement("p");
      paragraph.style.color = "red";
      paragraph.style.fontSize = "12px";
      paragraph.appendChild(textnode);
      fullname.appendChild(paragraph);
      compteur++;
    }
    if (compteur != 0) {
      event.preventDefault();
    }
  });
}
// Botton Click pop-up
let btn_success = document.getElementById("btn-continue");
if (btn_success != null) {
  btn_success.addEventListener("click", function () {
    window.location.replace("index.php");
  });
}
//choisir le nombre de chambre et le nombre salle de bins et le nombre de pièce dans la deuxieme filedset :FieldSet_Two
let minus = document.getElementsByClassName("minus");
let input_value = document.getElementsByClassName("valeur");
let plus = document.getElementsByClassName("plus");
let numbers = [];
for (let i = 0; i < input_value.length; i++) {
  numbers[i] = 1;
}
for (let i = 0; i < input_value.length; i++) {
  if (minus[i] != null) {
    minus[i].addEventListener("click", function () {
      if (numbers[i] > 1) {
        numbers[i]--;
        input_value[i].value = numbers[i];
        input_value[i].setAttribute("value", input_value[i].value);
      }
    });
  }
  if (plus[i] != null) {
    plus[i].addEventListener("click", function () {
      if (numbers[i] < 100) {
        numbers[i]++;
        input_value[i].value = numbers[i];
        input_value[i].setAttribute("value", input_value[i].value);
      }
    });
  }
}
//SELECT LES FONCTIONNALITE DU ANNONCE
let containers = document.getElementsByClassName("container_element");
for (let i = 0; i < containers.length; i++) {
  containers[i].children[0].addEventListener("click", function () {
    if(!(containers[i].children[2].hasAttribute("checked"))){
            containers[i].children[0].classList.add("linkdecoration");
            containers[i].children[1].classList.add("paradecoration");
            containers[i].children[2].setAttribute("checked","");
    }
    else{
          containers[i].children[0].classList.remove("linkdecoration");
          containers[i].children[1].classList.remove("paradecoration");
          containers[i].children[2].removeAttribute("checked");
    }
  });
}
// start voir et modifier les images de l'annonce avant télécharger 
let inputs = document.getElementsByClassName("images_input");
let add_container= document.getElementsByClassName("add_container");
let img_container = document.getElementsByClassName("img_container");
for(let i=0;i<inputs.length;i++){
            inputs[i].addEventListener("change",function(e){
                    const file = e.target.files[0];
                    if (!file) {
                      return;
                    }
            
                    if (!file.type.match("image.*")) {
                      alert("Veuillez sélectionner un fichier image !");
                      return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (e) {
                                const imageUrl = e.target.result;
                                const parent =img_container[i];
                                parent.style.display = "block";
                                if (parent.lastChild.tagName === "IMG") {
                                  parent.removeChild(parent.lastChild);
                                }
                               const imageElement = document.createElement("img");
                               imageElement.src = imageUrl;
                               parent.appendChild(imageElement);
                               add_container[i].style.display = "none";
                     };
                    reader.readAsDataURL(file);

            });
}
let x_marks=document.getElementsByClassName("x_mark");
for(let i=0;i<x_marks.length;i++){
            x_marks[i].addEventListener("click",function(){
                    add_container[i].style.display="flex";
                    add_container[i].children[2].value="";
                    img_container[i].style.display="none";            
                  });
}
// End voir et modifier les images de l'annonce avant télécharger
// Start progress bar et Check is the field is not empty
const Filed_set =document.querySelectorAll("form fieldset");
const circles = document.querySelectorAll(".circle"),
progressBar = document.querySelector(".indicator"),
buttons = document.querySelectorAll(".button");
let currentStep = 1;
if(currentStep==1){
      for (let i = 1; i < Filed_set.length; i++) {
             Filed_set[i].style.display='none';
      }
}
const updateSteps = (e) => {
      if(currentStep==1){
                let services=document.querySelectorAll("input[name='service']");
                let type_de_bien=document.querySelectorAll("input[name='logement']");
                let etats=document.querySelectorAll("input[name='etat']");
                let region= document.getElementById("region");
                let Ville =document.getElementById("ville");
                let first_errors=0;
                let selected_service=0;
                let selected_type=0;
                let selected_etat=0;
                if(region.value==0){
                        first_errors++;
                        document.getElementById("region_error").style.display="block";
                }
                else{
                        document.getElementById("region_error").style.display="none";
                }
                if(Ville.value==0){
                        first_errors++;
                        document.getElementById("ville_error").style.display="block";
                }
                else{
                        document.getElementById("ville_error").style.display="none";
                }
                function check_selected(inputs){
                        for(const input of inputs){
                                if(input.checked==true){
                                  return 0;
                                }
                        }
                        return 1;
                }
                selected_service = check_selected(services);
                selected_type=check_selected(type_de_bien);
                selected_etat =check_selected(etats);
                selected_service==1 ?document.getElementById("error_service").style.display="block":document.getElementById("error_service").style.display="none";
                selected_type==1 ? document.getElementById("error_type_de_bien").style.display="block":document.getElementById("error_type_de_bien").style.display="none";
                selected_etat==1 ? document.getElementById("etat_error").style.display="block": document.getElementById("etat_error").style.display="none";
                first_errors+=selected_service+selected_type+selected_etat;
                if(first_errors!=0){
                     e.preventDefault();
                     return;
                }
      }
      if(currentStep==2 && e.target.id!=="prev"){
              let second_errors=0;
              let surface=document.querySelector("input[name='surface']");
              let prix  =document.querySelector("input[name='prix']");
              if(surface.value==""){
                      document.getElementById("surface_error").style.display="block";
                      second_errors++;
              }
              else{
                  document.getElementById("surface_error").style.display="none";
              }
              if(prix.value==""){
                      document.getElementById("prix_error").style.display="block";
                      second_errors++;
              }
              else{
                      document.getElementById("prix_error").style.display="none";
              }
              if(second_errors!=0){
                    e.preventDefault();
                    return;
              }
      }
      if((currentStep==3 && e.target.id!=="prev")){
              let finnaly_errors=0;
              let titre=document.querySelector("input[name='titre']");
              let telephone=document.querySelector("input[name='Telephone']");
              let description= document.querySelector("textarea[name='description']");
              console.log(description);
              if(titre.value==""){
                  document.getElementById("titre_error").style.display="block";
                  finnaly_errors++;
              }
              else{
                     document.getElementById("titre_error").style.display="none";
              }
             if(telephone.value==""){
                      document.getElementById("telephone_error").style.display="block";
                      finnaly_errors++;
             }
             else{
                      document.getElementById("telephone_error").style.display="none";
             }
             if(description.value==""){
                      document.getElementById("description_error").style.display="block";
                      finnaly_errors++;
             }
             else{
                      document.getElementById("description_error").style.display="none";
             }
            if(!exit_images()){
                  finnaly_errors++;
            }
            if(finnaly_errors!=0){
                      e.preventDefault();
                      return;
            }
            function exit_images(){
                  let images =document.getElementsByClassName("images_input");
                  let null_images=0;
                  for(let i=0;i<images.length;i++){
                            if(images[i].value === ""){
                                    null_images++;
                            }
                  }
                  if(null_images==5){
                    alert("Vous devez Choisir Au moins Une Image");
                    return false;
                  }
                  else{
                    return true;
                  }
            }
      }
      currentStep = e.target.id === "next" ? ++currentStep:currentStep;
      currentStep=  e.target.id === "prev" ? --currentStep:currentStep;
                            if(currentStep==1){
                                for (let i = 0; i < Filed_set.length; i++) {
                                      if(i==(currentStep-1))
                                      {
                                            Filed_set[i].style.display='block';
                                      }
                                      else{
                                            Filed_set[i].style.display='none';
                                      }
                                }
                                document.getElementById('submit').style.display="none";
                            }
                            else if(currentStep==2){
                              for (let i = 0; i < Filed_set.length; i++) {
                                    if(i==(currentStep-1))
                                    {
                                          Filed_set[i].style.display='block';
                                    }
                                    else{
                                          Filed_set[i].style.display='none';
                                    }
                              }
                              document.getElementById('submit').style.display="none";
                            }
                            else if(currentStep==3){
                              for (let i = 0; i < Filed_set.length; i++) {
                                    if(i==(currentStep-1))
                                    {
                                          Filed_set[i].style.display='block';
                                    }
                                    else{
                                          Filed_set[i].style.display='none';
                                    }
                              }
                              document.getElementById('submit').style.display="block";
                            }
                    circles.forEach((circle, index) => {
                      circle.classList[`${index < currentStep ? "add" : "remove"}`]("active");
                    });

                    progressBar.style.width = `${((currentStep - 1) / (circles.length - 1)) * 100}%`;

                    if (currentStep === circles.length) {
                      buttons[1].disabled = true;
                    } else if (currentStep === 1) {
                      buttons[0].disabled = true;
                    } else {
                      buttons.forEach((button) => (button.disabled = false));
                    }
};
buttons.forEach((button) => {
button.addEventListener("click", updateSteps);
});
//End  progress bar et Check is the field is not empty