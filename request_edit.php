<?php
include "header.php";
include "footer.php";
$id = $_POST['id'];
$sql = "SELECT * FROM request_shoe";
$stmt = $conn->prepare($sql);
$stmt->execute();
$request = $stmt->fetch(PDO::FETCH_ASSOC);
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
        <form action="request_edit_script.php" method="post">
            <input name="id" type="hidden" value="<?php echo $id ?>">
            <div class="mb-3">
                <label for="shoes_name" class="form-label">ชื่อรองเท้า</label>
                <input type="text" class="form-control" placeholder="กรอกชื่อสินค้า" value="<?php echo $request['shoe_name'] ?>" name="name"  id="shoes_name" aria-describedby="shoes_name">
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