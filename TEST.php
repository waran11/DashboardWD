
<?php

$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "rt_201561"; // ชื่อฐานข้อมูล

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

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
     <!-- สีแถบข้าง -->
   <style>
     @keyframes changeBackground {
            0% { background: #fc1859; }
            33% { background: #995dff; }
            66% { background: #6666ff; }
            100% { background: #fc1859; }
        }

        #accordionSidebar {
            animation: changeBackground 5s infinite; /* เปลี่ยนสีทุกๆ 5 วินาที */
        }
        <!-- สีแถบข้าง -->
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
    <div class="sidebar-brand-icon" style="margin-top: 5px; margin-bottom: 5px;">
        <img src="trace.svg" alt="Western Digital Logo" style="max-width: 100%; height: auto;">
    </div>
</a>


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
<!-- Nav Item - Charts -->
    <li class="nav-item">
    <a class="nav-link" href="TEST.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>TEST </span></a>
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
         <div style="margin-top: 10px; ">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"> DASHBOARD 9342B</h1>
</div>


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
    // Connect to MySQL database
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
$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "WD"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "rt_201561"; // ชื่อฐานข้อมูล

// Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["import"])){
    $fileName = $_FILES["file"]["tmp_name"];
    $rt_selected = $_POST["rt_selected"];

    if($_FILES["file"]["size"] > 0){
        $file = fopen($fileName, "r");
        $firstRow = true; // Flag to skip the first row

        while(($column = fgetcsv($file, 10006, ",")) !== FALSE){
            if($firstRow) {
                $firstRow = false;
                continue; // Skip the first row
            }
            // Check if column 7 has the value selected by the user
          if ($column[7] == $rt_selected) {
    // Your insertion code here
    $PartPlaceEncoder =         $column[33];
    $PartPlaceAdjEncoder =      $column[34];
    $Timestamp =                $column[9];
    $rt_201561 =                $column[7];
    $Rampdistance =             $column[38];
    $Cal_Ramp =                 $column[28];
    $BUSD_PartPlacement  =      $column[67];
    $BUSD_PartPlacement_REF =   $column[68];
    
    // Execute SQL query to insert data into the database using MySQLi
    $sqlInsert = "INSERT INTO rt201561 (PartPlaceEncoder, PartPlaceAdjEncoder, Timestamp, rt_201561,Rampdistance, Cal_Ramp,BUSD_PartPlacement, BUSD_PartPlacement_REF  ) VALUES (?, ?, ?, ?,?, ?, ?, ?)";
    $stmt = $conn->prepare($sqlInsert);
$stmt->bind_param("ssssssss", $PartPlaceEncoder, $PartPlaceAdjEncoder, $Timestamp, $rt_201561, $Rampdistance, $Cal_Ramp, $BUSD_PartPlacement, $BUSD_PartPlacement_REF);
    $stmt->execute();
}

        }
        fclose($file); // Close the file after reading
    }
}

if(isset($_POST["delete"])){
    $sqlDelete = "DELETE FROM rt201561";
    $result = $conn->query($sqlDelete);

    if($result !== false){
        // Reset the auto-increment value for the 'ID' column to 1
        $sqlResetAutoIncrement = "ALTER TABLE rt201561 AUTO_INCREMENT = 1";
        $conn->query($sqlResetAutoIncrement);

    
    } else {
        echo "Problem in deleting data";
    }
}


// Close MySQL connection
$conn->close();
?>
<form method="post" enctype="multipart/form-data">
    <label for="file">Choose File:</label>
    <input type="file" name="file" id="file">
    <select name="rt_selected">
        <option value="RT-201561">LN2BVCM</option>
        <option value="RT-201562">LN2IDCS</option>
        <option value="RT-201603">LN2MI1</option>
        <option value="RT-201611">LN2CLAMP</option>
        <option value="RT-201573">LN2GCSI</option>
        <option value="RT-201613">LN2GCSI</option>
        <option value="RT-201574">LN2CAP </option>
        <option value="RT-201616">LN2IM3 </option>
        <option value="RT-201502">LN2AWB</option>
        <option value="RT-201619">LN2API </option>
        <option value="RT-201622">LN2VERIFY </option>
        <option value="RT-201584">LN2RAMP</option>
        <option value="RT-201625">LN2RAMP </option>
        <option value="RT-201627">LN2CAPHSAI</option>
        <option value="RT-201589">LN2TVCM</option>
        <option value="RT-201629">LN2TFGD </option>
        <option value="RT-201588">LN2ODCS </option>
        <option value="RT-201632">LN2RFI </option>
        <option value="RT-201634">LN2WAP </option>
        <option value="RT-201419">LN2AUTOVI </option>
        <option value="RT-201594">LN2ATC</option>
        <option value="RT-201638">LN2STC1 </option>
        <option value="RT-201637">LN2STC3</option>

    </select>
  <button type="submit" name="import" 
    onclick="this.form.submit(); setTimeout(function(){ window.location.reload(); }, 1000);"
    style="background: linear-gradient(45deg, #5da7fb, #995dff, #fc1859); color: #ffffff; border-radius: 20px; padding: 10px 20px; border: none; margin-left: 10px;">Import</button>

    <button type="submit" name="delete" onclick="window.location.href=window.location.href"
    style="background: linear-gradient(45deg, #5da7fb, #995dff, #fc1859); color: #ffffff; border-radius: 20px; padding: 10px 20px; border: none; margin-left: 10px;">Reset</button>

  <!-- Refresh Button -->
        <span style="margin-right: 10px;"></span>
        <button type="submit" name="reset_id" class="delete-button" 
        style="background: linear-gradient(45deg, #5da7fb, #995dff, #fc1859); color: #ffffff; border-radius: 20px; padding: 10px 20px; border: none;">Refresh</button>
        
    
    <br>
  <div style="margin-top: 1px;">
    <span style="margin-right: 705px;"></span>
    Start Date: <input type="datetime-local" id="start" name="start" placeholder="Start Date">
    End Date: <input type="datetime-local" id="end" name="end" placeholder="End Date">
  </div>
</div>

    <?php

$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "rt_201561"; // ชื่อฐานข้อมูล

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

</form>
<br>
<div class="container">
       <div class="row align-items-stretch justify-content-between">
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                MACHINE
                            </div>
                            <?php
                            $rt_201561 = [
    "RT-201561" => "LN2BVCM",
    "RT-201562" => "LN2IDCS",
    "RT-201603" => "LN2MI1",
    "RT-201611" => "LN2CLAMP",
    "RT-201573" => "LN2GCSI",
    "RT-201613" => "LN2GCSI",
    "RT-201574" => "LN2CAP",
    "RT-201616" => "LN2IM3",
    "RT-201502" => "LN2AWB",
    "RT-201619" => "LN2API",
    "RT-201622" => "LN2VERIFY",
    "RT-201584" => "LN2RAMP",
    "RT-201625" => "LN2RAMP",
    "RT-201627" => "LN2CAPHSAI",
    "RT-201589" => "LN2TVCM",
    "RT-201629" => "LN2TFGD",
    "RT-201588" => "LN2ODCS",
    "RT-201632" => "LN2RFI",
    "RT-201634" => "LN2WAP",
    "RT-201419" => "LN2AUTOVI",
    "RT-201594" => "LN2ATC",
    "RT-201638" => "LN2STC1",
    "RT-201637" => "LN2STC3"
];

$sql = "SELECT rt_201561 FROM rt201561 ORDER BY ID DESC";
$query = $conn->prepare($sql);
$query->execute();
$fetch = $query->fetch();

if ($fetch) {
    $machine = $fetch['rt_201561'];
    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . ($rt_201561[$machine] ?? "N/A") . '</div>';
} else {
    echo '<div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>';
}
                            ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    <div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                TOTAL DATA
                            </div>
                            <?php
                            $sql = "SELECT COUNT(*) AS total FROM rt201561";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            $fetch = $query->fetch();

                            // Check if there are any rows returned by the query
                            if ($fetch && isset($fetch['total'])) {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['total'] . '</div>';
                            } else {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">0</div>';
                            }
                            ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


      <div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                PartPlace Encoder
                            </div>
                            <?php
                            $sql = "SELECT PartPlaceEncoder FROM rt201561 WHERE PartPlaceEncoder <> 0 ORDER BY ID DESC";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            $fetch = $query->fetch();

                            // Check if there are any rows returned by the query
                            if ($fetch) {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['PartPlaceEncoder'] . '</div>';
                            } else {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>';
                            }
                            ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                PartPlace AdjEncoder
                            </div>
                            <?php
                            $sql = "SELECT PartPlaceAdjEncoder FROM rt201561 WHERE PartPlaceAdjEncoder <> 0 ORDER BY ID DESC";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            $fetch = $query->fetch();

                            // Check if there are any rows returned by the query
                            if ($fetch) {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['PartPlaceAdjEncoder'] . '</div>';
                            } else {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800 text-danger">N/A</div>';
                            }
                            ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
<!-- ใบที่ 3 -->
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Ramp distance
                    </div>
                    <?php
                    $sql = "SELECT Rampdistance FROM rt201561 WHERE Rampdistance <> 0 ORDER BY ID DESC";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $fetch = $query->fetch();
                    if ($fetch && isset($fetch['Rampdistance'])) {
                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['Rampdistance'] . '</div>';
                    } else {
                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>'; // Or any default value you want to display
                    }
                    ?>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>


        
<!-- ใบที่ 3 -->
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Cal Ramp
                    </div>
                    <?php
                    $sql = "SELECT Cal_Ramp FROM rt201561 WHERE Cal_Ramp <> 0 ORDER BY ID DESC";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $fetch = $query->fetch();
                    if ($fetch && isset($fetch['Cal_Ramp'])) {
                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['Cal_Ramp'] . '</div>';
                    } else {
                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">N/A</div>'; // Or any default value you want to display
                    }
                    ?>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ใบที่ 3 -->
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        BUSD PartPlacement
                    </div>
                    <?php
                    $sql = "SELECT BUSD_PartPlacement FROM rt201561 WHERE BUSD_PartPlacement <> 0 ORDER BY ID DESC";
                    $query = $conn->prepare($sql);
                    $query->execute();
                    $fetch = $query->fetch();
                    
                   if ($fetch && isset($fetch['Cal_Ramp'])) {
                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['BUSD_PartPlacement'] . '</div>';
                    } else {
                        echo '<div class="h5 mb-0 font-weight-bold text-gray-800">0</div>'; // Or any default value you want to display
                    }
                    ?>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

    

  
    
        <div class="col-xl-3 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                PartPlace AdjEncoder
                            </div>
                            <?php
                            $sql = "SELECT BUSD_PartPlacement_REF FROM rt201561 WHERE BUSD_PartPlacement_REF <> 0 ORDER BY ID DESC";
                            $query = $conn->prepare($sql);
                            $query->execute();
                            $fetch = $query->fetch();

                            // Check if there are any rows returned by the query
                            if ($fetch) {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800">' . $fetch['BUSD_PartPlacement_REF'] . '</div>';
                            } else {
                                echo '<div class="h5 mb-0 font-weight-bold text-gray-800 text-danger">0</div>';
                            }
                            ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>


    
    

                <!-- Begin Page Content -->
                <div class="container-fluid">







<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // คำสั่งเชื่อมต่อฐานข้อมูล MySQL
    $servername = "127.0.0.1:3307"; // เช่น localhost
    $username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
    $password = "Western"; // รหัสผ่านฐานข้อมูล
    $dbname = "csv"; // ชื่อฐานข้อมูล

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // คำสั่ง SQL เพื่อรีเซ็ตค่า ID เริ่มที่ 1
    $sql = "ALTER TABLE csv AUTO_INCREMENT = 1";

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
<?php
$servername = "127.0.0.1:3307"; // เช่น localhost
$username = "wd"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "Western"; // รหัสผ่านฐานข้อมูล
$dbname = "rt_201561"; // ชื่อฐานข้อมูล

try {
    // สร้างการเชื่อมต่อใช้ PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT Timestamp, PartPlaceAdjEncoder, PartPlaceEncoder,rt_201561,Rampdistance,Cal_Ramp,BUSD_PartPlacement,BUSD_PartPlacement_REF
        FROM rt201561
        ORDER BY Timestamp ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();



    // ดึงข้อมูลเป็น array
    $chartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Function to compare timestamps
    function compareTimestamps($a, $b) {
        return strtotime($a['Timestamp']) - strtotime($b['Timestamp']);
    }

    // Sort chartData based on timestamp
    usort($chartData, 'compareTimestamps');

    // Initialize arrays
    $labels = array();
    $data = array();

    // Populate arrays
    foreach ($chartData as $row) {
        $labels[] = date("Y-m-d H:i:s", strtotime($row['Timestamp']));
        $data[] = $row['PartPlaceEncoder'];
        $data2[] = $row['PartPlaceAdjEncoder'];
        $data3[] = $row['Rampdistance'];
        $data4[] = $row['Cal_Ramp'];
        $data5[] = $row['BUSD_PartPlacement'];
        $data6[] = $row['BUSD_PartPlacement_REF'];
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChartJs</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-zoom/0.7.7/chartjs-plugin-zoom.min.js"></script>
    <style>
        .chart-row {
            display: flex;
            margin-bottom: 20px; /* Add some margin between rows */
        }

        .chart-container {
            width: 50%; /* Each chart container takes 50% of the row */
            margin-right: 20px; /* Add some margin between charts */
        }

        .chart-container canvas {
            width: 100%; /* Make the canvas take full width of its container */
        }
    </style>
</head>

<body>
    <!-- First Row of Charts -->
    <div class="chart-row">
        <!-- First Chart -->
        <div class="chart-container">
            <canvas id="myChart1" width="400" height="200"></canvas>
        </div>
        <!-- Second Chart -->
        <div class="chart-container">
            <canvas id="myChart2" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Second Row of Charts -->
    <div class="chart-row">
        <!-- Third Chart -->
        <div class="chart-container">
            <canvas id="myChart3" width="400" height="200"></canvas>
        </div>
        <!-- Fourth Chart -->
        <div class="chart-container">
            <canvas id="myChart4" width="400" height="200"></canvas>
        </div>
    </div>

    
    <!-- Third Row of Charts -->
    <div class="chart-row">
        <!-- Third Chart -->
        <div class="chart-container">
            <canvas id="myChart5" width="400" height="200"></canvas>
        </div>
        <!-- Fourth Chart -->
        <div class="chart-container">
            <canvas id="myChart6" width="400" height="200"></canvas>
        </div>
    </div>

    <script>
        // Data for the charts
        var chartData1 = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'PartPlaceEncoder',
                data: <?php echo json_encode($data); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                pointBackgroundColor: 'rgba(128, 128, 128, 1)',
                pointHoverBackgroundColor: 'rgba(255, 0, 0, 1)'
            }]
        };
        var chartConfig1 = {
            type: 'line',
            data: chartData1,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {}
                    }]
                },
                plugins: {
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'xy'
                        },
                        zoom: {
                            wheel: {
                                enabled: true,
                                sensitivity: 0.9
                            },
                            pinch: {
                                enabled: true,
                                sensitivity: 0.9
                            },
                            mode: 'y'
                        }
                    }
                }
            }
        };

        // Get the canvas element
        var ctx1 = document.getElementById('myChart1').getContext('2d');

        // Create the chart
        var myChart1 = new Chart(ctx1, chartConfig1);

        // Data for the second chart
        var chartData2 = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'PartPlace AdjEncoder	',
                data: <?php echo json_encode($data2); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                pointBackgroundColor: 'rgba(128, 128, 128, 1)',
                pointHoverBackgroundColor: 'rgba(0, 0, 255, 1)'
            }]
        };

        var chartConfig2 = {
            type: 'line',
            data: chartData2,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {}
                    }]
                },
                plugins: {
                    zoom: {
                        pan: {
                            enabled: true,
                            mode: 'xy'
                        },
                        zoom: {
                            wheel: {
                                enabled: true,
                                sensitivity: 0.9
                            },
                            pinch: {
                                enabled: true,
                                sensitivity: 0.9
                            },
                            mode: 'y'
                        }
                    }
                }
            }
        };

        // Get the canvas element
        var ctx2 = document.getElementById('myChart2').getContext('2d');

        // Create the chart
        var myChart2 = new Chart(ctx2, chartConfig2);


