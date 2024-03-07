
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WESTERN DIGITAL</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="styleForaooy.css" re>
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    
   <style>
    #accordionSidebar {
        background: linear-gradient(to bottom, #5da7fb, #995dff, #fc1859);
    }
</style>
   <style>
    #Topbar {
        background: linear-gradient(to bottom, #363636,#000000);
    }
</style>

</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Western Digital <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>
<!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="datachartXML.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>datachartXML</span></a>
</li>
<!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="datachartLog.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>datachart LOG </span></a>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
        aria-expanded="true" aria-controls="collapseUtilities2">
        <i class="fas fa-fw fa-wrench"></i>
        <span>dataCSV</span>
    </a>
    <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities2"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header"> Vacuum</h6>
            <a class="collapse-item" href="BVCM_Screw_AdjustEncoder.php">BVCM_Screw_AdjustEncoder</a>
            <a class="collapse-item" href="BVCM_total_torque.php">BVCM_total_torque</a>
            <a class="collapse-item" href="PartPlaceEncoder.php">PartPlaceEncoder</a>
            <a class="collapse-item" href="PartPlaceAdjEncoder.php">PartPlaceAdjEncoder</a>
            <a class="collapse-item" href="Ramp AdjustEncoder.php">Ramp AdjustEncoder</a>
            <a class="collapse-item" href="Rampdistance.php">Rampdistance</a>
            <a class="collapse-item" href="Ramp_TorqueStep2.php">Ramp_TorqueStep2 </a>
            <a class="collapse-item" href="2.5RampPush.php">2.5RampPush</a>
            <a class="collapse-item" href="BUSD_PartPlacement.php">BUSD_PartPlacement</a>
            <a class="collapse-item" href="BUSD_PartPlacement_REF.php">BUSD_PartPlacement_REF </a>
        </div>
    </div>
</li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    
                    </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php
// Function to read the headers from a CSV file
function getCSVHeaders($filename) {
    $file = fopen($filename, "r");
    $headers = fgetcsv($file);
    fclose($file);
    return $headers;
}

// Function to create columns in a MySQL database based on CSV headers
function createColumnsFromCSV($filename, $tablename, $servername, $username, $password, $dbname) {
    // Connect to MySQL database using MySQLi
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get CSV headers
    $headers = getCSVHeaders($filename);

    // Generate SQL query to create columns
    $sql = "CREATE TABLE IF NOT EXISTS $tablename (";
    foreach ($headers as $header) {
        $sql .= "`$header` VARCHAR(255), ";
    }
    $sql = rtrim($sql, ", ") . ")";

    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "Table columns created successfully!";
    } else {
        echo "Error creating table columns: " . $conn->error;
    }

    // Close MySQL connection
    $conn->close();
}

// Database connection parameters
$servername = "127.0.0.1:3307";
$username = "WD";
$password = "Western";
$dbname = "xml";
// Check if the import button is clicked
if(isset($_POST["import"])){
    $fileName = $_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"] > 0){
        // Connect to the database
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Load XML file and parse it
            $xml = simplexml_load_file($fileName);

            // Get data from XML
            $torque = (string) $xml->Data->Torque;
            $encoderAngle = (string) $xml->Data->EncoderAngle;
            $encoderZ = (string) $xml->Data->EncoderZ;
            $vacuum = (string) $xml->Data->Vacuum;
            $screwEvent = (string) $xml->Data->ScrewEvent;
            $microtecBusy = (string) $xml->Data->MicrotecBusy;

            // Separate data by comma
            $torqueArray = explode(",", $torque);
            $encoderAngleArray = explode(",", $encoderAngle);
            $encoderZArray = explode(",", $encoderZ);
            $vacuumArray = explode(",", $vacuum);
            $screwEventArray = explode(",", $screwEvent);
            $microtecBusyArray = explode(",", $microtecBusy);

            // Check if data lengths are consistent
            $length = count($torqueArray);
            if (count($encoderAngleArray) == $length && count($encoderZArray) == $length && count($vacuumArray) == $length && count($screwEventArray) == $length && count($microtecBusyArray) == $length) {
                // Insert data into database
                for ($i = 0; $i < $length; $i++) {
                    $sql = "INSERT INTO chartxml (torque, encoderangle, encoderz, vacuum, screwevent, microtecbusy) 
                            VALUES (:torque, :encoderangle, :encoderz, :vacuum, :screwevent, :microtecbusy)";
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':torque', $torqueArray[$i]);
                    $stmt->bindParam(':encoderangle', $encoderAngleArray[$i]);
                    $stmt->bindParam(':encoderz', $encoderZArray[$i]);
                    $stmt->bindParam(':vacuum', $vacuumArray[$i]);
                    $stmt->bindParam(':screwevent', $screwEventArray[$i]);
                    $stmt->bindParam(':microtecbusy', $microtecBusyArray[$i]);
                    $stmt->execute();
                }
            } else {
                echo "ข้อมูลไม่สม่ำเสมอ";
            }
        } catch(PDOException $e) {
            echo "เกิดข้อผิดพลาด: " . $e->getMessage();
        }
    }
}

