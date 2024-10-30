<?php
include "header.php";
include "footer.php";
include "condb.php";
if(session_status() == PHP_SESSION_NONE) session_start();
error_reporting(0);
$sql = "SELECT * from user_info WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":user_id", $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$fullname = $user['fname']." ".$user['lname'];
$_SESSION['fullname'] = $fullname;
$img = "";
if(is_null($user['avatar'])){
    $img = "https://firebasestorage.googleapis.com/v0/b/loginsys-b8d67.appspot.com/o/images.png?alt=media&token=530d5d10-49a2-42c2-9be3-77ed7ace364f";
}else{
    $img = "img/".$user['user_id'].'/'.$user['avatar'];
}

if(is_null($user['address'])){
    $user['address'] = "Not Set";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .profile-head {
            transform: translateY(5rem)
        }

        .cover {
            background-image: url(https://images.unsplash.com/photo-1530305408560-82d13781b33a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80);
            background-size: cover;
            background-repeat: no-repeat
        }

        body {
            background: #654ea3;
            background: linear-gradient(to right, #e96443, #904e95);
            min-height: 100vh;
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="row py-5 px-4">
        <div class="col-md-5 mx-auto"> <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3">
                            <img src="<?php echo $img ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0"><?php echo $fullname ?></h4>
                            
                        </div>
                    </div>
                        <a href="profile_edit_form.php" class="btn btn-outline-dark btn-sm btn-block">แก้ไขโปรไฟล์</a>
                        <a href="change_password.php" class="btn btn-outline-dark btn-sm btn-block">เปลี่ยนรหัส</a>
                    </div>
                </div>
                <div class="bg-light  p-4 d-flex justify-content-end text-center">
                    
                </div>
                <div class="px-4 py-3">
                    <h5 class="mb-0">Adress</h5>
                    <div class="p-4 rounded shadow-sm bg-light">
                        <p class="font-italic mb-0"><?php echo $user['address'] ?></p>
                      
                    </div>
                </div>
                <div class="py-4 px-4">
                    
                    </div>
                </div>
                <div class="d-flex justify-content-end" >
                        <a href="index.php" class="btn mt-2 btn-primary">Back</a>
                        
            </div>
            </div>
        </div>
    </div>
</body>

</html>