// Data for the third chart
var chartData3 = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        label: 'Ramp distance',
        data: <?php echo json_encode($data3); ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
        pointBackgroundColor: 'rgba(128, 128, 128, 1)',
        pointHoverBackgroundColor: 'rgba(0, 255, 0, 1)'
    }]
};

var chartConfig3 = {
    type: 'line',
    data: chartData3,
    options: {
        scales: {
            yAxes: [{
                ticks: {}
            }]
        },
        plugins: {
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'xy'
                },
                zoom: {
                    wheel: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    pinch: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    mode: 'y'
                }
            }
        }
    }
};

// Get the canvas element
var ctx3 = document.getElementById('myChart3').getContext('2d');

// Create the chart
var myChart3 = new Chart(ctx3, chartConfig3);


// Data for the fourth chart
var chartData4 = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        label: 'Cal Ramp',
        data: <?php echo json_encode($data4); ?>,
        backgroundColor: 'rgba(255, 206, 86, 0.2)',
        borderColor: 'rgba(255, 206, 86, 1)',
        borderWidth: 1,
        pointBackgroundColor: 'rgba(128, 128, 128, 1)',
        pointHoverBackgroundColor: 'rgba(255, 255, 0, 1)'
    }]
};
var chartConfig4 = {
    type: 'line',
    data: chartData4,
    options: {
        scales: {
            yAxes: [{
                ticks: {}
            }]
        },
        plugins: {
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'xy'
                },
                zoom: {
                    wheel: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    pinch: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    mode: 'y'
                }
            }
        }
    }
};

