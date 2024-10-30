<?php
include "condb.php";
if(session_status() == PHP_SESSION_NONE) session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $sql = "UPDATE $table SET 
    name = :name, 
   price = :price
WHERE shoe_id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':shoe_id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
   $fullname = $user['fname']." ".$user['lname'];
    
    
        
        $result = $smt->execute(); //บันทึกข้อมูลลงฐานข้อมูล
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
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
    
}
?>