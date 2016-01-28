<?php
	session_start();
	require"model/class.php";
	include("libs/path.php");

	$url = isset($_GET['p']) ? $_GET['p'] : NULL;
	$url = rtrim($url, '/');
	$url = filter_var($url, FILTER_SANITIZE_URL);
	$url = explode('/', $url);      // memecah URL menjadi variabel dimana var pertama adalah :
	
	#config dasar
	$model      = $url[0];
	$method 	= !empty($url[1])?$url[1]:'';
	$parameter 	= !empty($url[2])?$url[2]:NULL;

        if(empty($_SESSION['login'])){
    header('location:'.URL.'login');
    }

?>


<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADMIN | Ayo Bantu Masjid </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="asset/js/html5.js"></script>
    <![endif]-->

    <!-- core css files -->
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/style.css">
    <link href="<?php echo URL; ?>asset/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/plugins/chosen/chosen.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/datatable/media/css/demo_table.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/dtable.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/plugins/files/tipsy.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/plugins/datepicker/datepicker.css">
    <link rel="stylesheet" href="<?php echo URL; ?>asset/css/plugins/files/bootstrap-checkbox.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>


      <!-- core js files -->
    <script src="<?php echo URL; ?>asset/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo URL; ?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo URL; ?>asset/js/modernizr.custom.js"></script>
    <script src="<?php echo URL; ?>asset/js/core.js"></script>
    <script src="<?php echo URL; ?>asset/js/plugins/chosen.jquery.min.js"></script>
    <script src="<?php echo URL; ?>asset/datatable/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>asset/datatable/media/js/sorting.js"></script>
    <script src="<?php echo URL; ?>asset/js/plugins/jquery.tipsy.js"></script>

    <script src="<?php echo URL; ?>asset/js/plugins/jquery.maskedinput.min.js"></script>
    <script src="<?php echo URL; ?>asset/js/plugins/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo URL; ?>asset/js/plugins/bootbox.min.js"></script>
    <script src="<?php echo URL; ?>asset/js/plugins/jquery.dlmenu.js"></script>
    <script src="<?php echo URL; ?>asset/js/plugins/bootstrap-checkbox.js"></script>
<!-- 
    <script type="text/javascript">
        var ac_siteURL='';  //PHP Application üzerinde autocomplete verisi işlenmesi için temel adres tanımlaması için
    </script>
 -->
