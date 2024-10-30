<?php
if(session_status() == PHP_SESSION_NONE) session_start();
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
 include 'condb.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $user_id          = $_SESSION['id']; // รหัสผู ้ใช้ที่เข้าสู ่ระบบ
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
 
    // ตรวจสอบว่ารหัสผ่านใหม่และการยืนยันรหัสผ่านตรงกันหรือไม่
    if ($new_password !== $confirm_password) {
        echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "รหัสผ่านใหม่ไม่ตรงกับการยืนยัน",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location = "change_password.php";  
                });
            }, 1000);
        </script>';
        exit();
    }
 
    // ดึงข้อมูลรหัสผ่านเก่าของผู ้ใช้จากฐานข้อมูล
    $sql  = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // ตรวจสอบว่ารหัสผ่านเก่าที่ผู ้ใช้กรอกตรงกับที่อยู ่ในฐานข้อมูลหรือไม่
    if (!password_verify($current_password, $user['password'])) {
        echo '<script>
            setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "รหัสผ่านเก่าไม่ถูกต้อง",
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location = "change_password.php";  
                });
            }, 1000);
        </script>';
        exit();
    }
    // หากผ่านการตรวจสอบทั ้งหมด ให้อัปเดตรหัสผ่านใหม่
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $sql  = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $new_password_hashed);
    $stmt->bindParam(2, $user_id);
    $stmt->execute();
    // แจ้งผลลัพธ์สําเร็จ
    echo '<script>
        setTimeout(function() {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "เปลี่ยนรหัสผ่านสําเร็จ",
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location = "index.php";  
            });
        }, 1000);
    </script>';
    exit();
}


?>