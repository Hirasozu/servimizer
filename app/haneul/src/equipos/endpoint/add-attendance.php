<?php

include "../conn/conn.php";

date_default_timezone_set("America/Bogota");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["qr_code"])) {
        $qrCode = $_POST["qr_code"];

        $selectStmt = $conn->prepare(
            "SELECT tbl_user_id, Status, Serial FROM tbl_user WHERE generated_code = :generated_code"
        );

        $selectStmt->bindParam(":generated_code", $qrCode, PDO::PARAM_STR);

        if ($selectStmt->execute()) {
            $result = $selectStmt->fetch();

            if ($result !== false) {
                $studentID = $result["tbl_user_id"];

                $Status = $result["Status"];

                $Serial = $result["Serial"];

                $timeIn = date("Y-m-d H:i:s A");

                if ($Status == "Ingreso") {
                    $Status1 = "Retiro";
                } elseif ($Status == "Retiro") {
                    $Status1 = "Ingreso";
                }

                $Status_QR = $Status1;

                $Serial_QR = $Serial;
            } else {
                echo "No student found in QR Code";
            }
        } else {
            echo "Failed to execute the statement.";
        }

        try {
            $stmt = $conn->prepare(
                "INSERT INTO tbl_attendance (tbl_user_id, time_in, Status_QR, Serial_QR) VALUES (:tbl_user_id, :time_in, :Status_QR, :Serial_QR)"
            );

            $stmt->bindParam(":tbl_user_id", $studentID, PDO::PARAM_STR);

            $stmt->bindParam(":time_in", $timeIn, PDO::PARAM_STR);

            $stmt->bindParam(":Status_QR", $Status_QR, PDO::PARAM_STR);

            $stmt->bindParam(":Serial_QR", $Serial_QR, PDO::PARAM_STR);

            $stmt->execute();

            $stmt1 = $conn->prepare(
                "UPDATE tbl_user SET Status = :Status WHERE generated_code = :generated_code"
            );

            $stmt1->bindParam(":generated_code", $qrCode, PDO::PARAM_STR);

            $stmt1->bindParam(":Status", $Status1, PDO::PARAM_STR);

            $stmt1->execute();

            header(
                "Location: https://www.servimizer.com/app/haneul/src/equipos/index.php"
            );

            exit();
        } catch (PDOException $e) {
            /*echo "Error: " . $e->getMessage();*/

            header(
                "Location: https://www.servimizer.com/app/haneul/src/equipos/index.php"
            );
        }
    } else {
        echo "

            <script>

                alert('¡Por favor, completa todos los campos!');

                window.location.href = 'https://www.servimizer.com/app/haneul/src/equipos/index.php';

            </script>

        ";
    }
}
?>

