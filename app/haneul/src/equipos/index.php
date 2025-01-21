<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR - Ingreso Equipos</title>
    <link rel="icon" href="favicon.png" sizes="32x32" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
            background-blend-mode: multiply,multiply;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            /*height: 91.5vh;*/
            margin-top: 20px;
        }

        .attendance-container {
            height: 90%;
            width: 90%;
            border-radius: 20px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .attendance-container > div {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 10px;
            padding: 30px;
        }

        .attendance-container > div:last-child {
            width: 64%;
            margin-left: auto;
        }

        table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting_asc_disabled, table.dataTable thead > tr > th.sorting_desc_disabled, table.dataTable thead > tr > td.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting_asc_disabled, table.dataTable thead > tr > td.sorting_desc_disabled {
            text-align: center;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand ml-4" href="#">QR - Ingreso Equipos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./masterlist.php">Equipos</a>
                </li>
            </ul>
            <!--<ul class="navbar-nav ml-auto">
                <li class="nav-item mr-3">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>-->
        </div>
    </nav>

    <div class="main">
        
        <div class="attendance-container row">
            <div class="qr-container col-4">
                <div class="scanner-con">
                    <h5 class="text-center">Escanea el código QR aquí</h5>
                    <video id="interactive" class="viewport" width="100%">
                </div>
                

                <div class="qr-detected-container" style="display: none;">
                    <form id="form" name="form" action="./endpoint/add-attendance.php" method="POST">
                        <!--<h4 class="text-center" onclick="submit()">Student QR Detected!</h4>-->
                        <input type="hidden" id="detected-qr-code" name="qr_code">
                        <audio id="xyz" src="sound/success.wav" preload="auto"></audio>                                                       
                        <!--<button type="submit" class="btn btn-dark form-control"></button>-->
                    </form>
                </div>
            </div>

            <div class="attendance-list">
                <h4>Lista de los últimos equipos registrados</h4>
                <div class="table-container table-responsive" style="overflow-x: hidden;">
                    <table class="table text-center table-sm" id="attendanceTable" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col" style="display:none;">No. de Identificación</th>
                            <th scope="col">Equipo</th>
                            <th scope="col">Serial</th>
                            <th scope="col">Fecha registro</th>
                            <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                include ('./conn/conn.php');

                                $stmt = $conn->prepare("SELECT * FROM tbl_attendance LEFT JOIN tbl_user ON tbl_user.tbl_user_id = tbl_attendance.tbl_user_id ORDER BY time_in DESC" );
                                $stmt->execute();
                
                                $result = $stmt->fetchAll();
                
                                foreach ($result as $row) {
                                    $attendanceID = $row["tbl_attendance_id"];
                                    $userName = $row["user_name"];
                                    $Type_ID = $row["Type_ID"];
                                    $N_ID = $row["N_ID"];
                                    $N_Phone = $row["N_Phone"];
                                    $Company = $row["Company"];
                                    $email = $row["email"];
                                    $Area = $row["Area"];
                                    $Equipment = $row["Equipment"];
                                    $Brand = $row["Brand"];
                                    $Serial = $row["Serial"];
                                    $Status = $row["Status"];
                                    $timeIn = $row["time_in"];
                                    $Status_QR = $row["Status_QR"];
                                    $Serial_QR = $row["Serial_QR"];
                                ?>

                                <tr>
                                    <th scope="row"><?= $attendanceID ?></th>
                                    <td style="text-transform: capitalize;" ><?= $userName ?></td>
                                    <td style="display:none;"><?= $N_ID ?></td>
                                    <td style="text-transform: capitalize;"><?= $Equipment ?></td>
                                    <td style="text-transform:uppercase"><?= $Serial_QR ?></td>
                                    <td><?= $timeIn ?></td>
                                    <td>
                                    <?php if ($Status_QR == "Ingreso"){ ?>
                                        <div class="action-button" style="margin: -7px;">
                                            <button class="btn btn-danger" >Ingresa</button>
                                        </div>
                                    <?php } else {?>
                                        <div class="action-button" style="margin: -7px;">
                                            <button class="btn btn-success" >Sale</button>
                                        </div>
                                    <?php } ?>
                                    </td>
                                </tr>

                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>    

    <!-- instascan Js -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#attendanceTable').DataTable();            
        });
        
        new DataTable('#attendanceTable', {            
            language: {
                info: 'Mostrando _START_ al _END_ de un total de _TOTAL_ registros',
                infoEmpty: 'Mostrando un total de 0 registros',
                infoFiltered: '(filtrado de un total de _MAX_ registros)',
                lengthMenu: 'Mostrar _MENU_ registros',
                search: 'Buscar: ',
                zeroRecords: 'No se encontraron resultados',
                paginate: {
                    'first': 'Primero',
                    'last': 'Último',
                    'next': 'Siguiente',
                    'previous': 'Anterior'
                },
            },
            'order':[[5, 'desc']]                           
        });
        
        let scanner;

        function startScanner() {
            scanner = new Instascan.Scanner({ video: document.getElementById('interactive'),mirror: false });

            scanner.addListener('scan', function (content) {
                $("#detected-qr-code").val(content);
                console.log(content);
                scanner.stop();
                document.querySelector(".qr-detected-container").style.display = '';                
                document.querySelector(".scanner-con").style.display = 'none';  
                
			window.setTimeout('document.form.submit()', 500);
            document.getElementById('xyz').play();
		              
            });

            Instascan.Camera.getCameras()
                .then(function (cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error('No cameras found.');
                        alert('No cameras found.');
                    }
                })
                .catch(function (err) {
                    console.error('Camera access error:', err);
                    alert('Camera access error: ' + err);
                });
        }

        document.addEventListener('DOMContentLoaded', startScanner);

        function deleteAttendance(id) {
            if (confirm("Do you want to remove this attendance?")) {
                window.location = "./endpoint/delete-attendance.php?attendance=" + id;
            }
        }
    </script>
</body>
</html>