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
			<a class="nav" href="<?= base_url('rotiqu/pemesanan')?>">PEMESANAN</a>
			<?php }if($_SESSION['role']=="admin"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/tambahroti')?>">MASTER ROTI</a>
			<?php }if($_SESSION['role']=="admin" OR $_SESSION['role']=="dapur"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/tambahproduksi')?>">PRODUKSI</a>
			<?php }if($_SESSION['role']=="admin"){ ?>
			<a class="active" href="<?= base_url('rotiqu/laporan')?>">LAPORAN</a>
			<?php }}if(isset($_SESSION['username'])){ ?>
			<a class="nav" href="<?= base_url('rotiqu/logout')?>" style="float:right">LOGOUT</a>
			<?php }else{ ?>
			<a class="nav" href="<?= base_url('rotiqu/login')?>" style="float:right">LOGIN</a>
			<?php } ?>
		</div>
		<div class="data" align="center">
			<br><br>
			<h1 align="center"><strong>Laporan Bulanan</strong></h1>
			<form name="form_lap" class="form" action="<?=base_url('rotiqu/laporan')?>" method="POST">
				<table class="form">
					<tr>
						<td>Pilih Bulan</td>
						<td>:</td>
						<td>
							<select name="bln" onChange="form_lap.submit();" style="align:center">
								<option value=<?=($bln-1)?> selected hidden><?=$bulan[($bln-1)]?></option>
								<?php 
									$i=0;
									foreach($bulan as $b) : 
								?>
								<option value=<?=$i?>><?=$b?></option>
								<?php 
										$i++;
									endforeach; 
								?>
							</select>
							<select name="thn" onChange="form_lap.submit();" style="align:center">
								<option value=<?=$thn?> selected hidden><?=$thn?></option>
								<?php 
									for($j=-5;$j<=5;$j++){
								?>
								<option value=<?=($j+$thn)?>><?=($j+$thn)?></option>
								<?php 
									}
								?>
							</select>
						</td>
					</tr>
				</table>
			</form>
			<br><br>
			<table class="roti" align="center" border="1">
				<tr>
					<td>Nama Roti</td>
					<td>Jumlah Terjual</td>
					<td>Harga Satuan</td>
					<td>Total</td>
				</tr>
			<?php
				$total=0;
				foreach($lap as $l) :
					$nama = $l['namaroti'];
					$jml = $l['jml'];
					$hrg = $l['harga'];
					$total+=$hrg;
			?>
				<tr>
					<td><?=$nama?></td>
					<td><?=$jml?></td>
					<td>Rp <?=number_format($hrg/$jml)?></td>
					<td>Rp <?=number_format($hrg)?></td>
				</tr>
			<?php
				endforeach;
			?>
				<tr>
					<td colspan="3">Total</td>
					<td>Rp <?=number_format($total)?></td>
				</tr>
			</table>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zaky</i></p>
	</body>
</html>