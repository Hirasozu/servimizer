<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR - Ingreso Personal</title>
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

        .student-container {
            height: 90%;
            width: 90%;
            border-radius: 20px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .student-container > div {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 10px;
            padding: 30px;
            height: 100%;
        }

        .title {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting_asc_disabled, table.dataTable thead > tr > th.sorting_desc_disabled, table.dataTable thead > tr > td.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting_asc_disabled, table.dataTable thead > tr > td.sorting_desc_disabled {
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand ml-4" href="#">QR - Ingreso Personal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./masterlist.php">Personal</a>
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
        
        <div class="student-container">
            <div class="student-list">
                <div class="title">
                    <h4>Lista de equipos registrados</h4>
                    <!--<button class="btn btn-dark" data-toggle="modal" data-target="#addStudentModal">Agregar Equipo</button>-->
                </div>
                <hr>
                <div class="table-container table-responsive" style="overflow-x: hidden;">
                    <table class="table text-center table-sm" id="studentTable" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">No. de Identificación</th>
                                <th scope="col" >No. de Celular</th>
                                <th scope="col" >Empresa</th>
                                <th scope="col" style="display:none;">Correo</th>
                                <th scope="col">Área</th>
                                <th scope="col" style="display:none;">Equipo</th>
                                <th scope="col" style="display:none;">Marca</th>
                                <th scope="col" style="display:none;">Serial</th>
                                <th scope="col">Código QR</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                include ('./conn/conn.php');

                                $stmt = $conn->prepare("SELECT * FROM tbl_user");
                                $stmt->execute();
                
                                $result = $stmt->fetchAll();
                
                                foreach ($result as $row) {
                                    $studentID = $row["tbl_user_id"];
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
                                    $qrCode = $row["generated_code"];
                                ?>

                                <tr>
                                    <th scope="row" id="studentID-<?= $studentID ?>"><?= $studentID ?></th>
                                    <td id="userName-<?= $studentID ?>" style="text-transform: capitalize;" ><?= $userName ?></td>
                                    <td id="N_ID-<?= $studentID ?>"><?= $N_ID ?></td>
                                    <td id="N_Phone-<?= $studentID ?>" ><?= $N_Phone ?></td>
                                    <td id="Company-<?= $studentID ?>" ><?= $Company ?></td>
                                    <td id="email-<?= $studentID ?>" style="display:none;" ><?= $email ?></td>
                                    <td id="Area-<?= $studentID ?>"style="text-transform: capitalize;" ><?= $Area ?></td>
                                    <td id="Equipment-<?= $studentID ?>" style="text-transform: capitalize; display:none;"  ><?= $Equipment ?></td>
                                    <td id="Brand-<?= $studentID ?>" style="text-transform:uppercase; display:none;"><?= $Brand ?></td>
                                    <td id="Serial-<?= $studentID ?>" style="text-transform:uppercase; display:none;"><?= $Serial ?></td>
                                    <td>
                                        <div class="action-button">
                                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#qrCodeModal<?= $studentID ?>"><img src="https://cdn-icons-png.flaticon.com/512/1341/1341632.png" alt="" width="16"></button>

                                            <!-- QR Modal -->
                                            <div class="modal fade" id="qrCodeModal<?= $studentID ?>" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Código QR de <?= $userName ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="https://quickchart.io/qr?text=<?= $qrCode ?>&caption=<?= ucfirst($Equipment) ?> <?= strtoupper($Brand) ?> <?= strtoupper($Serial) ?>&captionFontFamily=mono&captionFontSiz&captionFontSize=15&size=450&margin=1&centerImageUrl=https://bit.ly/clar234&centerImageSizeRatio=0.6" alt="" width="300">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-info" disabled>Enviar por correo</button>
                                                        <button type="button" class="btn btn-success" disabled>Enviar por Whatsapp</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--<button class="btn btn-secondary btn-sm" onclick="updateStudent(<?= $studentID ?>)">&#128393;</button>-->
                                            <!--<button class="btn btn-warning btn-sm" onclick="copyStudent(<?= $studentID ?>)"><img src="https://cdn-icons-png.flaticon.com/512/54/54702.png" alt="" width="16"></button>-->
                                            <!--<button class="btn btn-danger btn-sm" onclick="deleteStudent(<?= $studentID ?>)">&#10006;</button>-->
                                        </div>
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

    <!-- Add Modal -->
    <div class="modal fade" id="addStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addStudent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudent">Agregar Equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/add-user.php" method="POST">
                        <div class="form-group">
                            <label for="userName">Nombre completo:</label>
                            <input type="text" class="form-control" id="userName" name="user_name" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="Type_ID">Tipo de Identificación:</label>
                            <select name="Type_ID" id="Type_ID" class="form-control">
                                <option disabled selected value></option>
                                <option value="CC">CC</option>
                                <option value="TI">TI</option>
                                <option value="PP">PP</option>
                                <option value="CE">CE</option>
                            </select>                            
                        </div>
                        <div class="form-group">
                            <label for="N_ID">Número de Identificación:</label>
                            <input type="text" class="form-control" id="N_ID" name="N_ID" style="text-transform:uppercase" >
                        </div>
                        <div class="form-group">
                            <label for="N_Phone">Número de celular: <i style="font-size: 0.8rem;">(Preferiblemente corporativo)</i></label>
                            <input type="text" class="form-control" id="N_Phone" name="N_Phone" style="text-transform:uppercase" >
                        </div>
                        <div class="form-group">
                            <label for="Company">Empresa:</label>
                            <input type="text" class="form-control" id="Company" name="Company" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="email">Correo:</label>
                            <input type="email" class="form-control" id="email" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="Area">Área:</label>
                            <input type="text" class="form-control" id="Area" name="Area" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="Equipment">Equipo: <i style="font-size: 0.8rem;">(Ejemplo: Portátil, Pinza, Disco duro externo, etc.)</i></label>
                            <input type="text" class="form-control" id="Equipment" name="Equipment" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="Brand">Marca: <i style="font-size: 0.8rem;">(Ejemplo: DELL, FLUKE, HP, etc.)</i></label>
                            <input type="text" class="form-control" id="Brand" name="Brand" style="text-transform:uppercase" >
                        </div>
                        <div class="form-group">
                            <label for="Serial">Serial: <i style="font-size: 0.8rem;">(Últimos 5 dígitos 7RA7KDM<b>258NK</b>)</i></label>
                            <input type="text" class="form-control" id="Serial" name="Serial" style="text-transform:uppercase" maxlength="5" >
                        </div>
                        <div class="form-group">
                            <label for="Status">Estado:</label>
                            <select name="Status" id="Status" class="form-control">
                                <option disabled selected value></option>
                                <option value="Ingreso">Ingreso</option>
                                <option value="Retiro">Retiro</option>
                            </select>                            
                        </div>
                        <button type="button"  class="btn btn-secondary form-control qr-generator" onclick="generateQrCode()">Generar código QR</button>

                        <div class="qr-con text-center" style="display: none;">
                            <input type="hidden" class="form-control" id="generatedCode" name="generated_code">
                            <p>Aquí está tu código QR.</p>
                            <img class="mb-4" src="" id="qrImg" alt="">
                        </div>
                        <div class="modal-footer modal-close" style="display: none;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    

    <!-- Update Modal -->
    <div class="modal fade" id="updateStudentModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateStudent" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStudent">Actualizar equipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./endpoint/update-user.php" method="POST">
                        <input type="hidden" class="form-control" id="updateStudentId" name="tbl_user_id">
                        <div class="form-group">
                            <label for="updateuserName">Nombre completo:</label>
                            <input type="text" class="form-control" id="updateuserName" name="user_name" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="updateN_Phone">Número de celular:</label>
                            <input type="text" class="form-control" id="updateN_Phone" name="N_Phone" style="text-transform:uppercase" >
                        </div>
                        <div class="form-group">
                            <label for="updateCompany">Empresa:</label>
                            <input type="text" class="form-control" id="updateCompany" name="Company" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="updateemail">Correo:</label>
                            <input type="text" class="form-control" id="updateemail" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="updateArea">Área:</label>
                            <input type="text" class="form-control" id="updateArea" name="Area" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="updateEquipment">Equipo:</label>
                            <input type="text" class="form-control" id="updateEquipment" name="Equipment" style="text-transform: capitalize;" >
                        </div>
                        <div class="form-group">
                            <label for="updateBrand">Marca:</label>
                            <input type="text" class="form-control" id="updateBrand" name="Brand" style="text-transform:uppercase" >
                        </div>
                        <div class="form-group">
                            <label for="updateSerial">Serial:</label>
                            <input type="text" class="form-control" id="updateSerial" name="Serial" style="text-transform:uppercase" maxlength="5" >
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
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

    <script>  
                
        $(document).ready( function () {
            $('#studentTable').DataTable();
        });

        new DataTable('#studentTable', {
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
            }
        });

        function updateStudent(id) {
            $("#updateStudentModal").modal("show");

            let updateStudentId = $("#studentID-" + id).text();
            let updateuserName = $("#userName-" + id).text();
            let updateN_Phone = $("#N_Phone-" + id).text();
            let updateCompany = $("#Company-" + id).text();
            let updateemail = $("#email-" + id).text();
            let updateArea = $("#Area-" + id).text();
            let updateEquipment = $("#Equipment-" + id).text();
            let updateBrand = $("#Brand-" + id).text();
            let updateSerial = $("#Serial-" + id).text();

            $("#updateStudentId").val(updateStudentId);
            $("#updateuserName").val(updateuserName);
            $("#updateN_Phone").val(updateN_Phone);
            $("#updateCompany").val(updateCompany);
            $("#updateemail").val(updateemail);
            $("#updateArea").val(updateArea);
            $("#updateEquipment").val(updateEquipment);
            $("#updateBrand").val(updateBrand);
            $("#updateSerial").val(updateSerial);
        }

        function deleteStudent(id) {
            if (confirm("Do you want to delete this student?")) {
                window.location = "./endpoint/delete-user.php?student=" + id;
            }
        }

        function generateRandomCode(length) {
            const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            let randomString = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                randomString += characters.charAt(randomIndex);
            }

            return randomString;
        }

        function generateQrCode() {
            const qrImg = document.getElementById('qrImg');

            let text = generateRandomCode(10);
            $("#generatedCode").val(text);

            if (text === "") {
                alert("Please enter text to generate a QR code.");
                return;
            } else {
                let text1 = document.getElementById("Equipment").value;
                let text2 = document.getElementById("Brand").value;
                let text3 = document.getElementById("Serial").value;
                const apiUrl = `https://quickchart.io/qr?text=${encodeURIComponent(text)}&caption=${text1} ${text2} ${text3}&size=450&margin=1&centerImageUrl=https://bit.ly/clar234&centerImageSizeRatio=0.6`;

                qrImg.src = apiUrl;
                document.getElementById('userName').style.pointerEvents = 'none';
                document.getElementById('Type_ID').style.pointerEvents = 'none';
                document.getElementById('N_ID').style.pointerEvents = 'none';
                document.getElementById('N_Phone').style.pointerEvents = 'none';
                document.getElementById('Company').style.pointerEvents = 'none';
                document.getElementById('email').style.pointerEvents = 'none';
                document.getElementById('Area').style.pointerEvents = 'none';
                document.getElementById('Equipment').style.pointerEvents = 'none';
                document.getElementById('Brand').style.pointerEvents = 'none';
                document.getElementById('Serial').style.pointerEvents = 'none';
                document.getElementById('Status').style.pointerEvents = 'none';
                document.querySelector('.modal-close').style.display = '';
                document.querySelector('.qr-con').style.display = '';
                document.querySelector('.qr-generator').style.display = 'none';
            }
        }

        function save2() {
            window.open(canvas.toDataURL('image/png'));
            var gh = canvas.toDataURL('png');

            var a  = document.createElement('a');
            a.href = gh;
            a.download = 'image.png';

            a.click()
        }
    </script>
    
</body>
</html>