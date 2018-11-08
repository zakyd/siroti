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
			<h1 align="center"><strong>Struk</strong></h1>
				<table class="form">
					<tr>
						<td align="right">date : <?=$tglpembelian?></td>
						<td style="min-width:300px"> </td>
					</tr>
				</table>
				<br>
				<table class="form">
					<?php
						$total=0;
						foreach($rt as $r) :
							$total+=$r['harga'];
					?>
					<tr>
						<td><?=$r['namaroti']?></td>
						<td><?=$r['jmlroti']?> x Rp<?=number_format($r['harga']/$r['jmlroti'])?></td>
						<td>Rp<?=number_format($r['harga'])?></td>
					</tr>
					<?php
						endforeach;
					?>
					<tr>
						<td colspan=2><div align="center">Total</div></td>
						<td>Rp<?=number_format($r['harga'])?></td>
					</tr>
				</table>
				<br><br>
				<table class="form">
					<tr>
						<td style="min-width:400px"> </td>
						<td align="right"><?=$kodepemesan?></td>
					</tr>
				</table>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>