<?php
    require"../donasi/model/class.php";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Data Donator</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/custom.css" rel="stylesheet">

    <link href="assets/css/bootstrap-reset.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />


  </head>

  <body>


    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="http://ayobantumasjid.com">Beranda</a></li>
        </ul>
        <h3 class="text-muted">Ayo Bantu Masjid!</h3>
      </div>
      <div class="table-container">

            <div class="panel-heading">
                            Donasi Untuk Project
                       </div>
                       <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Donator</th>
                                            <th>Jumlah Donasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $tarik =  $donasi->tarikDataDonatur();
                                    $no=1;
                                    if ($tarik==0) {
                                          echo "Tidak Ada Data";
                                    }else{
                                     foreach ($tarik as $tarik) {
                                      echo "

                                        <tr>
                                          <td>".$no."</td>
                                          <td>".$tarik['nama']."</td>
                                          <td>Rp. ".$tarik['jumlah']."</td>
                                        </tr>
                                      ";
                                      $no++;

                                    }     

                                    }

                                    ?>
                            
                                    </tbody>
                                </table>
                                            </div>
                                          </div>

                                        </div>
      <div class="footer">
        <p>&copy; Yayasan Ayo Bantu Masjid! 2015</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!--Core js-->
  <!-- /. WRAPPER  -->
                <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
                <!-- JQUERY SCRIPTS -->
                <script src="assets/js/jquery-1.10.2.js"></script>
                <!-- BOOTSTRAP SCRIPTS -->
                <script src="assets/js/bootstrap.min.js"></script>
                <!-- METISMENU SCRIPTS -->
                <script src="assets/js/jquery.metisMenu.js"></script>
                <!-- DATA TABLE SCRIPTS -->
                <script src="assets/js/dataTables/jquery.dataTables.js"></script>
                <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
                <script>
                $(document).ready(function () {
                    $('#dataTables-example').dataTable();
                });
                $(document).ready(function () {
                    $('#dataTables-example1').dataTable();
                });
                </script>
                <!-- CUSTOM SCRIPTS -->
                <script src="assets/js/custom.js"></script>

  </body>
</html>
