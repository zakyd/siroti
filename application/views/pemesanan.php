<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>Pemesanan RotiQu</title>
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
				<table class="roti" align="center">
					<tr>
						<td>Nama Roti</td>
						<td>Harga Satuan</td>
						<td>Stok</td>
						<td>Jumlah</td>
					</tr>
					<?php
						foreach ($roti as $daftarroti) {
							echo "<tr>";
							echo "<td>".$daftarroti['namaroti']."</td>";
							echo "<td>Rp".number_format($daftarroti['hargasatuan'])."</td>";
							echo "<td>".$daftarroti['stok']."</td>";
							echo '<td><input type="number" name="'.$daftarroti['koderoti'].'" min=0 value=0></td>';
							echo "</tr>";
						}
					?>
				</table>
				<br><br>
				<input type="submit" value="PESAN">
			</form>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>