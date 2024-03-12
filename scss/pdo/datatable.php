<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "searching": true // Enable search feature
            });
        });
    </script>
    
    <title>DataTables</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12"> <br>
                <h3>DataTables</h3>
                <!-- Add search input field -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Search</span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <table id="example" class="display table table-striped table-hover table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Torque</th>
                            <th>Vacuum</th>
                            <th>EncoderAngle</th>
                            <th>EncoderZ</th>
                            <th>ScrewEvent</th>
                            <th>MicrotecBusy</th>
                            <th>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query data to display in the table
                        require_once 'connect.php';
                        $stmt = $conn->prepare("SELECT Torque, id, EncoderAngle, EncoderZ, Vacuum, ScrewEvent, MicrotecBusy, Timestamp FROM bvcm");
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach($result as $k) {
                            ?>
                            <tr>
                                <td><?= $k['id'];?></td>
                                <td><?= $k['Torque'];?></td>
                                <td><?= $k['Vacuum'];?></td>
                                <td><?= $k['EncoderAngle'];?></td>
                                <td><?= $k['EncoderZ'];?></td>
                                <td><?= $k['ScrewEvent'];?></td>
                                <td><?= $k['MicrotecBusy'];?></td>
                                <td><?= $k['Timestamp'];?></td>
                            </tr>
                            <?php 
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
