<?php include "img_manage.php";

        if(session_status() == PHP_SESSION_NONE) session_start();
       if (!isset($_SESSION["role"])) {
        header('Location: login.php');
    }
include "userInfo.php";
$img = "";
if(is_null($user['avatar'])){
    $img = "https://firebasestorage.googleapis.com/v0/b/loginsys-b8d67.appspot.com/o/images.png?alt=media&token=530d5d10-49a2-42c2-9be3-77ed7ace364f";
}else{
    $img = "img/".$user['user_id'].'/'.$user['avatar'];
}

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP-DB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .m-border {
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 800px;
            padding: 20px;
        }
        body{
            padding: 0;
        }
    </style>
</head>

<body>
 <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="profile.php"><img src="<?php echo $img ?>" alt="myphoto" class="rounded-pill
me-2" style="width: 30px;"><?php echo strtoupper($user['fname']." ".$user['lname']) ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bstarget="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                arialabel="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo isset($_SESSION['role']) ? 'logout.php' : 'login.php' ?>"><?php echo isset($_SESSION['role']) ? 'Logout' : 'Login' ?></a>
                        
                    </li>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
