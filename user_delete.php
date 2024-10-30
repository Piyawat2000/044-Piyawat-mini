<?php
    require_once "condb.php";
    if(session_status() == PHP_SESSION_NONE) session_start();
    $id = $_POST['id'];
    
    $conn->beginTransaction();
    $sql1 = "DELETE FROM users WHERE id = :id";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bindParam(":id", $id);
    $result = $stmt1->execute();

    $sql2 = "DELETE FROM user_info WHERE user_id = :user_id";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(":user_id", $id);
    $result2 = $stmt2->execute();
    $conn->commit();

    
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($result && $result2) {
            if($id == $_SESSION['id']){
                echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "ลบข้อมูลสำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "logout.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                });
                    }, 1000);
                    </script>';
            }else{
                echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "ลบข้อมูลสำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "show_userInfo.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                });
                    }, 1000);
                    </script>';
            }
            
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
?>