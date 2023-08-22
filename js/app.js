function displayss(){
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'http://localhost/Requester/api/display.php');
  xhr.onload = () => {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      const imageList = document.getElementById('image-list');

      data.forEach(image => {
        const col = document.createElement('div');
        col.classList.add('col-md-4');
        col.style.transformStyle = 'preserve-3d';

        const card = document.createElement('div');
        card.classList.add('card', 'text-center');

        const cardInner = document.createElement('div');
        cardInner.classList.add('card-inner');

        const cardFront = document.createElement('div');
        cardFront.classList.add('card-front');

        const img = document.createElement('img');
        img.classList.add('img-responsive');
        img.id = 'gambar';
        img.src = image.url;
        img.alt = '';
        img.title = image.name;

        const cardBack = document.createElement('div');
        cardBack.classList.add('card-back');

        const name = document.createElement('b');
        name.textContent = image.name;

        const uploadedBy = document.createElement('p');
        uploadedBy.textContent = `Uploaded by: ${image.uploaded_by}`;

        const id = document.createElement('p');
        id.textContent = `ID: ${image.id}`;

        const editButton = document.createElement('button');
        editButton.classList.add('btn');
        editButton.id = image.id;
        editButton.textContent = 'Edit';
        editButton.addEventListener('click', function() {
          showModal(this);
        });

        const deleteButton = document.createElement('button');
        deleteButton.classList.add('btn');
        deleteButton.id = image.id;
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', function() {
          deleteModal(this);
        });

        const shareButton = document.createElement('button');
        shareButton.classList.add('btn');
        shareButton.id = image.url;
        shareButton.textContent = 'Share';
        shareButton.addEventListener('click', function() {
          shareModal(this);
        });

        const commentButton = document.createElement('button');
        commentButton.classList.add('btn');
        commentButton.id = image.id;
        commentButton.textContent = 'Comment';
        commentButton.addEventListener('click', function() {
          const idfoto = image.id;
          document.querySelector('#commentModal #valscom').value = idfoto;
          commentModal(this);
        });

        
        cardFront.appendChild(img);

        
        cardBack.appendChild(name);
        cardBack.appendChild(uploadedBy);
        cardBack.appendChild(uploadedBy);
        cardBack.appendChild(editButton);
        cardBack.appendChild(deleteButton);
        cardBack.appendChild(shareButton);
        cardBack.appendChild(commentButton);
        // cardBack.appendChild(id);
        
        cardInner.appendChild(cardFront);
        cardInner.appendChild(cardBack);
        card.appendChild(cardInner);
        col.appendChild(card);
        imageList.appendChild(col);

        card.addEventListener('click', () => {
          const flipped = cardInner.getAttribute('flipped');
          if (flipped === 'false') {
            cardInner.setAttribute('flipped', 'true');
            cardInner.style.transform = 'rotateY(180deg)';
          } else {
            cardInner.setAttribute('flipped', 'false');
            cardInner.style.transform = 'rotateY(0deg)';
          }
        });
      });
    } else {
      console.error(xhr.statusText);
    }
  };
  xhr.onerror = () => console.error(xhr.statusText);
  xhr.send();

}

// async function onSubmitEditModal(element) {
//   const idfoto = document.querySelector('#editModal #vals').value;
//   const edit = document.querySelector('#editModal #editkata').value;


//   console.log('Submitting request with ID:', idfoto, 'and edit value:', edit);

//   const response = await fetch("http://localhost/Tekweb/api/edit.php", {
//       method: "POST",
//       body: JSON.stringify({
//         "idfoto": idfoto,
//         "edit": edit,
//       }),
//       headers: {
//         "Content-Type": "application/json",
//       },
//   });

//   console.log('Received response:', response);
//   const json = await response.json();
//   console.log('Received JSON:', json);
//   if (response.status == 200) {
//     alert("Edit berhasil");
//     location.reload();
//   } else {
//     alert("Something went wrong: " + response.status);
//   }
// }

