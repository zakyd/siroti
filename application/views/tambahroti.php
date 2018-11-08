<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>Tambah RotiQu</title>
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
			<h1 align="center"><strong>Tambah RotiQu</strong></h1>
			<form role="form" action="<?= base_url('rotiqu/troti')?>" method="post">
				<table class="form">
					<tr>
						<td>Kode Roti</td>
						<td>:</td>
						<td colspan="2"><input type="text" name="koderoti"></td>
					</tr>
					<tr>
						<td>Nama Roti</td>
						<td>:</td>
						<td colspan="2"><input type="text" name="namaroti"></td>
					</tr>
					<tr>
						<td>Harga Satuan</td>
						<td>:</td>
						<td colspan="2"><input class="harga" type="number" name="hargasatuan" value=0 min=0></td>
					</tr>
					<tr>
						<td>Waktu Kadaluarsa</td>
						<td>:</td>
						<td><input class="waktu" type="number" name="waktukadaluarsa" value=0 min=0></td>
						<td align="left">hari</td>
					</tr>
				</table>
				<br><br>
				<input type="submit" value="TAMBAH">
			</form>
			<br><br>
			<table class="roti">
			<tr>
				<td>Kode Roti</td>
				<td>Nama Roti</td>
				<td>Harga Satuan</td>
				<td>Waktu Kadaluarsa</td>
				<td style="padding-left:10px;padding-right:10px">Edit</td>
				<td style="padding-left:10px;padding-right:10px">Hapus</td>
			</tr>
			<?php
				foreach($mroti as $m){
					echo "<tr>";
					echo "<td>".$m['koderoti']."</td>";
					echo "<td>".$m['namaroti']."</td>";
					echo "<td>Rp".number_format($m['hargasatuan'])."</td>";
					echo "<td>".$m['waktukadaluarsa']."</td>";
					$mkoderoti=$m['koderoti'];
					echo '<td style="padding-left:10px;padding-right:10px"><a class="nav" href="'.base_url("rotiqu/editmroti/$mkoderoti").'"><img src="'.base_url("images/edit.png").'"></a></td>';
					echo '<td style="padding-left:10px;padding-right:10px"><a class="nav" href="'.base_url("rotiqu/deletemroti/$mkoderoti").'"><img src="'.base_url("images/delete.png").'"></a></td>';
					echo "</tr>";
				}
			?>
			</table>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>