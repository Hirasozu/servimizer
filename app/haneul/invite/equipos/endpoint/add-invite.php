<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_name'], $_POST['Type_ID'], $_POST['N_ID'], $_POST['N_Phone'], $_POST['Company'], $_POST['email'], $_POST['Area'], $_POST['Equipment'], $_POST['Brand'], $_POST['Serial'], $_POST['Status'])) {
        $userName = $_POST['user_name'];
        $Type_ID = $_POST['Type_ID'];
        $N_ID = $_POST['N_ID'];
        $N_Phone = $_POST['N_Phone'];
        $Company = $_POST['Company'];
        $email = $_POST['email'];
        $Area = $_POST['Area'];
        $Equipment = $_POST['Equipment'];
        $Brand = $_POST['Brand'];
        $Serial = $_POST['Serial'];
        $Status = $_POST['Status'];
        $generatedCode = $_POST['generated_code'];

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_user (user_name, Type_ID, N_ID, N_Phone, Company, email, Area, Equipment, Brand, Serial, Status,  generated_code) VALUES (:user_name, :Type_ID, :N_ID, :N_Phone, :Company, :email, :Area, :Equipment, :Brand, :Serial, :Status, :generated_code)");
            
            $stmt->bindParam(":user_name", $userName, PDO::PARAM_STR); 
            $stmt->bindParam(":Type_ID", $Type_ID, PDO::PARAM_STR);
            $stmt->bindParam(":N_ID", $N_ID, PDO::PARAM_STR);
            $stmt->bindParam(":N_Phone", $N_Phone, PDO::PARAM_STR);
            $stmt->bindParam(":Company", $Company, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":Area", $Area, PDO::PARAM_STR);
            $stmt->bindParam(":Equipment", $Equipment, PDO::PARAM_STR);
            $stmt->bindParam(":Brand", $Brand, PDO::PARAM_STR);
            $stmt->bindParam(":Serial", $Serial, PDO::PARAM_STR);
            $stmt->bindParam(":Status", $Status, PDO::PARAM_STR);
            $stmt->bindParam(":generated_code", $generatedCode, PDO::PARAM_STR);

            $stmt->execute();
            header("Location: https://www.servimizer.com/app/haneul/invite/equipos/complete.php?i=$generatedCode&e=$Equipment&b=$Brand&s=$Serial");

            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

    } else {
        echo "
            <script>
                alert('¡Por favor, completa todos los campos!');
                window.location.href = 'https://www.servimizer.com/app/haneul/invite/equipos/error.php';
            </script>
        ";
    }
}
?>
