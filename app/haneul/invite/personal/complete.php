<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR - Agregar Personal</title>
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

        img {
            width: 100px;
            margin-bottom: 12px;
        }

        .landing-page, .registration-container, .confirmation-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 50px;
            border-radius: 10px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }
    </style>
</head>
<body onLoad="setTimeout('delayer()', 7000)">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand ml-4" href="#">QR - Registro completado</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!--<li class="nav-item">
                    <a class="nav-link" href="./index.php">Inicio <span class="sr-only">(current)</span></a>
                </li>-->
                <!--<li class="nav-item active">
                    <a class="nav-link" href="./masterlist.php">Equipos</a>
                </li>-->
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
                <div class="confirmation-page" style="display: ;">
            <img src="./check.png" alt="Success">
            <h1>¡Registro exitoso!</h1>
            <center><p>Gracias por registrarte. Su información ha sido guardada de manera segura.<br>
            En pocos segundos se descargará el código QR del equipo registrado. <br>
            <b>Por favor, no cierres la página.</p></center>             
            <input id="url2" name="url2" style="display: none;" value="https://quickchart.io/qr?text=<?= htmlspecialchars($_GET['i'])?>&caption=<?= ucfirst(htmlspecialchars($_GET['e']))?> <?= strtoupper(htmlspecialchars($_GET['b']))?> - <?= strtoupper(htmlspecialchars($_GET['s']))?>&size=450&margin=1&centerImageUrl=https://bit.ly/clar234&centerImageSizeRatio=0.6">

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
        let textlol = document.getElementById("url2").value;
        function delayer(){
            window.location.replace("https://www.servimizer.com");
            return false;
        };
        
        fetch(`${textlol}`)
                .then(response => response.blob())
                .then(blob => {
                    // Create a new FileReader innstance
                    const reader = new FileReader;
                
                    // Add a listener to handle successful reading of the blob
                    reader.addEventListener('load', () => {
                    const image = new Image;
                    
                    // Set the src attribute of the image to be the resulting data URL
                    // obtained after reading the content of the blob

                    
                    var link = document.createElement("a");
                    // If you don't know the name or want to use
                    // the webserver default set name = ''
                    link.setAttribute('download', 'QR_Code.png');
                    link.href = reader.result;
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    
                    });
                
                    // Start reading the content of the blob
                    // The result should be a base64 data URL
                    reader.readAsDataURL(blob);
                });
            
    </script>
    
</body>
</html>