 <?php
    include "condb.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = 0;
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $existed_email = $stmt->fetchColumn(); // ดึงค่า count จากการตรวจสอบอีเมล
if(empty($existed_email)) {
        try {
            $conn->beginTransaction();
        $sql1 = "INSERT INTO users (fname,lname,email,password,role) VALUES (:fname,:lname,:email,:password,:role)";
        $smt1 = $conn->prepare($sql1);
        $smt1->bindParam("fname",$fname);
        $smt1->bindParam("lname",$lname);
        $smt1->bindParam("email",$email);
        $smt1->bindParam("password",$password);
        $smt1->bindParam("role",$role);
        $result = $smt1->execute();
        $user_id = $conn->lastInsertId();

        $sql2 = "INSERT INTO user_info (fname, lname, email,role,user_id) VALUES (:fname,:lname,:email,:role,:user_id)";
        $smt2 = $conn->prepare($sql2);
        $smt2->bindParam("fname",$fname);
        $smt2->bindParam("lname",$lname);
        $smt2->bindParam("email",$email);
        $smt2->bindParam("role",$role);
        $smt2->bindParam("user_id",$user_id);
        $result2 = $smt2->execute();
        $conn->commit();
        if ($result && $result2) {
            $result = 'sucessfully';
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo'Error:'. $e->getMessage();
    }
}else{
    $result = 'email existed';
}
        //sweet alert
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        if ($result === 'sucessfully') {
            echo '<script>
                    setTimeout(function() {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "สมัครสมาชิกสําเร็จ",
                            showConfirmButton: true,
                            // timer: 1500
                        }).then(function() {
                        window.location = "index.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                        }, 1000);
                        </script>';
        } 
        
        elseif($result == 'email existed') {
            echo '<script>
        setTimeout(function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "มีอีเมลล์อยู่ในระบบอยู่แล้ว",
                    showConfirmButton: true,
                    // timer: 1500
                    }).then(function() {
                window.location = "login.php"; // Redirect to.. ปรับแก ้ชอไฟล์ตามที่ต้องการให ้ไป ื่
                    });
                }, 1000);
            </script>';
        }else {
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
    }
    ?>


