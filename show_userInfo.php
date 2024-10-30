<?php
require_once 'condb.php';
include 'header.php';
include 'footer.php';
if (session_status() == PHP_SESSION_NONE)
    session_start();
$sql = "SELECT * FROM user_info";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
error_reporting(0);
$set_role = 1;
?>

<!DOCTYPE html>
<html>

<head>
    <title>View Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h1>User Table</h1>
        <table class="table" id="data_table">
            <thead>
                <tr>
                    <th>id </th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                   
                    <th>Role</th>
                    <th>User ID</th>
                    <th>Reg Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            foreach ($users as $user) {
                $role = '';
                if ($user['role'] == 1) {
                    $role = 'Admin';
                    
                } else {
                    $role = 'User';
                }

                if (is_null($user['address'])) {
                    $address = "Not Set";
                } else {
                    $address = $user["address"];
                }
                if (is_null($user['avatar'])) {
                    $avatar = "Not Set";
                } else {
                    $avatar = $user["avatar"];
                }
                echo "<tbody><tr>
                    <td style='text-align:center;'>" . $user['id'] . "</td>
                    <td>" . $user['fname'] . "</td>
                    <td style='text-align:center;'>" . $user['lname'] . "</td>
                    <td>" . $user['email'] . "</td>
                    <td>" . $address . "</td>
                    
                    <td style='text-align:center;'>" . $role . "</td>
                    <td style='text-align:center;'>" . $user['user_id'] . "</td>
                    <td style='text-align:center;'>" . $user['reg_date'] . "</td>
                    ";
                ?>


                <td>
                    <form action="userInfo_view.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $user['user_id']; ?>">
                        <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                        <button type="submit" class="btn btn-warning" data-user-id="'.$user['user_id'].'">Edit</button>
                    </form>
                    <?php

                    echo $_SESSION['role'] != $user['role'] ? '
                    <form action="ex06_delete_sweet.php" method="POST" style="display:inline;">
                        <input type="hidden" name="shoe_id" value="' . $user['user_id'] . '">
                        <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                        <button type="button" class="btn btn-danger delete-button"
                            data-user-id="' . $user['user_id'] . '">Delete</button>
                    </form>
                </td>' : "</td>"

                        ?>



                    </tr>
                    </tbody>
                    <?php
            }
            ?>
        </table>
        <div>
            <a class="btn btn-secondary" href="index.php">ย้อนกลับไปหน้าหลัก</a>
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#data_table');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // let table = new DataTable('#userTable');
        function intializingDataTable(table) {
            $(table).DataTable();
        };

        intializingDataTable('#userTable');


    </script>
    <script>
        // ฟังก์ชันสาหรับแสดงกล่องยืนยัน ํ SweetAlert2
        function showDeleteConfirmation(id) {
            Swal.fire({
                title: 'คุณแน่ใจหรือไม่?',
                text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได้!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ลบ',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    // หากผู้ใชยืนยัน ให ้ส ้ งค่าฟอร์มไปยัง ่ delete.php เพื่อลบข ้อมูล
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'user_delete.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'id';
                    input.value = id;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        // แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const shoe_id = button.getAttribute('data-user-id');
                showDeleteConfirmation(shoe_id);
            });
        });
    </script>
</body>

</html>