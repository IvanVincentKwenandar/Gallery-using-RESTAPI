<?php
include "api/connect.php";
if (isset ($_SESSION['nrp'])){
    header ("location: Mainmenu.php");
}
if (isset($_GET['stat'])) {
if ($_GET['stat']== 1) {
    echo "<script> alert ('Wrong Password and NRP'); </script> ";
    }
}
if( isset($_SESSION["check"])){
    header("location: Mainmenu.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
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
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <div class="card p-4 text-left" id="form-card">
                    <body class="text-center" data-new-gr-c-s-check-loaded="14.986.0" data-gr-ext-installed="">
                        <h1 class="title-h1">Login</h1>
                        <main class="form-signin">
                            <form action="api/ceklogin.php" method="POST">
                                <p id="p"> Login Page </p>
                                <label for="username" class="visually-hidden">Username</label>
                                <input type="username" name="username" id="username" class="form-control" placeholder="Ex: c14200xxx" required="">
                                <label for="password" class="visually-hidden">Password</label>
                                <input type="password" id="password" name="pass" class="form-control" placeholder="Password" required="">
                                <br>
                                <button class="btns" id="acheck" type="submit">
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
                                    <span>Sign In</span>
                                </button>
                                <br>
                                <br>
                                <a href = "Mainmenu.php"> Main Page </a>
                                <p class="mt-5 mb-3 text-muted">© 2023</p>
                            </form>
                        </main>
                    </body>

            </div>
        </div>
                
            <div class="col-md-4"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script>
        $(window).on("load",function(){
            $('.loading-wrapper').fadeOut(3000);
        });
    </script>
</body>
</html>