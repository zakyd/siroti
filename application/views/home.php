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
			<a class="active" href="<?= base_url('rotiqu/home')?>">HOME</a>
			<?php if(isset($_SESSION['role'])){ if($_SESSION['role']=="admin" OR $_SESSION['role']=="kasir" OR $_SESSION['role']=="member"){ ?>
			<a class="nav" href="<?= base_url('rotiqu/pemesanan')?>">PEMESANAN</a>
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
			<?php if(isset($_SESSION['username'])){ ?>
			<h1 align="center"><strong>Selamat Datang di RotiQu, <?=$_SESSION['username']?></strong></h1>
			<?php }else{ ?>
			<h1 align="center"><strong>Selamat Datang di RotiQu</strong></h1>
			<?php } ?>
			<div class="row">
			<?php
				foreach($roti as $daftarroti) :
					$namaroti=$daftarroti['namaroti'];
					$koderoti=$daftarroti['koderoti'];
					$hargaroti=$daftarroti['hargasatuan'];
			?>
			<div class="column">
				<h2 style="font-size:28px"><?=$namaroti?></h2>
				<img src="<?=base_url('images/'.$koderoti.'.png')?>" alt="<?=$namaroti?>" style="width:100%">
				<p align="center" style="font-size:20px">Rp<?=number_format($hargaroti)?>/buah</p>
			</div>
			<?php
				endforeach;
			?>
			</div>
			<br><br><br><br>
		</div>
		<p align="right"><i>@zakyd</i></p>
	</body>
</html>