<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Beasiswa Tahfidz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
	    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		 <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="assets/ico/favicon.png">
  </head>

  <body>
 <div class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">UNSIQ</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
			  <li class="active"><a href="#">Beasiswa</a></li>
              <li><a href="login.php">Admin</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

	<div class="container">
<?php
// memanggil file koneksi
include 'koneksi.php';

// instance objek db
$db = new dbs();

// koneksi ke MySQL via method
$db->connectMySQL();

// proses hapus data
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        // baca ID dari parameter ID Biodata yang akan dihapus
        $id = $_GET['id_b'];

        // proses hapus data biodata berdasarkan ID via method
        $db->hapusBiodata($id);
    } elseif ($_GET['aksi'] == 'tambah') {
        echo"<br>
<form method=POST action='?aksi=tambahBiodata'>
<table cellpadding='0' cellspacing='0' border='0' class='table table-hover' >
<tr><td>Nama</td><td><input type=text name='nama'></td></tr>
<tr><td>Tempat lahir</td><td><input type=text name='tmpt_lahir'></td></tr>
<tr><td>Tanggal lahir</td><td><input type=text name='tgl_lahir' ></td></tr>
<tr><td>Alamat</td><td><textarea type=text name='alamat'></textarea></td></tr>
<tr><td>Telpon</td><td><input type=text name='telpon'></td></tr>
<tr><td></td><td><button type='submit' class='btn btn-primary'>SIMPAN</button></td></tr>
</table>
</form>
";
    } elseif ($_GET['aksi'] == 'tambahBiodata') {
        $nama = $_POST['nama'];
		$tmpt_lahir = $_POST['tmpt_lahir'];
		$tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];
		
        $db->tambahBiodata($nama,$tmpt_lahir,$tgl_lahir, $alamat, $telpon);
    }
// proses edit data
    else if ($_GET['aksi'] == 'edit') {
        // baca ID Biodata yang akan di edit
        $id = $_GET['id_b'];

// menampilkan form edit Biodata pakai method bacaBiodata()
        ?>	

        <form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'] ?>?aksi=update">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                <tr><td>Nama Lengkap</td><td>:</td>
                    <td><input type="text" name="nama" value="<?php echo $db->bacaDataBiodata('nama', $id); ?>"></td>
                </tr>
				
				<tr><td>Tempat lahir</td><td>:</td>
                    <td><input type="text" name="tmpt_lahir" value="<?php echo $db->bacaDataBiodata('tmpt_lahir', $id); ?>"></td>
                </tr>
				
				<tr><td>Tanggal lahir</td><td>:</td>
                    <td><input type="text" name="tgl_lahir" value="<?php echo $db->bacaDataBiodata('tgl_lahir', $id); ?>"></td>
                </tr>
				
                <tr><td>Alamat</td><td>:</td>
                    <td><textarea type="text" name="alamat" size="40"><?php echo $db->bacaDataBiodata('alamat', $id); ?></textarea></td>
                </tr>
				 
                <tr><td>Telpon</td><td>:</td>
                    <td><input type="text" name="telpon" value="<?php echo $db->bacaDataBiodata('telpon', $id); ?>"></td>
                </tr>	
            </table>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <td><button type='submit' class='btn btn-primary'>UPDATE</button></td>
        </form>

        <?php
    } else if ($_GET['aksi'] == 'update') {
        // proses update data biodata
        $id_b = $_POST['id'];
        $nama = $_POST['nama'];
		$tmpt_lahir = $_POST['tmpt_lahir'];
		$tgl_lahir = $_POST['tgl_lahir'];
        $alamat = $_POST['alamat'];
        $telpon = $_POST['telpon'];

        // update data via method
        $db->updateDataBiodata($id_b,$nama,$tmpt_lahir,$tgl_lahir,$alamat,$telpon);
    }
}

// buat array data biodata dari method tampilBiodata()
$arraybiodata = $db->tampilBiodata();

echo"<center><div class='alert alert-info'>
  <strong>Beasiswa</strong> Tahfidz Mahasiswa UNSIQ
</div></center>";
echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-hover' >
      <tr><th>No</th>
           <th>Nama Biodata</th>
           <th>Tempat Lahir</th>
		    <th>Tanggal lahir</th>
			 <th>Alamat</th>
           <th>Telpon</th>
       </tr>";
$i = 1;
foreach ($arraybiodata as $data) {
    echo "<tr><td>" . $i . "</td> 
          	   <td>" . $data['nama'] . "</td>
			   <td>" . $data['tmpt_lahir'] . "</td>
			   <td>" . $data['tgl_lahir'] . "</td>
               <td>" . $data['alamat'] . "</td>
               <td>" . $data['telpon'] . "</td>
            </tr>";
    $i++;
}

echo "</table>";
?>

	<div class="row-fluid">
			<div class="span12"><center>
			  <div class="row-fluid">
				<div class="alert alert-info">
					<a name="contact"></a>
				  <h2>UNSIQ WONOSOBO</h2>
				  <p class="text-info">Universitas Sains AlQuran </p>
				  <p>&copy; <a href="http://unsiq.ac.id/">unsiq.ac.id</a>&nbsp<?php echo date("Y");?></p>
				</div><!--/span-->
			  </div><!--/row-->
			</center</div><!--/span-->
	</div><!--/row-->


    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>

  </body>
</html>