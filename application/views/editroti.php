<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>Edit RotiQu</title>
		<link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css')?>"/>
	</head>
	<body background="<?= base_url('images/bg1.jpg')?>">
		<div class="topnav">
			<a class="logo"><img src="<?=base_url('images/logoRotiQu.png')?>" width="100px"></a>
			<a class="nav" href="<?= base_url('rotiqu/home')?>">HOME</a>
			<?php if(isset($_SESSION['role'])){ if($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir" OR $_SESSION['role']=="member"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/pemesanan')?>">PEMESANAN</a>
			<?php }if($_SESSION['role']=="admin"){ ?>
			<a class="active" href="<?= base_url('rotiqu/tambahroti')?>">MASTER ROTI</a>
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
			<h1 align="center"><strong>Edit RotiQu</strong></h1>
			<form role="form" action="<?= base_url("rotiqu/eroti/$kode")?>" method="post">
				<table class="form">
					<tr>
						<td>Kode Roti</td>
						<td>:</td>
						<td colspan="2"><input type="text" name="koderoti" value="<?=$kode?>"></td>
					</tr>
					<tr>
						<td>Nama Roti</td>
						<td>:</td>
						<td colspan="2"><input type="text" name="namaroti" value="<?=$nama?>"></td>
					</tr>
					<tr>
						<td>Harga Satuan</td>
						<td>:</td>
						<td colspan="2"><input class="harga" type="number" name="hargasatuan" min=0 value=<?=$harga?>></td>
					</tr>
					<tr>
						<td>Waktu Kadaluarsa</td>
						<td>:</td>
						<td><input class="waktu" type="number" name="waktukadaluarsa" min=0 value=<?=$waktu?>></td>
						<td align="left">hari</td>
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