
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

$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "log"; // ชื่อฐานข้อมูล
try {
    // สร้างการเชื่อมต่อใช้ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // คำสั่ง SQL เพื่อดึงข้อมูล label และ data จากตารางของคุณ
   $sql = "SELECT id,torque FROM chartlog ";
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
<?php
// Function to create columns in a MySQL database based on CSV headers
function createColumnsFromCSV($filename, $tablename, $servername, $username, $password, $dbname) {
    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Open CSV file
    $file = fopen($filename, "r");
    // Get CSV headers and remove the first line
    $headers = fgetcsv($file);
    fclose($file);

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

$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "WD"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "log"; // ชื่อฐานข้อมูล

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_POST["import"])){
$fileName = $_FILES["file"]["tmp_name"];

if($_FILES["file"]["size"] > 0){
    $file = fopen($fileName, "r");
  $firstRowRow = true; // Flag to skip the first row

while(($column = fgetcsv($file, 10006, ",")) !== FALSE){
    if($firstRowRow) {
        $firstRowRow = false;
        continue; // Skip the first row
    }
    // Your code to process each row, excluding the first row, goes here
    // Check if all required columns exist before inserting into the database
    if (isset($column[0]) && isset($column[1]) && isset($column[2]) && isset($column[3]) && isset($column[4]) && isset($column[5])) {
        // Your insertion code here
        $sqlInsert = "INSERT INTO chartlog (Torque, EncoderAngle, EncoderZ, Vacuum, ScrewEvent, MicrotecBusy, reset) VALUES ('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "', '" . $column[4] . "', '" . $column[5] . "', '" . (isset($column[6]) ? $column[6] : '') . "')";
        $result = $conn->exec($sqlInsert);
    }
}

}

}

if(isset($_POST["delete"])){
    $sqlDelete = "DELETE FROM chartlog";
    $result = $conn->exec($sqlDelete);

    if($result !== false){
        echo "All data deleted successfully";
    } else {
        echo "Problem in deleting data";
    }
}
?>
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // คำสั่งเชื่อมต่อฐานข้อมูล MySQL
    $servername = "127.0.0.1:3307"; // เช่น localhost
    $username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
    $password = "Western"; // รหัสผ่านฐานข้อมูล
    $dbname = "log"; // ชื่อฐานข้อมูล

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // คำสั่ง SQL เพื่อรีเซ็ตค่า ID เริ่มที่ 1
    $sql = "ALTER TABLE chartlog AUTO_INCREMENT = 1";

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
<canvas id="myCharttorque" width="30" height="10"></canvas>

<script>
    // Data for the chart
var chartData = {
    labels: <?php echo json_encode(array_slice($labels, 1)); ?>,
    datasets: [{
        label: 'Torque',
        data: <?php echo json_encode(array_slice($data, 1)); ?>,
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
                    //min: -15, // Set minimum value of y-axis
                    //max: -15.3, // Set maximum value of y-axis
                    //beginAtZero: false // Start y-axis at 0 (false) or not (true)
                }
            }]
        }
    }
};

    // Get the canvas element
    var ctx = document.getElementById('myCharttorque').getContext('2d');

    // Create the chart
    var myCharttorque = new Chart(ctx, chartConfig);

    // Add event listener to the chart canvas
    myCharttorque.canvas.addEventListener('click', function (evt) {
        // Get the clicked data points
        var activePoints = myCharttorque.getElementsAtEvent(evt);
        // Check if any data points are clicked
        if (activePoints.length > 0) {
            // Get the index of the dataset and the data point
            var datasetIndex = activePoints[0]._datasetIndex;
            var dataIndex = activePoints[0]._index;
            // Get the clicked data value
            var clickedData = chartData.datasets[datasetIndex].data[dataIndex];
            // Check if the clicked data value is greater than 0.5
            if (clickedData > 0.5) {
                // Open a URL in a new tab
                var destinationURL = 'fixBAD.html';
            } else {
                // Open another URL or navigate to another page
                var destinationURL = 'fixGood.html';
            }
            // Open the URL in a new tab
            window.open(destinationURL, '_blank');
        }
    });
</script>



            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
    </body>
</html>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           
                    
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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

