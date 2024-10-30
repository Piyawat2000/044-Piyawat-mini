<?php
include "header.php";
include "footer.php";
include "user_session.php"

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
        <h3 class="mt-4">Request รองเท้า</h3>
        <hr>
        <form action="request_script.php" method="post">
            <div class="mb-3">
                <label for="shoes_name" class="form-label">ชื่อรองเท้า</label>
                <input type="text" class="form-control" placeholder="กรอกชื่อสินค้า" name="shoes_name"  id="shoes_name" aria-describedby="shoes_name">
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