function onSubmitEditModal(element) {
  const idfoto = document.querySelector('#editModal #vals').value;
  const edit = document.querySelector('#editModal #editkata').value;

  $.ajax({
    url: "http://localhost/Requester/api/edit_photo.php/" + idfoto,
    type: 'PUT',
    data: JSON.stringify({
      'idfoto': idfoto,
      'edit': edit
    }),
    contentType: 'application/json',
    dataType: 'json',
    success: function(response) {
      if (response) {
        console.log("Edit Caption Success");
        console.log(response);
        location.reload();
      } else {
        console.log("Empty response");
      }
    },
    error: function(xhr, status, error) {
      console.log("Error edit caption");
      console.log(status);
      console.log(error);
    },
    complete: function(xhr, status) {
      console.log("Ajax request complete");
      console.log(status);
    }
  });
}


// async function onSubmitDeleteModal(element) {
//   const idfoto = document.querySelector('#deleteModal #vals3').value;
//   const response = await fetch("http://localhost/Tekweb/api/delete.php", {
//       method: "DELETE",
//       body: JSON.stringify({
//         "idfoto": idfoto,
//       }),
//       headers: {
//         "Content-Type": "application/json",
//       },
//   });

//   const json = await response.json();
//   alert(response.status);
//   if (response.status == 200) {
//     alert("Delete berhasil");
//     location.reload();
//   } else {
//     alert("Something went wrong: " + response.statusCode);
//   }
// }

function onSubmitDeleteModal(element){
  const idfoto = document.querySelector('#deleteModal #vals3').value;
  $.ajax({
    url: "http://localhost/Requester/api/delete_photo.php/" + idfoto,
    type: 'DELETE',
    contentType: 'application/json',
    success: function(response) {
      if (response) {
        console.log("Delete Success");
        console.log(response);
        location.reload();
      } else {
        console.log("Empty response");
      }
    },
    error: function(xhr, status, error) {
      console.log("Error delete post");
      console.log(status);
      console.log(error);
    },
    complete: function(xhr, status) {
      console.log("Ajax request complete");
      console.log(status);
    }
  });
}


// async function onSubmitCommentModal(element, user) {
//   const idfoto = document.querySelector('#commentModal #valscom').value;
//   const komentar = document.querySelector('#commentModal #kom').value;

//   // document.querySelector('#commentModal #valscom').value = idfoto;

//   const response = await fetch("http://localhost/Requester/api/get_comment.php" + user, {
//       method: "POST",
//       body: JSON.stringify({
//         "idfoto": idfoto,
//         "komentar": komentar,
//       }),
//       headers: {
//         "Content-Type": "application/json",
//       },
//   });

//   const json = await response.json();
//   alert(response.status);
//   if (response.status == 200) {
//     alert("Comment berhasil");
//     location.reload();
//   } else {
//     alert("Something went wrong: " + response.statusCode);
//   }
// }


function onSubmitCommentModal(element) {
  const idfoto = parseInt(document.querySelector('#commentModal #valscom').value);
  const user = document.querySelector('#commentModal #valscom2').value;
  const komentar = document.querySelector('#commentModal #kom').value;

  $.ajax({
    url: "http://localhost/Requester/api/get_comment.php/" + user,
    type: 'POST',
    data: JSON.stringify({
      'idfoto': idfoto,
      'komentar': komentar
    }),
    contentType: 'application/json',
    dataType: 'json',
    success: function(response) {
      if (response) {
        console.log("Add Comment Success");
        console.log(response);
      } else {
        console.log("Empty response");
      }
    },
    error: function(xhr, status, error) {
      console.log("Error add comment");
      console.log(status);
      console.log(error);
    },
    complete: function(xhr, status) {
      console.log("Ajax request complete");
      console.log(status);
    }
  });
}