// Check if the delete button is clicked
if(isset($_POST["delete"])){
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete all data from the 'torque' table
        $sqlDelete = "DELETE FROM chartxml";
        $result = $conn->exec($sqlDelete);

        if($result !== false){
            echo "All data deleted successfully";
        } else {
            echo "Problem in deleting data";
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
<?php

$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "xml"; // ชื่อฐานข้อมูล
try {
    // สร้างการเชื่อมต่อใช้ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // คำสั่ง SQL เพื่อดึงข้อมูล label และ data จากตารางของคุณ
   $sql = "SELECT id,torque FROM chartxml ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // ดึงข้อมูลเป็น array
    $chartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // สร้าง array ของ labels และ data
    $labels = array();
    $data = array();
    foreach ($chartData as $row) {
         $labels[] = $row['id'];
        $data[] = $row['torque'];
    }

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <title>CSV Import</title>
</head>
<body>
  <form class="form-horizontal" action="" method="post" name="uploadcsv" enctype="multipart/form-data">
    <div>
        <label>Choose Log File</label>
        <input type="file" name="file" accept=".csv">
        <button type="submit" name="import" class="delete-button" style="background: linear-gradient(45deg, #5da7fb, #995dff, #fc1859); color: #ffffff; border-radius: 20px; padding: 10px 20px; border: none;">Import</button>

         <!-- Delete All Data Button -->
        <span style="margin-right: 10px;"></span>
        <button type="submit" name="delete" class="delete-button" style="background: linear-gradient(45deg, #5da7fb, #995dff, #fc1859); color: #ffffff; border-radius: 20px; padding: 10px 20px; border: none;"><i class="fas fa-download fa-sm text-white-50"></i> Delete All Data</button>

       
       
     <!-- Reset ID Button -->
        <span style="margin-right: 10px;"></span>
        <button type="submit" name="reset_id" class="delete-button" style="background: linear-gradient(45deg, #5da7fb, #995dff, #fc1859); color: #ffffff; border-radius: 20px; padding: 10px 20px; border: none;">Refresh</button>
 
 <!-- Refresh Button -->
        
</div>
</form>
</body>
</html>
<!DOCTYPE html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // คำสั่งเชื่อมต่อฐานข้อมูล MySQL
    $servername = "127.0.0.1:3307"; // เช่น localhost
    $username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
    $password = "Western"; // รหัสผ่านฐานข้อมูล
    $dbname = "xml"; // ชื่อฐานข้อมูล

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // คำสั่ง SQL เพื่อรีเซ็ตค่า ID เริ่มที่ 1
    $sql = "ALTER TABLE chartxml AUTO_INCREMENT = 1";

    // ทำการเรียกคำสั่ง SQL
    if ($conn->query($sql) === TRUE) {
        // หากสำเร็จ
    } else {
        // หากมีข้อผิดพลาด
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
?>

</body>
</html>

        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChartJs</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
</head>
<body>
    <!-- First Chart -->
    <canvas id="myCharttorque" width="20" height="5"></canvas>

    <script>
        // Data for the chart
        var chartData = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Torque ',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        };

     // Chart configuration
var chartConfig = {
    type: 'line',
    data: chartData,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    //min: -15, // ตั้งค่าขั้นต่ำของแกน y
                    //max: -15.3, // ตั้งค่าขั้นสูงสุดของแกน y
                    //beginAtZero: false // เริ่มแกน y ที่ 0 (false) หรือไม่ (true)
                }
            }]
        }
    }
};


        // Get the canvas element
        var ctx = document.getElementById('myCharttorque').getContext('2d');

        // Create the chart
        var myCharttorque = new Chart(ctx, chartConfig);

        // เพิ่ม event listener ให้กับ canvas ของกราฟ
myCharttorque.canvas.addEventListener('click', function (evt) {
    // ดึงข้อมูลจากจุดที่คลิก
    var activePoints = myCharttorque.getElementsAtEvent(evt);
    // ตรวจสอบว่ามีจุดที่ถูกคลิกหรือไม่
    if (activePoints.length > 0) {
        // หา index ของ dataset และ data ที่ถูกคลิก
        var datasetIndex = activePoints[0]._datasetIndex;
        var dataIndex = activePoints[0]._index;
        // ดึงค่า data ที่ถูกคลิก
        var clickedData = chartData.datasets[datasetIndex].data[dataIndex];
        // ตรวจสอบค่า data ว่ามีค่ามากกว่า 0.5 หรือไม่
        if (clickedData > 0.5) {
            // ลิงก์ไปยัง URL ที่ต้องการเปิดในแท็บใหม่
           var destinationURL = 'fixBAD.html';
        } else {
            // ลิงก์ไปยัง URL อื่นๆ หรือหน้าเว็บไซต์
            var destinationURL = 'fixGood.html';
        }
        // เปิดลิงก์ในแท็บใหม่
        window.open(destinationURL, '_blank');
    }
});

    </script>
</body>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

    </body>
</html>


