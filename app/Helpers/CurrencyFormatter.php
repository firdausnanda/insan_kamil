<?php

function rupiah($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka, 0,',','.');
	echo $hasil_rupiah;

}

function rupiah2($angka){
	
	$hasil_rupiah = "Rp " . number_format($angka, 0,',','.');
	return $hasil_rupiah;

}