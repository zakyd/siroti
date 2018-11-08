<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>Edit Produksi</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css')?>"/>
	</head>
	<body background="<?= base_url('images/bg1.jpg')?>">
		<div class="topnav">
			<a class="logo"><img src="<?=base_url('images/logoRotiQu.png')?>" width="100px"></a>
			<a class="nav" href="<?= base_url('rotiqu/home')?>">HOME</a>
			<?php if(isset($_SESSION['role'])){ if($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir" OR $_SESSION['role']=="member"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/pemesanan')?>">PEMESANAN</a>
			<?php }if($_SESSION['role']=="admin"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/tambahroti')?>">MASTER ROTI</a>
			<?php }if($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur"){ ?>
			<a class="active" href="<?= base_url('rotiqu/tambahproduksi')?>">PRODUKSI</a>
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
			<h1 align="center"><strong>Edit Produksi</strong></h1>
			<form role="form" action="<?= base_url("rotiqu/eproduksi/$kp")?>" method="post">
				<table class="form">
					<tr>
						<td>Kode Produksi</td>
						<td>:</td>
						<td colspan="2" style="text-align:center"><?=$kp?></td>
					</tr>
					<tr>
						<td>Tanggal Produksi</td>
						<td>:</td>
						<td colspan="2"><input type="date" name="tglproduksi" min=0 value=<?=$tgl?>></td>
					</tr>
					<tr>
						<td>Nama Roti</td>
						<td>:</td>
						<td colspan="2">
							<select class="roti" name="koderoti">
								<?php
								foreach($mroti as $m){
									echo "<option value='".$m['koderoti']."'>";
									echo $m['namaroti']." (".$m['koderoti'].")</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jumlah</td>
						<td>:</td>
						<td><input class="waktu" type="number" name="jumlah" min=0 value=<?=$jml?>></td>
						<td align="left">pcs</td>
					</tr>
				</table>
				<br><br>
				<input type="submit" value="EDIT">
			</form>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>