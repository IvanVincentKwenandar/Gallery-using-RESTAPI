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
    <link rel="stylesheet" href="./style.css">
    <title>Admin Page</title>
    <link rel="icon" href="../asset/icon.png">
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

    <div class = "container">
        <div class = "row"> 
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <div class="card p-4 text-left">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="1000000">
                    <p id="p"> Upload Page </p>
                    <label class="visually-hidden">Nama</label>
                    <input id="user" hidden value="<?php echo $user?>" name="user">
                    <input id="namaimg" type="text" name="name" class="form-control" placeholder=" Nama Foto ">
                    <br>
                    <label for="image" class="visually-hidden">File image</label>
                    <input id="fileimg" type="file" name="image" accept="image/*" required="" placeholder="Upload Image">
                    <br>
                    <br>
                    <button class="btns" id="acheck" type="submit" onclick="onSubmitAddPhoto(this)">
                        <svg width="277" height="62">
                            <defs>
                                <linearGradient id="grad1">
                                    <stop offset="0%" stop-color="cyan" />
                                    <stop offset="100%" stop-color="yellow" />
                                </linearGradient>
                            </defs>
                            <rect x="5" y="5" rx="25" fill="none" stroke="url(#grad1)" width="266" height="50">
                            </rect>
                        </svg>
                        <span>Submit</span>
                    </button>
                    <br>
                    <br>
                    <a href="../Mainmenu.php"> Back to Main Page </a>
                    <br>
                    <a href="logout.php"> Log Out </a>
                </form>



                
            </div>
            </div>
            
            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
    <script>
        $(window).on("load",function(){
            $('.loading-wrapper').fadeOut(3000);
        });
    </script>
    
</body>
</html>