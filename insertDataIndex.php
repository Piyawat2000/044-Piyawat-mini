<?php
include "header.php";
include "footer.php";
include "admin_session.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes</title>
</head>
<body>
    <div class="container">
        <h3 class="mt-4">กรอกข้อมูลสินค้ารองเท้า</h3>
        <hr>
        <form action="HW07_insertData01.php" method="post">
            <div class="mb-3">
                <label for="shoes_name" class="form-label">ชื่อรองเท้า</label>
                <input type="text" class="form-control" placeholder="กรอกชื่อสินค้า" name="shoes_name" id="shoes_name" aria-describedby="shoes_name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">ราคา</label>
                <input type="text" placeholder="กรอกราคาสินค้า" class="form-control" name="price" id="price" aria-describedby="price">
            </div>
            
            
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
        <hr>
        <p class="text-end">
            <a class='btn' href="index.php">กลับหน้าหลัก</a>
        </p>
    </div>
</body>

</html>