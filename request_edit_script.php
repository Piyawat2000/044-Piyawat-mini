<?php
require_once("condb.php");
$id = $_POST['id'];



$name = $_POST['name'];
$sql = "UPDATE request_shoe SET 
        shoe_name = :shoe_name
WHERE id = :id";

$stmt = $conn->prepare($sql);
$stmt->bindParam(":shoe_name", $name);
$stmt->bindParam(":id", $id);
$result = $stmt->execute();

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($result) {
            echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "แก้ไขข้อมูลสำเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "request_show.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
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