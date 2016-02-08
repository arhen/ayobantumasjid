<?php 
@session_start();
require"model/class.php";
include("portal-adm/libs/path.php");
$url = isset($_GET['p']) ? $_GET['p'] : null;
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);
$url = explode('/', $url);      // memecah URL menjadi variabel dimana var pertama adalah :
#config dasar
$model 		= $url[0];
$method 	= !empty($url[1])?$url[1]:'';
$parameter 	= !empty($url[2])?$url[2]:null;
// $parameter = filter_var($parameter,FILTER_VALIDATE_INT);
// $method = filter_var(strip_tags($parameter),FILTER_VALIDATE_INT);
// $aa = $libs->timer();

?>
<!DOCTYPE html>
<html itemscope itemtype="http://schema.org/Article">
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Ayo Bantu Masjid adalah Yayasan social crowdfunding atau penggalangan dana untuk membantu Masjid dalam hal PEMBANGUNAN, PERLENGKAPAN, dan KESEJAHTERAAN imam atau muadzin.">
		<meta name="keywords" content="fund, mosque, social, funding, website, fundraising">
		<title>Ayo Bantu Masjid</title>
		<link rel="icon" href="index.php">


		<!--Import materialize.min.css-->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900,100italic,300italic,400italic,500italic,700italic,900italic' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="<?php echo ROOT;?>assets/bootstrap.min.css" media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="<?php echo ROOT;?>assets/materialize/css/materialize.min.css" media="screen,projection"/>
		<link type="text/css" rel="stylesheet" href="<?php echo ROOT;?>assets/main.css" media="screen,projection"/>

		<link rel="icon" type="image/x-icon" href="favicon.ico">

		<!--Optimized for Mobile-->
    	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body class="tribox-theme">
		<!-- Google Tag Manager -->
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5353TG"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5353TG');</script>
		<!-- End Google Tag Manager -->
		
		<header>
			<div class="navbar-fixed">
				<nav class="blue-grey darken-4" role="navigation">
					<div class="nav-wrapper container">
						<a href="#home" class="brand-logo">
							<!-- <img src="assets/images/logo-ayo-bantu-masjidd.jpg" alt="Ayo Bantu Masjid"/>
							<span class="hidden big-logo-text">TRIBOX</span>
							<span class="small-logo-text">INDONESIA</span> -->
						</a>
						<ul id="nav-desktop" class="right hide-on-med-and-down">
							<li><a href="#about"><i class="material-icons">my_location</i>TENTANG KAMI</a></li>
							<li><a href="#works"><i class="material-icons">view_comfy</i>PROYEK</a></li>
							<li><a href="#team"><i class="material-icons">perm_identity</i>TIM KAMI</a></li>
							<li><a href="#contact"><i class="material-icons">call</i>KONTAK</a></li>
						</ul>
						<ul id="nav-mobile" class="side-nav blue-grey darken-4">
							<li>Menu</li>
							<li><a href="#about"><i class="material-icons">my_location</i>TENTANG KAMI</a></li>
							<li><a href="#works"><i class="material-icons">view_comfy</i>PROYEK</a></li>
							<li><a href="#team"><i class="material-icons">perm_identity</i>TIM KAMI</a></li>
							<li><a href="#contact"><i class="material-icons">call</i>KONTAK</a></li>
						</ul>
						<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
					</div>
				</nav>
			</div>
		</header>

		<main>
			<section id="section1-landing" class="section full-height-section" name="home">
				<h2 class="hidden">Ayo Bantu Masjid</h2>
				<div class="slider fullscreen">
					<ul class="slides">
						<!-- <li>
							<img src="assets/images/logo-ayo-bantu-masjid.jpg" alt="Indahnya kebersamaan"> 
							<div class="slider-layer fullscreen"></div>
						</li> -->
						<li>
							<img src="assets/images/banner-1-masjid.jpg" alt="Mari Wujudkan Kebaikan"> <!-- random image -->
							<div class="slider-layer fullscreen"></div>
							<div class="caption center-align">
								<h3>BARANGSIAPA MENGAJAK KEPADA KEBAIKAN</h3>
								<h5 class="light">Maka ia akan mendapat pahala sebanyak pahala yang diperoleh orang-orang yang mengikutinya tanpa mengurangi pahala mereka sedikitpun. <br>(HR. Muslim)</h5>
							</div>
						</li>
						<li>
							<img src="assets/images/banner-2-masjid.jpg" alt="Indahnya kebersamaan"> <!-- random image -->
							<div class="slider-layer fullscreen"></div>
							<div class="caption center-align">
								<h3>PERUMPAMAAN (NAFKAH YANG DIKELUARKAN OLEH)</h3>
								<h5 class="light">Orang-orang yang menafkahkan hartanya di jalan Allah adalah serupa dengan sebutir benih yang menumbuhkan tujuh bulir, pada tiap-tiap bulir seratus biji. Allah melipatgandakan (ganjaran) bagi siapa yang Dia kehendaki. Dan Allah Maha Luas (karunia-Nya) lagi Maha Mengetahui. <br> (Al-Baqarah : 261)</h5>
							</div>
						</li>
					</ul>
				</div>
				<!-- <a href="#about" class="scroll-down-to-next"><span class="icon-circle-down"></span></a> -->
			</section>

			<section id="section2-about" class="section full-height-section reversed-bg-color" name="about">
				<div class="container">
					<h2 class="section-title center-align">MENGAPA <span>KAMI </span>HADIR?</h2>
					
					<p class="center-align">Ayo Bantu Masjid adalah Yayasan social crowdfunding atau penggalangan dana untuk membantu Masjid dalam hal <strong>PEMBANGUNAN, PERLENGKAPAN, </strong> dan <strong>KESEJAHTERAAN </strong>imam atau muadzin.</p>

				</div>
				
				<!-- Divide to 2 columns and give interesting image of "business" and "digital marketing". -->
			</section>


							
			
			<section id='section4-works' class='section full-height-section' name='works'>
				<div class='container'>
					<h2 class='section-title center-align'><span>PROYEK</span> BANTUAN</h2>
					<div class='row'>
						<?php 
						
						$jumlah_desimal ="0";
						$pemisah_desimal =",";
						$pemisah_ribuan =".";
						$home = $home->tarikData();
						foreach ($home as $home) {
							
							$result = ($home['total']/$home['target_dana'])*100;
							$presentase = sprintf("%.2f", $result); 
							if ($presentase>=100) {
								$presentase = 100;
							}
						echo " 

						<div class='col s12'>
							<div class='card featured'>
									<div class='card-image'> 
									<br>";
									if(!empty($home['gambar'])){   
						                  echo" <img src='".ROOT."assets/images/proyek/".$home['gambar']."'/>";
						              }else{

						                  echo" <img src='".ROOT."assets/images/images/default.jpg'/>";

						              }

						             echo "
									</div>
									<div class='card-content'>
										<p class='project-title'>".$home['nama_proyek']."</p> 
										<br>
										<div class='project-description'>
											".$home['desc_proyek']."
										</div>
										<br>
									"; if ($home['prior']==1 AND $home['konfirm']=='N') {
									echo "	<div class='alert alert-info center-align'>~ Proyek Ini Masih Dalam Tahap Penerimaan Donasi ~</div>
										";

									}elseif ($home['prior']==0 AND $home['konfirm']=='N' AND $home['total']<$home['target_dana'])  {
										echo "	<div class='alert alert-success center-align'>~ PROYEK INI TELAH DIHENTIKAN ~</div>
										";
									}elseif ($home['prior']==0 AND $home['konfirm']=='N') {
										echo "	<div class='alert alert-success center-align'>~ PROYEK INI TELAH SELESAI ~</div>
										";
									}else {
										echo "	<div class='alert alert-success center-align'>~ PROGRESS PROYEK TERAKHIR KAMI ~</div>
										";
									}
									echo "
					             		<p class='progress-container'>
					             			<span class='progress-empty-background'></span>
					             			<span class='progress-bar'></span>
					             			<span class='progress-label'>Progress <span class='progress-value'>".$presentase."</span>% </span>
					             		</p>
					             		<p class='target-label'>Dibutuhkan <span class='target-value'>Rp ".number_format($home['target_dana'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</span></p>
					             		<p class='collected-label'>Terkumpul <span class='collected-value'>Rp ".number_format($home['total'], $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan)."</span></p>
					             	";	if ($home['total']>$home['target_dana'] AND $home['konfirm']=='N' AND $home['prior']==1) {
					             		echo "
					             		<p class='deadline-label'><span class='deadline-value'><font color='red'>TARGET DANA TELAH TERCUKUPI!</font></span></p>
					             		<p class='deadline-label'><span class='deadline-value'><font size='2px'><i>Hubungi Kami Jika Pesan ini masih Terlihat oleh Anda<i></font></span></p>
					             	";
					             	}elseif ($home['total']<$home['target_dana'] AND $home['konfirm']=='N' AND $home['prior']==0) {
					             		echo "
					             		<p class='deadline-label'><span class='deadline-value'><font color='red'>TARGET DANA BELUM MENCUKUPI!</font></span></p>
					             		<p class='deadline-label'><span class='deadline-value'><font size='2px'><i>Hubungi Kami Mengenai Tindakan Penghentian Proyek Ini!<i></font></span></p>
					             	";
					             	} else {
					             		 $date1 = new DateTime(date('d-m-Y'));
                                         $date2 = new DateTime($home['tanggal_selesai']);
                                         if ($date1>=$date2) {
                                    echo "
                                    	<p class='target-label'>Proyek berakhir dalam <span class='target-value'><font color='red'> 0 Hari</font></span></p>
                                    ";
                                         }elseif ($home['prior']==1){
                                         	$interval = $date1->diff($date2);
                                    echo "
					             		<p class='target-label'>Proyek berakhir dalam <span class='target-value'><font color='red'> ".$interval->days." Hari</font></span></p>
					             		<br>
					             		<a href='http://www.ayobantumasjid.com/donasi' target='_blank' class='btn waves-effect waves-light'>BANTU DONASI</a>
					             	";
                                         }else {
                                         	echo "
					             		<p class='deadline-label' align='center'><font color='red'>TERIMA KASIH ATAS DONASI ANDA!</font></p>
					             	";
                                         }
					             	}
					             	echo "	
					             		<br>
									</div>
									
								</a>
							</div>
						</div>
				    </div>
				    ";

					}

					?>
				</div>
			</section>
			



			<section id="section5-team" class="section full-height-section" name="team">
				<div class="container">
					<h2 class="section-title center-align"><span>TIM</span> KAMI</h2>
					<div class="row">
						<div class="col">
							<div class="card">
								<a href="#">
									<div class="card-image">
										<i class="large material-icons">perm_identity</i>
									</div>
									<div class="card-content">
										<p class="team-name">Budi<br>Kurniawan</p>
					             		<p class="team-position">Chief Executive Officer</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="#">
									<div class="card-image">
										<i class="large material-icons">perm_identity</i>
									</div>
									<div class="card-content">
										<p class="team-name">Dedy<br>Triawan</p>
					             		<p class="team-position">Chief Technology Officer</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="#">
									<div class="card-image">
										<i class="large material-icons">perm_identity</i>
									</div>
									<div class="card-content">
										<p class="team-name">Novita<br>Sutopo</p>
					             		<p class="team-position">Chief Marketing Officer</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="#">
									<div class="card-image">
										<i class="large material-icons">perm_identity</i>
									</div>
									<div class="card-content">
										<p class="team-name">Mashudi,<br>SE. AK</p>
					             		<p class="team-position">Chief Finance Officer</p>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="#">
									<div class="card-image">
										<i class="large material-icons">perm_identity</i>
									</div>
									<div class="card-content">
										<p class="team-name">Kasman<br></p>
					             		<p class="team-position">Chief Operation Officer</p>
									</div>
								</a>
							</div>
						</div>
				    </div>
				</div>
			</section>

			<section id="section7-contact" class="section full-height-section reversed-bg-color" name="contact">
				<div class="container">
					<h2 class="section-title center-align">KONTAK <span>KAMI</span></h2>
					<div class="row">
						<div class="col s6 right-align">
							<p>
								<b>Yayasan Ayo Bantu Masjid</b><br>
								Jalan Masjid Raya No.174<br>
								Makassar, Sulawesi Selatan,<br>
								Indonesia 90151<br><br>
							</p>
						</div>
						<div class="col s6">
							<p>
								<b>Connect with us</b><br>
								<span class="connect"><i class="material-icons">phone</i></span> &nbsp;&nbsp;+62 812 4113985<br>
								<a target="_blank" href="mailto:kontak@ayobantumasjid.com">
									<span class="connect"><i class="material-icons">email</i></span> &nbsp;&nbsp;kontak@ayobantumasjid.com<br>
								</a>
								<a target="_blank" href="#">
									<span class="social s-fb icon-facebook2"></span> &nbsp;&nbsp;Ayo Bantu Masjid<br>
								</a>
								<!-- <a target="_blank" href="">
									<span class="social s-gp icon-google-plus2"></span> &nbsp;&nbsp;TRIBOX Indonesia<br>
								</a> -->
								<a target="_blank" href="https://twitter.com/ayobantumasjid">
									<span class="social s-tw icon-twitter2"></span> &nbsp;&nbsp;@ayobantumasjid<br>
								</a>
								<a target="_blank" href="https://www.instagram.com/ayobantumasjid/">
									<span class="social s-ig icon-instagram"></span> &nbsp;&nbsp;@ayobantumasjid<br>
								</a>
							</p>
						</div>

						<!-- <div class="col s6">
							<p>
								<b>FAQ<br></b>
								<span class="faq-question">Pertanyaan pertama ?<br></span>
								<span class="faq-answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquam quam nec nisl feugiat, in dapibus purus euismod. Quisque in ipsum massa.<br><br></span>

								<span class="faq-question">Pertanyaan kedua ?<br></span>
								<span class="faq-answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquam quam nec nisl feugiat, in dapibus purus euismod. Quisque in ipsum massa.<br><br></span>

								<span class="faq-question">Pertanyaan ketiga ?<br></span>
								<span class="faq-answer">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec aliquam quam nec nisl feugiat, in dapibus purus euismod. Quisque in ipsum massa.<br><br></span>
							</p>
						</div> -->
					</div>
				</div>
			</section>
		</main>

		<footer>
			&copy; AYOBANTUMASJID.COM
		</footer>

	     <!--Import $ before materialize.js-->
	     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	     <script type="text/javascript" src="<?php echo ROOT;?>assets/bootstrap.min.js"></script>
	     <script type="text/javascript" src="<?php echo ROOT;?>assets/materialize/js/materialize.js"></script>
	     <script type="text/javascript" src="<?php echo ROOT;?>assets/main.js"></script>
	     <script type="text/javascript" src="<?php echo ROOT;?>assets/full-height-section.js"></script>
	</body>
</html>