// Get the canvas element
var ctx4 = document.getElementById('myChart4').getContext('2d');

// Create the chart
var myChart4 = new Chart(ctx4, chartConfig4);

// Data for the fifth chart
var chartData5 = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        label: 'BUSD PartPlacement ',
        data: <?php echo json_encode($data5); ?>,
        backgroundColor: 'rgba(255, 165, 0, 0.2)', // Orange color
        borderColor: 'rgba(255, 165, 0, 1)', // Orange color
        borderWidth: 1,
        pointBackgroundColor: 'rgba(128, 128, 128, 1)',
        pointHoverBackgroundColor: 'rgba(0, 255, 0, 1)',
        // Filter out data points with value 0
        data: <?php echo json_encode(array_filter($data5, function($value) { return $value !== 0; })); ?>
    }]
};

var chartConfig5 = {
    type: 'line',
    data: chartData5,
    options: {
        scales: {
            yAxes: [{
                ticks: {}
            }]
        },
        plugins: {
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'xy'
                },
                zoom: {
                    wheel: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    pinch: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    mode: 'y'
                }
            }
        }
    }
};

// Get the canvas element
var ctx5 = document.getElementById('myChart5').getContext('2d');

// Create the chart
var myChart5 = new Chart(ctx5, chartConfig5);