</head>
<body>
    <div id="application">
        <div id="topLine">
            <div class="applogo">
                <img src="<?php echo URL; ?>asset/img/logo.jpg" />
            </div>
            <div class="topcontent hidden-xs">
                <h2 style="color:#fff;">Portal Data Donator Projek Yayasan Ayo Bantu Masjid.</h2>
            </div>
            <div class="topmenu">
                <ul>
                    <li>
                        <a href="#" class="ta">
                        <!-- <img src="https://2.gravatar.com/avatar/621675677724d411a372dcdb1e50dbab6" width="50px" class="img-circle" /> -->
                        <span><?php echo $_SESSION['username']; ?></span>
                        <i class="fa fa-sort-desc"></i>
                        </a>
                        <ul>
                            <li><a href="<?php echo ROOT; ?>">Lihat Halaman Depan</a></li>
                            <li><a href="<?php echo URL.'keluar'; ?>">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div id="appContent">

        <div id="dl-menu" class="dl-menuwrapper">
            <ul class="dl-menu">
                <li><a href="#"><i class="fa fa-tachometer"></i>Home</a> </li>
                <li>
                    <a href="#"><i class="fa fa-user"></i>Lihat Proyek</a>
                    <ul class="dl-submenu">
                        <li><a href="#">Proyek 1</a></li>
                        <li><a href="#">Proyek 2</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Lihat Halaman Depan</a>
                </li>
                <li>
                    <a href="#">Keluar</a>
                </li>


            </ul>
        </div>

            <!--<div class="appmenu dl-menuwrapper">-->
                <!--<ul id="menu" class="dl-menu">-->
                    <!--<li><a href="#"><i class="fa fa-tachometer"></i>Ana sayfa</a></li>-->
                    <!--<li><a href="#" class="active"><i class="fa fa-user"></i>Kullanıcılar</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-list-alt"></i>Formlar</a>-->
                        <!--<ul class="dl-submenu">-->
                            <!--<li><a href="#" class="active">Sub 1</a></li>-->
                            <!--<li><a href="#">Sub 2</a></li>-->
                            <!--<li><a href="#">Sub 3</a></li>-->
                        <!--</ul>-->
                    <!--</li>-->
                <!--</ul>-->
            <!--</div>-->
            <div class="appcontent" >
                <div class="appbreadcrumb">
                    <ol class="breadcrumb">
                        <li><i class="fa fa-bars"></i> Menu</li>
                        <?php 
                            if ($model=='home') {
                                echo '<li ><a href="'.URL.'">Proyek</a></li>';
                                if ($method=='tambah') {
                                   echo '<li class="aktif">Tambah Data Proyek</li>';
                                }elseif ($method=='ubah') {
                                     echo '<li class="aktif">Ubah Data Proyek</li>';
                                }
                            }elseif ($model=='proyek') {
                               echo '
                                  <li><a href="'.URL.'">Proyek</a></li>
                                   ';
                                  if (is_numeric($method)) {
                                    echo '
                                      <li class="aktif">Data Donator : ';
                                      $nama = $home->tarikNamaProyek($method);
                                      foreach ($nama as $nama) {
                                          $result = $nama;
                                      }
                                     echo $result;
                                    }elseif ($method=='ubah') {
                                        echo '<li class="aktif">Ubah Data Donasi</li>';
                                     }
                               
                               echo'</li>
                               ';
                            }else {
                                 echo '<li ><a href="'.URL.'">Proyek</a></li>';
                            }
                        ?>
                      
                    </ol>
                </div>

                <!-- pilih Halaman untuk tampil -->

                <?php
					switch($model){ // pilih model
    					default:
    						include "controller/home_control/home.php";
                            break;
                        case "home":
                            include "controller/home_control/home.php";
                        break;
    					case "proyek":
    						include "controller/proyek_control/proyek.php";
    					break;
                        case "keluar":
                            include "controller/login_control/logout.php";
                        break;
				}
				?>

            </div>
        </div>
    </div>
        <script src="<?php echo URL; ?>asset/js/lightbox.js"></script>
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"> </script>
        <script src="<?php echo URL; ?>asset/js/plugins/bootstrap-datepicker.js"></script>
       <script type="text/javascript" src="<?php echo URL; ?>asset/js/plugins/tinymce2/tinymce.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#formTambahProyek').bootstrapValidator({
                container: '#messages',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    nama_proyek: {
                        validators: {
                            notEmpty: {
                                message: 'Nama Proyek Tidak Boleh Dibiarkan Kosong!'
                            }
                        }
                    },
                    target_dana: {
                        validators: {
                            notEmpty: {
                                message: 'Mohon Isi Target DanaYang Diperlukan!'
                            }
                        }
                    }
                }
            });
        });

        </script>


        <script type="text/javascript">
    
    
    $(function() {
        
        $('#dp1').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('#dp2').datepicker({
            format: 'dd-mm-yyyy'
        });
        
        $("#uploadFile").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
     
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
     
                reader.onloadend = function(){ // set image data as background of div
                    // $("#imagePreview").css("background-image", "url("+this.result+")");
                    $("#imagePreview").html("<img src='"+this.result+"' style='width:520px; height:500px;'/>");
                    
                }
            }
            
            //validasi
            if(files[0].type != 'image/png'){
                if(files[0].type != 'image/jpeg'){
                alert('format gambar tidak sesuai');
                }
            }
            if((files[0].size/1024) >= 1029){
                alert('file melebihi 1 MB');
                return false;
            }
            
        });
    
    });
</script>

        <script type="text/javascript">
        $(document).ready(function(){
        
            
            tinymce.init({
                selector: "textarea",
                plugins: [
                     "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                     "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                     "save table contextmenu directionality emoticons template paste textcolor "
               ],
               //image_advtab: true,
               
             
               toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image  | print preview  fullpage | forecolor backcolor emoticons" ,
                
                relative_urls: false
             });

        });

    </script>
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>

</body>
</html>