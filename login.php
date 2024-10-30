<?php
session_start(); // เริ่มหน้า session เพื่อใช้ในการเก็บข้อมูลระหว่างหน้าเว็บ
include "img_manage.php";
if (isset($_SESSION["role"])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-
EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
    <div class="login-container">
        <div class="login-image">
            <img src="<?php echo $img_path.$login_img ?>" alt="Background image">
        </div>
        <div class="login-form">
            <h1>FormLogin</h1>
            <!-- ตรวจสอบว่ามีข้อผิดพลาดที่ถูกเซ็ตใน session หรือไม่ -->
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $_SESSION['error']; // แสดงข้อความแจ้งเตือนแบบแสดงสีแดง
                    unset($_SESSION['error']); // เคลียร์ข้อผิดพลาดออกจาก session
                    ?>
                </div>
            <?php } ?>
            <form action="login_script.php" method="post">
                
                <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="email">
            </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="password">
            </div>
               
                <button type="submit" style="width: 400px;">Sign In</button>
                
            </form>
            <p style="text-align: center; margin-top: 20px;">Don't have an
                account yet? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
</body>

</html>