// Data for the sixth chart
var chartData6 = {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
        label: 'BUSD PartPlacement REF',
        data: <?php echo json_encode($data6); ?>,
        backgroundColor: 'rgba(128, 0, 128, 0.2)', // Purple color
        borderColor: 'rgba(128, 0, 128, 1)', // Purple color
        borderWidth: 1,
        pointBackgroundColor: 'rgba(128, 128, 128, 1)',
        pointHoverBackgroundColor: 'rgba(255, 255, 0, 1)',
        // Filter out data points with value 0
        data: <?php echo json_encode(array_filter($data6, function($value) { return $value !== 0; })); ?>
    }]
};

var chartConfig6 = {
    type: 'line',
    data: chartData6,
    options: {
        scales: {
            yAxes: [{
                ticks: {}
            }]
        },
        plugins: {
            zoom: {
                pan: {
                    enabled: true,
                    mode: 'xy'
                },
                zoom: {
                    wheel: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    pinch: {
                        enabled: true,
                        sensitivity: 0.9
                    },
                    mode: 'y'
                }
            }
        }
    }
};

// Get the canvas element
var ctx6 = document.getElementById('myChart6').getContext('2d');

// Create the chart
var myChart6 = new Chart(ctx6, chartConfig6);

       

        // Filter date
        function filterDataOnDate() {
            const startdate = document.getElementById('start').value;
            const enddate = document.getElementById('end').value;

            // Convert dates to milliseconds for easy comparison
            const startDateMs = new Date(startdate).getTime();
            const endDateMs = new Date(enddate).getTime();

            // Update chart data based on date range
            const filteredLabels = <?php echo json_encode($labels); ?>.filter((label, index) => {
                const dateMs = new Date(label).getTime();
                return dateMs >= startDateMs && dateMs <= endDateMs;
            });

            const filteredData1 = [];
            const filteredData2 = [];
            const filteredData3 = [];
            const filteredData4 = [];
            const filteredData5 = [];
            const filteredData6 = [];

            filteredLabels.forEach(label => {
                const index = <?php echo json_encode($labels); ?>.indexOf(label);
                filteredData1.push(<?php echo json_encode($data); ?>[index]);
                filteredData2.push(<?php echo json_encode($data2); ?>[index]);
                filteredData3.push(<?php echo json_encode($data3); ?>[index]);
                filteredData4.push(<?php echo json_encode($data4); ?>[index]);
                filteredData5.push(<?php echo json_encode($data5); ?>[index]);
                filteredData6.push(<?php echo json_encode($data6); ?>[index]);
            });

            // Update charts with filtered data
            myChart1.data.labels = filteredLabels;
            myChart1.data.datasets[0].data = filteredData1;
            myChart1.update();

            myChart2.data.labels = filteredLabels;
            myChart2.data.datasets[0].data = filteredData2;
            myChart2.update();

            myChart3.data.labels = filteredLabels;
            myChart3.data.datasets[0].data = filteredData3;
            myChart3.update();

            myChart4.data.labels = filteredLabels;
            myChart4.data.datasets[0].data = filteredData4;
            myChart4.update();

            myChart5.data.labels = filteredLabels;
            myChart5.data.datasets[0].data = filteredData5;
            myChart5.update();

            myChart6.data.labels = filteredLabels;
            myChart6.data.datasets[0].data = filteredData6;
            myChart6.update();
        }

        // Attach onchange event listeners to date inputs
        document.getElementById('start').addEventListener('change', filterDataOnDate);
        document.getElementById('end').addEventListener('change', filterDataOnDate);

        // Add event listeners to the chart canvases
        myChart1.canvas.addEventListener('click', handleChartClick);
        myChart2.canvas.addEventListener('click', handleChartClick);
        myChart3.canvas.addEventListener('click', handleChartClick);
        myChart4.canvas.addEventListener('click', handleChartClick);
        myChart5.canvas.addEventListener('click', handleChartClick);
        myChart6.canvas.addEventListener('click', handleChartClick);

