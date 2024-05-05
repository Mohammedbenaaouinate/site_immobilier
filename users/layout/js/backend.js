// function displayImages() {
//   const fileInput = document.getElementById("fileInput");
//   const imagePreview = document.getElementById("imagePreview");

//   // Check if any files are selected
//   if (fileInput.files && fileInput.files.length > 0) {
//     for (let i = 0; i < fileInput.files.length; i++) {
//       const reader = new FileReader();

//       reader.onload = function (event) {
//         // Create a new image element
//         const img = new Image();
//         // console.log(event);
//         img.src = event.target.result;

//         let el = document.createElement("div");
//         el.classList.add("upload_image");
//         el.classList.add("first_image");
//         el.appendChild(img);

//         // Append the image to the image preview div
//         imagePreview.appendChild(el);
//       };

//       // Read the current file as a data URL
//       console.log(fileInput.files[i]);
//       reader.readAsDataURL(fileInput.files[i]);
//     }
//   }
// }
