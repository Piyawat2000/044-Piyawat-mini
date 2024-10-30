<?php
include "condb.php";
if(session_status() == PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    if(!empty($_POST['shoes_name'])) {
    $sql = "SELECT * FROM users WHERE id = :id
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
   $fullname = $user['fname']." ".$user['lname'];
    
    
        $name = $_POST['shoes_name'];
        // $sql = "INSERT INTO $tableName (name, price, addBy) VALUES ('$name' , '$price' ,'$uploadBy' )";
        // $result = $conn->exec($sql); ธรรมดา

        $sql = "INSERT INTO request_shoe (shoe_name, addBy,user_id) VALUES (:shoe_name, :addBy, :user_id)"; //sql 
        $smt = $conn->prepare($sql); //เตรียมข้อมูล
        $smt->bindParam(":shoe_name", $name); //เชื่อมข้อมูลแต่ละตัว เช่น ตัวแปลในฐานข้อมูล เชื่อมด้วย ตัวแปร name ที่จะอัพขึ้น database
        $smt->bindParam(":addBy", $fullname); //เชื่อมข้อมูลแต่ละตัว
        $smt->bindParam(":user_id", $_SESSION['id']); //เชื่อมข้อมูลแต่ละตัว
        $result = $smt->execute(); //บันทึกข้อมูลลงฐานข้อมูล
       
        if ($result) {
            echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "เพิ่มข้อมูลสำเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "index.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                        }, 1000);
                        </script>';
        } else {
            echo '<script>
        setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "เกิดข้อผิดพลาด",
                    showConfirmButton: true,
                    // timer: 1500
                    }).then(function() {
                window.location = "login.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
        }
    }else{
        echo '<script>
        setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "โปรดใส่ข้อมูลให้ถูกต้อง",
                    showConfirmButton: true,
                    // timer: 1500
                    }).then(function() {
                window.location = "login.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
    }
    
}
