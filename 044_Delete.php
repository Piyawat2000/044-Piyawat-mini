<?php
include 'condb.php';
include 'header.php';
include 'footer.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $p_key = $_POST['key'];
    $table_h = $_POST['table'];
    echo $id."<br>";
    // echo $p_key."<br>";
    // echo $table_h."<br>";
    try {

        $sql = "DELETE FROM $table_h WHERE $p_key = :some";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":some", $id);
        $result = $stmt->execute();
        
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($result) {
            echo '<script>
                        setTimeout(function() {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "ลบข้อมูลสําเร็จ",
                                showConfirmButton: true,
                                // timer: 1500
                            }).then(function() {
                            window.location = "show.php"; // Redirect to.. ปรับแก้ชื่อไฟล์ตามที่ต้องการให้ไป
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
                    window.location = "show.php"; // Redirect to.. ปรับแก้ชื่อไฟล์ตามที่ต้องการให้ไป
                        });
                    }, 1000);
                </script>';
        }




      } catch (PDOException $e) {
        echo $e->getMessage();
      }
      
    
}
?>