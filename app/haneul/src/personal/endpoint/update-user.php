<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_name'], $_POST['N_Phone'],$_POST['Company'], $_POST['email'], $_POST['Area'], $_POST['Equipment'], $_POST['Brand'], $_POST['Serial'])) {
        $studentId = $_POST['tbl_user_id'];
        $userName = $_POST['user_name'];
        $N_Phone = $_POST['N_Phone'];         
        $Company = $_POST['Company'];
        $email = $_POST['email'];
        $Area = $_POST['Area'];
        $Equipment = $_POST['Equipment'];
        $Brand = $_POST['Brand'];
        $Serial = $_POST['Serial'];

        try {
            $stmt = $conn->prepare("UPDATE tbl_user SET user_name = :user_name, N_Phone = :N_Phone, Company = :Company, email = :email, Area = :Area, Equipment = :Equipment, Brand = :Brand, Serial = :Serial WHERE tbl_user_id = :tbl_user_id");
                        
            $stmt->bindParam(":tbl_user_id", $studentId, PDO::PARAM_STR); 
            $stmt->bindParam(":user_name", $userName, PDO::PARAM_STR); 
            $stmt->bindParam(":N_Phone", $N_Phone, PDO::PARAM_STR);              
            $stmt->bindParam(":Company", $Company, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":Area", $Area, PDO::PARAM_STR);
            $stmt->bindParam(":Equipment", $Equipment, PDO::PARAM_STR);
            $stmt->bindParam(":Brand", $Brand, PDO::PARAM_STR);
            $stmt->bindParam(":Serial", $Serial, PDO::PARAM_STR);

            $stmt->execute();

            header("Location: https://www.servimizer.com/app/haneul/src/personal/masterlist.php");

            exit();
        } catch (PDOException $e) {
            echo "Error Mano: " . $e->getMessage();
        }

    } else {
        echo "
            <script>
                alert('¡Por favor, completa todos los campos!');
                window.location.href = 'https://www.servimizer.com/app/haneul/src/personal/masterlist.php';
            </script>
        ";
    }
}
?>
