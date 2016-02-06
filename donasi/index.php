<?php
    require_once"model/class.php";
    include("libs/path.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Donasi</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Favicon and touch icons -->
            <link rel="shortcut icon" href="assets/ico/favicon.png">
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
            <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css"/>

        </head>

        <body>

          <!-- Top menu -->
          <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
           <div class="container">
            <div class="navbar-header">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="index.html">Bootstrap Contact Form Template</a> -->
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="top-navbar-1">
         <ul class="nav navbar-nav navbar-right">
          <li>
           <span class="li-text">
            Dapatkan info
        </span> 
        <a href="#"><strong>terbaru</strong></a> 
        <span class="li-text">
            di akun sosial media kami: 
        </span> 
        <span class="li-social">
            <a href="#"><i class="fa fa-facebook"></i></a> 
            <a href="#"><i class="fa fa-twitter"></i></a> 
            <a href="#"><i class="fa fa-envelope"></i></a> 
            <a href="#"><i class="fa fa-skype"></i></a>
        </span>
    </li>
</ul>
</div>
</div>
</nav>
<!-- Top content -->
        <div class="top-content">
            <a href="http://ayobantumasjid.com" class="logo"></a>
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong>AYO BANTU MASJID!</strong></h1>
                            <div class="description">
                              <p>
                                Halaman Laporan Donasi yang telah anda berikan untuk projek terbaru kami di
                                situs  <a target="_blamk" href="http://ayobantumasjid.com/"><strong>ayobantumasjid.com</strong></a>.
                              </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                        <div class="form-top-left">
                                            <h3>Form Donasi</h3>
                                            <p>Mohon isi Data form ini secara lengkap</p>
                                        </div>
                                        <div class="form-top-right">
                                            <i class="fa fa-usd"></i>
                                        </div>
                            </div>
                            <div class="form-bottom">
                                    <form data-toggle="validator" role="form" enctype="multipart/form-data" action="model/donasi_control.php" method="post" id="formDonasi">
                                            <div class="form-group">
                                                 <label class="sr-only">Nama</label>
                                                 <input type="text" name="nama" placeholder="Nama Anda" class="form-control" id="nama" requeired>
                                                 <span id="helpBlock2" class="help-block">Dapat menggunakan Nama Lengkap, panggilan maupun Samaran.</span>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only">No Handphone</label>
                                                <input type="text" name="nop" placeholder="No Handphone" class="form-control" id="nop">
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only">Email</label>
                                                <input type="text" name="email" placeholder="Email" class="form-control" id="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only">Donasi</label>
                                                <input type="text" name="jumlah" placeholder="Jumlah Donasi" class="form-control" id="jumlah">
                                                 <span id="helpBlock2" class="help-block">Tuliskan dalam bentuk angka saja (ex: 2000000).</span>
                                            </div>
                                            <p align="center"><strong><B>Metode Pembayaran Donasi</B></strong></p>
                                            <p align="center">Semua Rekening Atas Nama <strong><i>Yayasan Ayo Bantu Masjid</i></strong></p>
                                            <div class="btn-group form-group" data-toggle="buttons">
                                                <label  class="btn active col-sm-10 col-md-offset-5">
                                                    <input type="radio" name='bank' value="bca" checked><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-check-circle-o fa-2x"></i> <span>  BCA 0251573793</span>
                                                </label>
                                                <label class="btn col-sm-6">
                                                    <input type="radio" value="mandiri" name='bank'><i class="fa fa-circle-o fa-2x"></i><i class="fa fa-check-circle-o fa-2x"></i><span> Mandiri 152-05-3332777-7</span>
                                                </label>
                                            </div>
                                            <br>
                                            <p align="center" ><i>Upload Bukti Pembayaran</i></p>
                                            <div class="form-group">
                                                <label class="sr-only" style="dislpay:inline;">Upload</label>
                                                <input class="col-sm-6 col-md-offset-3" type="file" name="bukti"><br>

                                            </div>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                                <?php
                                                    $cek = $donasi->tarikPrioritas();
                                                    foreach ($cek as $cek) {
                                                        if ($cek['prior']==0) {
                                                            echo '
                                                                <button type="submit" name="simpan" class="btn btn-send disabled">Kirim Donasi</button>
                                                                <span id="helpBlock3" class="help-block">Tidak Ada Proyek yang Berjalan Saat ini!.</span>
                                                            ';
                                                        }else{
                                                           echo '
                                                                <button type="submit" name="simpan" class="btn btn-send">Kirim Donasi</button>
                                                                <span id="helpBlock3" class="help-block">Setelah Menekan tombol kirim, mohon tunggu sampai anda diarahkan ke halaman selanjutnya. Hindari pengiriman berulang!.</span>
                                                            '; 
                                                        }
                                                    }
                                                ?>
                                                
                                            </div>
                                            <!--Pesan Error jika ada yang tidak sesuai -->
                                            <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            <h5 class="modal-title">Errors</h5>
                                                        </div>

                                                        <div class="modal-body">
                                                            <!-- The messages container -->
                                                              Masih terdapat kesalahan (error) saat pengisian form.
                                                            <br>
                                                            Mohon Diperhatikan pesan kesalahn yang disediakan untuk informasi lebih lanjut!
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>

        <!-- Javascript -->
          

        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>

        <script src="assets/js/scripts.js"></script>

        <script type="text/javascript">

$(document).ready(function() {
    $('#formDonasi').bootstrapValidator({
        err: {
                container: '#errors'
            },
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nama: {
                validators: {
                    notEmpty: {
                        message: 'Mohon isi Identitas Anda!'
                    }
                }
            },
            jumlah: {
                validators: {
                    notEmpty: {
                        message: 'Field Jumlah Donasi mohon Diisi!'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email harus terisi dengan email yang benar'
                    }
                }
            },
            bukti: {
                validators: {
                    notEmpty: {
                        message: 'Upload tanda bukti transfer anda!'
                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 2097152,   // 2048 * 1024
                        message: 'FIle terlalu besar dari 2 MB'
                    }
                }
    
            }
        }
    })
    // .on('submit', function(e) {
    //         // Show the message modal
    //         // $('#messageModal').modal('show');
    //          if (e.isDefaultPrevented()) {
    //             $('#messageModal').modal('show');
    //           } else {
    //             // everything looks good!
    //           }
    //     });
});

        </script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
            <![endif]-->

</body>
</html>
