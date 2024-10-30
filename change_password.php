<?php
include "header.php";

include "condb.php";
if(session_status() == PHP_SESSION_NONE) session_start();
error_reporting(0);
if(isset($_POST['id'])) {
    $id = $_POST['id'];
}else{
    $id = $_SESSION['id'];
}
$sql = "SELECT * from user_info WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":user_id", $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$fullname = $user['fname']." ".$user['lname'];
$img = "";
if(is_null($user['avatar'])){
    $img = "https://firebasestorage.googleapis.com/v0/b/loginsys-b8d67.appspot.com/o/images.png?alt=media&token=530d5d10-49a2-42c2-9be3-77ed7ace364f";
}else{
    $img = "img/".$user['avatar'];
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
            transform: translateY(5rem);
            
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
    <form action="change_password_script.php" method="post" onsubmit="return validatePassword();">
    <div class="row py-5 px-4">
        <div class="col-md-5 mx-auto"> <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile pb-4 mr-3">
                            <img src="<?php echo $img ?>" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        <div class="media-body d-flex mb-5 text-white" style="gap:10px">
                        <h4 class="mt-0 mb-0"><?php echo $fullname ?></h4>
                            
                        </div>
                    </div>
                       
                    </div>
                </div>
                
                <div class="py-4 px-4">
                
                <label for="current_password">รหัสผ่านปัจจุบัน</label>
                <input class="form-control opacity-input" type="password" name="current_password"  id="current_password"  style="text-align: start; width:300px;">
                <label for="new_password">รหัสผ่านใหม่</label>
                <input class="form-control opacity-input" type="password" name="new_password" id="new_password"  style="text-align: start; width:300px;">
                <label for="confirm_password">ยีนยันรหัสผ่าน</label>
                <input class="form-control opacity-input" type="password" name="confirm_password" id="confirm_password"  style="text-align: start; width:300px;">
                <button  type="submit" class="btn  btn-primary mt-4" > Submit</button>
                
                    </div>
                    
                </div>
                <div class="d-flex justify-content-end p-3"  >
                        <a href="profile.php" class="btn btn-primary">Back</a>
                        
            </div>
            </div>
            
        </div>
        
    </div>
    
    </form>
    
</body>
<script>
    function validatePassword() {
        const password = document.getElementById('new_password').value;
        const confirmPassword =  
        document.getElementById('confirm_password').value;
 
        // กําหนดเงื่อนไขที่ต้องการ เช่น ต้องมีตัวเลข ตัวอักษรพิมพ์ใหญ่ พิมพ์เล็ก สัญลักษณ์ และความยาว
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
 
 
        if (!password.match(passwordRegex)) {
            alert("รหัสผ่านต้องประกอบด้วยอย่างน้อย 8 ตัวอักษร, มีตัวอักษรพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข และสัญลักษณ์พิเศษ");
            return false;
        }
 
        if (password !== confirmPassword) {
            alert("รหัสผ่านใหม่ไม่ตรงกับการยืนยัน");
            return false;
        }
        return true;
    }
</script>
</html>