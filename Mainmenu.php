<?php
    session_start();
    
    $user;

    if( !isset($_SESSION["check"])){
        header("location: login.php");
        exit;
    }else{
        $user = $_SESSION["admins"];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    <title>Home Page</title>
    <link rel="icon" href="asset/icon.png">
</head>
<body>
    <div class="loading-wrapper">
      <div class="breeding-rhombus-spinner">
        <div class="rhombus child-1"></div>
        <div class="rhombus child-2"></div>
        <div class="rhombus child-3"></div>
        <div class="rhombus child-4"></div>
        <div class="rhombus child-5"></div>
        <div class="rhombus child-6"></div>
        <div class="rhombus child-7"></div>
        <div class="rhombus child-8"></div>
        <div class="rhombus big"></div>
      </div>
    </div>
    
    <main>
      <header id="header" class="borderCar">
        <nav class="navbar">
          <a href="Mainmenu.php" class="nav-logo">
            <img src="asset/star.png" id="image" alt="">
          </a>
          <ul class="nav-menu">
              <li class="nav-item">
                  <a href="admin/regist.php" class="nav-link">Regist in</a>
              </li>
              <li class="nav-item">
                  <a href="admin/index.php" class="nav-link">Upload</a>
              </li>
              <li class="nav-item">
                  <a href="api/logout.php" class="nav-link">Logout</a>
              </li>
          </ul>
          <div class="hamburger">
              <span class="bar"></span>
              <span class="bar"></span>
              <span class="bar"></span>
          </div>
        </nav>
        <br>
        <br>
        <h1> Photo Album </h1>
        <section id="headbutton">
          <a href="#Mainmenu" class="btns">
              <svg width="277" height="62">
                  <defs>
                      <linearGradient id="grad1">
                          <stop offset="0%" stop-color="#FF0266" />
                          <stop offset="100%" stop-color="#9853F9" />
                      </linearGradient>
                  </defs>
                  <rect x="5" y="5" rx="25" fill="none" stroke="url(#grad1)" width="266" height="50">
                  </rect>
              </svg>
              <span id=text-color>View your Gallery</span>
          </a>
        </section>
        
        
      </header>
      <br>

      <section id="Mainmenu">
        <div class="container-fluid">
          <div class="row" id="image-list">
            
          </div>
        </div>
      </section>


      <section>
      <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Edit Photo </h5>
          </div>
          <div class="modal-body">
          <form action ="api/edit.php" method="POST">
              <input id="vals" hidden value="" name="idfoo">
              <input type="text" id="editkata" name="komentar" class="form-control" placeholder="Ex: Edit sesuatu" required="">
              <br>
              <button type="button" onclick="onSubmitEditModal(this)" class="btn" type="Submit"> Confirm </button>
              <br>
              <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"> Close </button>
          </div>
        </div>
        </div>
        </div>  
      </section>

      <section>
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Delete Photo </h5>
          </div>
          <div class="modal-body">
            <form action ="api/delete.php" method="POST">
              <input id="vals3" hidden value="" name="idfoo">
              <button type="button" onclick="onSubmitDeleteModal(this)" class="btn" type="Submit"> Confirm </button>
              <br>
              <br>
              <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
            </form>
          </div>
        </div>
        </div>
        </div>  
      </section>

      <section>
      <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> Share Photo </h5>
          </div>
          <div class="modal-body">

            <!-- <input id="val4" value="" name="idfoo"> -->
            <textarea readonly name="link_new" id="val4" cols="50" rows="2" value=""></textarea>
            <div class="col-md-4">
              <button class="btn3" type="submit" onclick="copyTextToClipboard()"> <i class="fas fa-copy"></i> </button>
            </div>
            
            <div class="col-md-4">
              <button class="btn3" type="submit" onclick="shareit()"> <i class="fab fa-facebook"></i> </button>
            </div>
            

          </div>
          <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"> Close </button>
          </div>
        </div>
        </div>
        </div>  
      </section>

      <section>
        <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Comment Photo </h5>
              </div>
              <div class="modal-body">
                <form action="api/comment.php" method="POST">
                  <input type="hidden" name="size" value="100000">
                  <input id="valscom" hidden value="" name="idfoto">
                  <input id="valscom2" hidden value="<?php echo $user?>" name="user">
                  <input type="text" id="kom" name="komentar" class="form-control" placeholder="Ex: Komentar sesuatu" required="">
                  <br>
                  <button type="button" onclick="onSubmitCommentModal(this)" class="btn" type="Submit"> Confirm </button>
                  <br>
                  <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"> Cancel </button>
                  <br>
                  <br>
                  <br>
                  <button type="button" onclick="onSubmitShowComment(this)" class="btn" type="Submit"> Show Comment </button>
                          
                </form>

                <div id="comments">
                  <!-- comments will be inserted here -->
                </div> 
                

              </div>
            </div>
          </div>
        </div>
      </section>

      <section>
        <div class="modal fade" id="showComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
              </div>
              <div class="modal-body">
                <input type="text" hidden value="" name="idfoo">
                <!-- <p>Idfoo value: <span id="idfooValuePlaceholder"></span></p>
                <p>halo</p> -->
                <div id="comments">
                  <!-- comments will be inserted here -->
                </div>        
              </div>
            </div>
          </div>
        </div>
      </section>


      <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center align-center-mobile">
                <a href="#header">
                  <img src="asset/star.png" id="image" alt="">
                </a>
                </div>
                
                <div class="col-md-6 text-end mt-5 align-self-center align-center-mobile">
                  <p>Contact me</p>
                    <div class="icons">
                        <div><a href="https://wa.me/081296597949"><i class="fab fa-whatsapp"></i></a></div>
                        <div><a href="https://www.youtube.com/watch?v=zL19uMsnpSU"><i class="fab fa-youtube"></i></a></div>
                        <div><a href="https://www.instagram.com/ivanvincent_/"><i class="fab fa-instagram"></i></a></div>
                    </div>
                    <p class="mt-2">&copy; 2023 by IvanVK</p>
                </div>
            </div>
        </div>
      </footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
    <script>
      $(window).on("load",function(){
          $('.loading-wrapper').fadeOut(2400);
      });

      displayss();
        
  
    </script>


</body>
</html>