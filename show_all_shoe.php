<?php
require_once 'condb.php';
include 'header.php';
include 'footer.php';

if(session_status() == PHP_SESSION_NONE) session_start();
$sql = "SELECT * FROM tb_shoesproduct WHERE user_id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam("id", $_SESSION['id']);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h1>Shoes Record</h1>
        <table class="table" id="data_table">
            <thead>
                <tr>
                    <th>id รองเท้า</th>
                    <th>ชื่อรองเท้า</th>
                    <th>ราคา</th>
                    <th>เพิ่มข้อมูลโดย</th>
                    <th>วันที่ลงข้อมูล</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            foreach ($products as $product) {
                echo "<tbody><tr>
                    <td style='text-align:center;'>" . $product['shoe_id'] . "</td>
                    <td>" . $product['name'] . "</td>
                    <td style='text-align:center;'>" . $product['price'] . "</td>
                    <td>" . $product['addBy'] . "</td>
                    <td style='text-align:center;'>" . $product['reg_date'] . "</td>
                    ";

                ?>

                <td>
                <form action="form_edit_shoe.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $product['shoe_id']; ?>">
                        <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                        <button type="submit" class="btn btn-warning"
                            data-user-id="<?php echo $product['shoe_id']; ?>">Edit</button>
                </form>
                    <form action="044_Delete.php" method="POST" style="display:inline;">
                        
                        <!-- <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-sm"> -->
                        <button type="button" class="btn btn-danger delete-button"
                            data-shoe-id="<?php echo $product['shoe_id']; ?>">Delete</button>
                    </form>


                </td>

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
        // let table = new DataTable('#productTable');
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
                    form.action = '044_Delete.php';
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'id';
                    input.value = id;

                    const table = document.createElement('input');
                    table.type = 'hidden';
                    table.name = 'table';
                    table.value = "tb_shoesproduct";

                    const key = document.createElement('input');
                    key.type = 'hidden';
                    key.name = 'key';
                    key.value = "shoe_id";
                    form.appendChild(input);
                    form.appendChild(table);
                    form.appendChild(key);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
        // แนบตัวตรวจจับเหตุการณ์คลิกกับองค์ปุ่ มลบทั้งหมดที่มีคลาส delete-button
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const shoe_id = button.getAttribute('data-shoe-id');
                showDeleteConfirmation(shoe_id);
            });
        });
    </script>
</body>

</html>