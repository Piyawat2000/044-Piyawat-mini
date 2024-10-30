<?php
include "condb.php";
if (session_status() == PHP_SESSION_NONE) session_start();

$fname  = $_POST['fname'];
$lname  = $_POST['lname'];
$file  = $_FILES['avatar'];
$address  = $_POST['address'];
$id = $_SESSION['id'];
$sql = "SELECT * FROM user_info WHERE user_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$targetDir = "img/".$_SESSION['id'].'/';
$upload_result = true;
echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
// Check if the file is uploaded
$fileType = pathinfo($file['name'], PATHINFO_EXTENSION);
// ตรวจสอบประเภทไฟล์(สามารถเพิ่มประเภทที่ตอ้งการได)้
$allowTypes = array('jpg', 'png', 'jpeg', 'gif'); // ประเภทไฟล์ที่อนุญาต
if(isset($file) && $file['error'] == UPLOAD_ERR_OK){
if (in_array($fileType, $allowTypes)) { // ตรวจสอบวา่ อยใู่ นประเภทที่อนุญาตหรือไม่
    
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION); // Get the file extension
    $originalFileName = basename($file['name']);
    $img_file = $id."." . $fileExtension;
    $targetFile = $targetDir . $originalFileName;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        
        $sql = "UPDATE user_info SET 
          avatar = :avatar
          WHERE user_id = :user_id";
        // Prepare statement
        $stmt = $conn->prepare($sql);
        $upload_result = $stmt->execute(["avatar" => $originalFileName, "user_id" => $id]);
       
    } else {
        echo "Error moving the uploaded file.";
    }
    if ($user && !empty($user['avatar'])) {
        $oldFile = $targetDir . $user['avatar'];
       
        if ($upload_result && file_exists($oldFile)) {
            unlink($oldFile); // Deletes the old file
        };
    }
} else {
    echo '<script>
setTimeout(function() {
    Swal.fire({
        position: "center",
        icon: "error",
        title: "ประเภทไฟล์ไม่รองรับ",
        showConfirmButton: true,
        // timer: 1500
        }).then(function() {
    window.location = "profile_edit_form.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
        });
    }, 1000);
</script>';
    exit();
}}

try{
$conn->beginTransaction();

$sql = "UPDATE user_info SET 
      fname = :fname,
      lname = :lname,
      address = :address
      WHERE user_id = :user_id";
// Prepare statement
$stmt = $conn->prepare($sql);
$stmt->bindParam(":fname", $fname);
$stmt->bindParam(":lname", $lname);
$stmt->bindParam(":address", $address);
$stmt->bindParam(":user_id", $id);
$update_info = $stmt->execute();

$sql2 = "UPDATE users SET 
      fname = :fname,
      lname = :lname
      WHERE id = :id";
// Prepare statement
$stmt2 = $conn->prepare($sql2);
$stmt2->bindParam(":fname", $fname);
$stmt2->bindParam(":lname", $lname);
$stmt2->bindParam(":id", $id);
$update_users = $stmt2->execute();
$conn->commit();

if ($update_info && $update_users && $upload_result) {
    echo '<script>
                setTimeout(function() {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "สำเร็จ",
                        showConfirmButton: true,
                        // timer: 1500
                    }).then(function() {
                    window.location = "profile.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                });
                    }, 1000);
                    </script>';
}else{
    echo 'error';
}
}catch(PDOException $e) {
    $conn->rollBack();
    echo '<script>
    setTimeout(function() {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "'.$e->getMessage().'",
            showConfirmButton: true,
            // timer: 1500
        }).then(function() {
        window.location = "profile.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
    });
        }, 1000);
        </script>';
}

