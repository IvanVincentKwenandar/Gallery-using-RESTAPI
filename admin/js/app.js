function holdstate(event){
    event.preventDefault();
}

// function onSubmitAddPhoto(element){
//     const userInput = document.querySelector('#user').value;
//     const nameInput = document.querySelector('#namaimg').value;
//     const imageInput = document.querySelector('#fileimg').files[0];

//     const newImage = btoa(imageInput);
  
//     console.log(nameInput);
//     console.log(userInput);
//     console.log(imageInput);
    
//     $.ajax({
//         url: "http://localhost/Requester/api/addPhoto.php",
//         type: 'POST',
//         processData: false,
//         data: JSON.stringify({
//             'user': userInput,
//             'nama': nameInput,
//             'file': newImage
//         }),
//         contentType: 'application/json',
//         dataType: 'json',
//         success: function(response) {
//             if (response) {
//               console.log("Add Photo Success");
//               console.log(response);
//               //   location.reload();
//             } else {
//               console.log("Empty response");
//             }
//           },
//           error: function(xhr, status, error) {
//             console.log("Error add photo");
//             console.log(status);
//             console.log(error);
//           },
//           complete: function(xhr, status) {
//             console.log("Ajax request complete");
//             console.log(status);
//           }
//     })
//   }



// function onSubmitAddPhoto(element) {
//     const userInput = document.querySelector('#user').value;
//     const nameInput = document.querySelector('#namaimg').value;
//     const imageInput = document.querySelector('#fileimg').files[0];
    
//     const reader = new FileReader();
//     reader.readAsBinaryString(imageInput);
    

//     reader.onload = function () {
//       const base64Image = btoa(reader.result);
//     //   console.log(reader.result);
//       $.ajax({
//         url: "http://localhost/Requester/api/addPhoto.php",
//         type: 'POST',
//         processData: false,
//         data: JSON.stringify({
//           'user': userInput,
//           'nama': nameInput,
//           'file': base64Image
//         }),
//         contentType: 'application/json',
//         dataType: 'json',
//         success: function(response) {
//           if (response) {
//             console.log("Add Photo Success");
//             console.log(response);
//             //   location.reload();
//           } else {
//             console.log("Empty response");
//           }
//         },
//         error: function(xhr, status, error) {
//           console.log("Error add photo");
//           console.log(status);
//           console.log(error);
//         },
//         complete: function(xhr, status) {
//           console.log("Ajax request complete");
//           console.log(status);
//         }
//       });
//     };
//   }  

function onSubmitAddPhoto(element) {
    const userInput = document.querySelector('#user').value;
    const nameInput = document.querySelector('#namaimg').value;
    const imageInput = document.querySelector('#fileimg').files[0];
  
    if (!imageInput) {
      console.log('No image file selected.');
      return;
    }
   
    // const base64Image = btoa(reader.result);
    const formData = new FormData();
    formData.append('user', userInput);
    formData.append('nama', nameInput);
    formData.append('file', imageInput);
    $.ajax({
    url: 'http://localhost/Requester/api/addPhoto.php',
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    cache: false,
    success: function(response) {
        if (response) {
        console.log('Add Photo Success');
        console.log(response);
        // location.reload();
        } else {
        console.log('Empty response');
        }
    },
    error: function(xhr, status, error) {
        console.log('Error adding photo: ' + error);
    },
    complete: function(xhr, status) {
        console.log('Ajax request complete');
    }
    });
  }
  