function onSubmitShowComment(element) {
  const idfoto = document.querySelector('#commentModal #valscom').value;
  const idfooInput = document.querySelector('#showComment input[name="idfoo"]');
  const idfooValuePlaceholder = document.querySelector('#showComment #idfooValuePlaceholder')
  idfooInput.value = idfoto;

  $.ajax({
    url: "http://localhost/Requester/api/get_comment.php/" + idfoto,
    type: 'GET',
    contentType: 'application/json',
    success: function(response) {
      if (response) {
        console.log("View Comment Success");
        console.log(response);
        const comments = response;
        const commentsDiv = document.querySelector('#showComment #comments');
        commentsDiv.innerHTML = ''; // Clear existing comments
        comments.forEach(comment => {
          const commentDiv = document.createElement('div');
          commentDiv.textContent = `${comment.Username}: ${comment.komm}`;
          commentsDiv.appendChild(commentDiv);
        });

        const myModal = new bootstrap.Modal(document.getElementById('showComment'));
        myModal.show();
      } else {
        console.log("Empty response");
      }
    },
    error: function(xhr, status, error) {
      console.log("Error view comment");
      console.log(status);
      console.log(error);
    },
    complete: function(xhr, status) {
      console.log("Ajax request complete");
      console.log(status);
    }
  });
}


// async function onSubmitShowComment(element){
//   const idfoto = document.querySelector('#commentModal #valscom').value;
//   const idfooInput = document.querySelector('#showComment input[name="idfoo"]');
//   const idfooValuePlaceholder = document.querySelector('#showComment #idfooValuePlaceholder')
//   idfooInput.value = idfoto; // Set the desired value here
//   // idfooValuePlaceholder.textContent = idfooInput.value; // updated span content here
  
//   // Send AJAX request to retrieve comments
//   const xhr = new XMLHttpRequest();
//   xhr.onreadystatechange = function() {
//     if (this.readyState === 4 && this.status === 200) {
//       const comments = JSON.parse(this.responseText);
//       const commentsDiv = document.querySelector('#showComment #comments');
//       commentsDiv.innerHTML = ''; // Clear existing comments
//       comments.forEach(comment => {
//         const commentDiv = document.createElement('div');
//         commentDiv.textContent = `${comment.Username}: ${comment.komm}`;
//         commentsDiv.appendChild(commentDiv);
//       });
//     }
//   };
//   xhr.open('GET', `api/get_comment.php?id_foto=${idfoto}`);
//   xhr.send();

//   const myModal = new bootstrap.Modal(document.getElementById('showComment'));
//   myModal.show();
// }



const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");
// const headbutton = document.querySelector(".headbutton");

hamburger.addEventListener("click", mobileMenu);

function mobileMenu() {
    hamburger.classList.toggle("active");
    navMenu.classList.toggle("active");
}

const navLink = document.querySelectorAll(".nav-link");

navLink.forEach(n => n.addEventListener("click", closeMenu));

function closeMenu() {
    hamburger.classList.remove("active");
    navMenu.classList.remove("active");
    // document.getElementById("headbutton").style.visibility = "visible";
  }



function showModal(element){
  var id = element.id;
  var myModal = new bootstrap.Modal(document.getElementById('editModal'));
  
  const vals = document.querySelector("#vals");
  vals.value = id;

  myModal.show();

}

function shareModal(element){
  var id2 = element.id;
  var myModal = new bootstrap.Modal(document.getElementById('shareModal'));
  
  const vals2 = document.querySelector("#val4");
  vals2.value = id2;

  myModal.show();
}

function commentModal(element){
  var id2 = element.id;
  var myModal = new bootstrap.Modal(document.getElementById('commentModal'));
  
  const vals2 = document.querySelector("#valscom");
  vals2.value = id2;

  myModal.show();
}


function deleteModal(element){
  var id = element.id;
  var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
  
  const vals3 = document.querySelector("#vals3");
  vals3.value = id;

  myModal.show();
}

function copyTextToClipboard() {
  var copyTextarea = document.getElementById("val4");
  copyTextarea.select();
  document.execCommand("copy");
}

function shareit(){
  var link = $('textarea#val4').val();
  window.open ('http://www.facebook.com/sharer.php?u='+link,'','width=750, height=750, scrollbars=yes, resizable=no');

}