// Add event listener to the chart canvases
myChart1.canvas.addEventListener('click', function(evt) {
    handleChartClick(evt, myChart1);
});

myChart2.canvas.addEventListener('click', function(evt) {
    handleChartClick(evt, myChart2);
});

myChart3.canvas.addEventListener('click', function(evt) {
    handleChartClick(evt, myChart3);
});

myChart4.canvas.addEventListener('click', function(evt) {
    handleChartClick(evt, myChart4);
});

myChart5.canvas.addEventListener('click', function(evt) {
    handleChartClick(evt, myChart5);
});

myChart6.canvas.addEventListener('click', function(evt) {
    handleChartClick(evt, myChart6);
});

// Function to handle chart click events
function handleChartClick(evt, chart) {
    // Get the clicked data
    var activePoints = chart.getElementsAtEvent(evt);
    if (activePoints.length > 0) {
        var datasetIndex = activePoints[0]._datasetIndex;
        var dataIndex = activePoints[0]._index;
        var clickedData = chart.data.datasets[datasetIndex].data[dataIndex];
        // Determine the destination URL based on clicked data
        var destinationURL;
        if (chart === myChart1) {
            destinationURL = clickedData > 5 ? 'fixBAD.html' : 'fixGood.html';
        } else if (chart === myChart2) {
            destinationURL = clickedData < 0.1 && clickedData > -0.1 ? 'fixGood.html' : 'fixBAD.html';
        } else if (chart === myChart3) {
            destinationURL = clickedData < 6.5 && clickedData > 5.5 ? 'fixGood.html' : 'fixBAD.html';
        } else if (chart === myChart4) {
            destinationURL = clickedData > 15 ? 'fixBAD.html' : 'fixGood.html';
        } else if (chart === myChart5) {
            destinationURL = clickedData > 15 ? 'fixBAD.html' : 'fixGood.html';
        } else if (chart === myChart6) {
            destinationURL = clickedData > 15 ? 'fixBAD.html' : 'fixGood.html';
        }
        // Open the link in a new tab
        window.open(destinationURL, '_blank');
    }
}


    </script>

</body>
</html>



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
