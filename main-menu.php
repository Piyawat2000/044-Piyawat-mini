<?php require_once "userInfo.php"; 
    $_SESSION['error'] = $_SESSION['error'] ?? '';
?>

<!-- Content -->
<div class="container mt-3 m-border text-center">
    <h2>Welcome to PHP-DB Web : <?php echo $user['fname'] . " " . $user['lname'] ?></h2>
    <small <?php echo $_SESSION['error'] != '' ? 'style="border-radius:5px; border:solid 1px red; padding:7px; background-color: rgb(250, 90, 87); "' :'style="display:none;"' ?>><?php echo $_SESSION['error'] ? $_SESSION['error'] : "" ?></small>
    <?php if($_SESSION['error'] != ''){
        unset($_SESSION['error']);
    } ?>
    <div class="d-grid gap-2" style="margin-top:10px;">

        <a href="show.php" class="btn btn-success">รายชื่อรองเท้า</a>
        <a href="request.php" class="btn btn-success">รีเควสรองเท้า</a>
        <a href="insertDataIndex.php" <?php echo $_SESSION['role'] == 1 ? "" : "style='display:none;'" ?> class="btn btn-warning">เพิ่มรองเท้า</a>
        <a href="show.php" <?php echo $_SESSION['role'] == 1 ? "" : "style='display:none;'" ?> class="btn btn-warning">แสดงรายชื่อรองเท้าที่ถูกเพิ่มโดย User นี้</a>
        <a href="request_show.php" <?php echo $_SESSION['role'] == 1 ? "" : "style='display:none;'" ?> class="btn btn-warning">แสดงรายชื่อรีเควสรองเท้า</a>
        <a href="show_userInfo.php" <?php echo $_SESSION['role'] == 1 ? "" : "style='display:none;'" ?> class="btn btn-warning">แสดงข้อมูล User</a>
        <!-- <a href="" class="btn btn-primary">Insert Data with SQL by Prepared Statement=> ?</a>
        <a href="" class="btn btn-primary">Insert Data with Form by PDO</a>
        <a href="" class="btn btn-primary">View Student Data</a> -->
    </div>
</div>
<!-- End Content -->