<?php 
	include 'koneksi.php';
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>
	CS Students Search Engine | TBBD
	</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico&effect=3d-float">

    <style>
    	body {margin: 20px 0 30px 40px;}
    </style>
    <link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="menu"><ul id="MenuBar1" class="MenuBarHorizontal">
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact Us</a></li>
	</ul></div>

	<p><center>
	  <p class="menuhead"><br>
	  </p>
	  <br>
  	</center>
	</div>
	<div class="bimg">
		<a href="index.php"><img src="img/aish.png" height="50px" width="100px"></a>
		<br>
	</div>
	<div class="container">
		<div class="form">
			<br>
		<form action="" method="post">
		<input class="kata_kunci" type="text" name="kata_kunci" placeholder="Masukkan kata kunci" size="50" />
		<input class="submit" type="submit" name="submit" value="Cari" />
		<br>
	</form>
		<h5><b>HASIL PENCARIAN:</b></h5>
	<?php
	if(isset($_POST['submit'])){
		$kata_kunci = $koneksi->real_escape_string(htmlentities(trim($_POST['kata_kunci'])));
		
		if(strlen($kata_kunci)<3){
			echo '<p>Kata kunci terlalu pendek.</p>';
		}else{
			$where = "";
			
			$kata_kunci_split = preg_split('/[\s]+/', $kata_kunci);
			$total_kata_kunci = count($kata_kunci_split);
			
			foreach($kata_kunci_split as $key=>$kunci){
				$where .= "kata_kunci LIKE '%$kunci%'";
				if($key != ($total_kata_kunci - 1)){
					$where .= " OR ";
				}
			}
			
			$results = $koneksi->query("SELECT judul, LEFT(deskripsi, 60) as deskripsi, url FROM artikel WHERE $where");
			$num = $results->num_rows;
			if($num == 0){
				echo '<p>Pencarian dengan kata kunci <b>'.$kata_kunci.'</b> tidak ada hasil.</p>';
			}else{
				echo '<p>Pencarian dari kata kunci <b>'.$kata_kunci.'</b> mendapatkan '.$num.' hasil:</p>';
				while($row = $results->fetch_assoc()){
					echo '
					<p>
						<b>'.$row['judul'].'</b><br>
						'.$row['deskripsi'].'...<br>
						<a href="'.$row['url'].'">'.$row['url'].'</a>
					</p>
					';
				}
			}
		}
	}
	?>
		</div>
	</div>
	<script type="text/javascript">
  	(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
 	 })();
	</script>
	</center></p>
	<script type="text/javascript">
	var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
	</script>
</body>
</html>