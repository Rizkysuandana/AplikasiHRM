<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING |E_DEPRECATED));


if(!isset($_SESSION['username'])){
    die("<meta http-equiv=\"refresh\" content=\"0; url=index.php\">");
}

if($_SESSION['level']!="direktur"){
    die("<meta http-equiv=\"refresh\" content=\"0; url=index.php\">");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>:: Sistem Informasi Pelatihan SDM Pada Bank BRI ::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
 	<link href="css/buttons.css" rel="stylesheet">
	<link href="css/jquery-ui.css" rel="stylesheet">
	<link href="vendors/form-helpers/css/bootstrap-formhelpers.min.css" rel="stylesheet">
    <link href="vendors/select/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendors/tags/css/bootstrap-tags.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
	<link href="vendors/bootstrap-datetimepicker/datetimepicker.css" rel="stylesheet">
  </head>
<body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <img src="images/bri.png" height="40" style="margin-bottom:15px; margin-top:5px;">
					</div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  	<form action='?page=Data-Karyawan'method="POST">
						<div class="input-group form">
							<input type="text" name="qcari" class="form-control" placeholder="Pencarian">
							 <span class="input-group-btn">
								<button class="btn btn-warning" type="submit">Search</button>
							 </span>
						</div>
						</form>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="?page=Ubah-Pengguna-Profil">Profile</a></li>
	                          <li><a href="logs.php?op=out">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="?page=Beranda"><span class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-record"></i></span>&nbsp; Beranda</a></li>	
                    <li class="submenu">
                         <a href="#">
                            <span class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-record"></i></span>&nbsp; Laporan
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="?page=Laporan-Karyawan">Karyawan</a></li>
							<li><a href="?page=Laporan-Pelatihan">Pelatihan</a></li>
							<li><a href="?page=Laporan-Peserta">Peserta</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
		  </div>
		  <div class="col-md-10">
				  	<?php 
						if(isset($_GET['page'])){
							include("page.php");
							}
							else{
							include("module/home.php");
							}
					?>
		  	</div>
    	</div>
    </div>
  	<link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">
	 <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
	<script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
   	<script src="vendors/datatables/dataTables.bootstrap.js"></script>
	<script src="js/tables.js"></script>
	<script src="js/forms.js"></script>
	<script src="vendors/form-helpers/js/bootstrap-formhelpers.min.js"></script>
    <script src="vendors/select/bootstrap-select.min.js"></script>
    <script src="vendors/tags/js/bootstrap-tags.min.js"></script>
    <script src="vendors/mask/jquery.maskedinput.min.js"></script>
    <script src="vendors/moment/moment.min.js"></script>
    <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
    <script src="vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
</body>
</html>