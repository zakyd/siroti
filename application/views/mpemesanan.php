<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>RotiQu</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css')?>"/>
	</head>
	<body background="<?= base_url('images/bg1.jpg')?>">
		<div class="topnav">
			<a class="logo"><img src="<?=base_url('images/logoRotiQu.png')?>" width="100px"></a>
			<a class="nav" href="<?= base_url('rotiqu/home')?>">HOME</a>
			<?php if(isset($_SESSION['role'])){ if($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir" OR $_SESSION['role']=="member"){ ?>
			<a class="active" href="<?= base_url('rotiqu/pemesanan')?>">PEMESANAN</a>
			<?php }if($_SESSION['role']=="admin"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/tambahroti')?>">MASTER ROTI</a>
			<?php }if($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/tambahproduksi')?>">PRODUKSI</a>
			<?php }if($_SESSION['role']=="admin"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/laporan')?>">LAPORAN</a>
			<?php }}if(isset($_SESSION['username'])){ ?>
			<a class="nav" href="<?= base_url('rotiqu/logout')?>" style="float:right">LOGOUT</a>
			<?php }else{ ?>
			<a class="nav" href="<?= base_url('rotiqu/login')?>" style="float:right">LOGIN</a>
			<?php } ?>
		</div>
		<div class="data" align="center">
			<br><br>
			<h1 align="center"><strong>Pemesanan RotiQu</strong></h1>
			<form role="form" action="<?= base_url('rotiqu/struk')?>" method="post">
				<div class="row">
				<?php
					foreach($roti as $daftarroti) :
						$namaroti=$daftarroti['namaroti'];
						$koderoti=$daftarroti['koderoti'];
						$hargaroti=$daftarroti['hargasatuan'];
						$stok=$daftarroti['stok'];
				?>
				<div class="column">
					<h2 style="font-size:28px"><?=$namaroti?></h2>
					<img src="<?=base_url('images/'.$koderoti.'.png')?>" alt="<?=$namaroti?>" style="width:100%">
					<table width="90%">
						<tr>
							<td><p align="left" style="font-size:20px">Rp <?=number_format($hargaroti)?> /buah</p></td>
							<td><p align="right" style="font-size:20px">stok : <?=$stok?></p></td>
						</tr>
					</table>
					<?php
						echo '<input type="number" name="'.$daftarroti['koderoti'].'" style="width: 5em;" min=0 value=0>';
					?>
				</div>
				<?php
					endforeach;
				?>
				</div>
				<br><br>
				<input type="submit" value="PESAN">
			</form>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>