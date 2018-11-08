<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
	<head>
		<title>Produksi RotiQu</title>
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
			<h1 align="center"><strong>Produksi RotiQu</strong></h1>
			<form role="form" action="<?= base_url('rotiqu/tproduksi')?>" method="post">
				<table class="form">
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
						<td><input class="waktu" type="number" name="jumlah" value=0 min=0></td>
						<td align="left">pcs</td>
					</tr>
				</table>
				<br><br>
				<input type="submit" value="TAMBAH">
			</form>
			<br><br>
			<table class="roti">
			<tr>
				<td>Kode Produksi</td>
				<td>Kode Roti</td>
				<td>Tanggal Produksi</td>
				<td>Jumlah</td>
				<td style="padding-left:10px;padding-right:10px">Edit</td>
				<td style="padding-left:10px;padding-right:10px">Hapus</td>
			</tr>
			<?php
				foreach($pro as $p){
					echo "<tr>";
					echo "<td>".$p['kodeproduksi']."</td>";
					echo "<td>".$p['koderoti']."</td>";
					echo "<td>".$p['tglproduksi']."</td>";
					echo "<td>".$p['jumlah']."</td>";
					$kproduksi=$p['kodeproduksi'];
					echo '<td style="padding-left:10px;padding-right:10px"><a class="nav" href="'.base_url("rotiqu/editproduksi/$kproduksi").'"><img src="'.base_url("images/edit.png").'"></a></td>';
					echo '<td style="padding-left:10px;padding-right:10px"><a class="nav" href="'.base_url("rotiqu/deleteproduksi/$kproduksi").'"><img src="'.base_url("images/delete.png").'"></a></td>';
					echo "</tr>";
				}
			?>
			</table>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>