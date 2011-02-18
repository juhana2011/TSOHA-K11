<?php
$dogs = Atomik_Db::query('select * from koirat LEFT JOIN koirien_tulokset ON koirat.reknro=koirien_tulokset.koira where koirat.reknro=?',array($_GET['reknro']));

foreach ($dogs as $dog):
$reknro = $dog['reknro'];
$nimi = $dog['nimi'];
$syntynyt = $dog['syntynyt'];
$vari = $dog['vari'];
$isa = $dog['isa'];
$ema = $dog['ema'];
$rotu = $dog['rotu'];
$omistaja = $dog['omistaja'];
$koiran_tila = $dog['koiran_tila'];
$selkatulos = $dog['selkatulos'];
$selka_huom = $dog['selka_huom'];
$selka_vaaraika = $dog['selka_vaaraika'];
$polvitulos = $dog['polvitulos'];
$nayttelytulos = $dog['nayttelytulos'];
$koetulos_lut = $dog['koetulos_lut'];
$koetulos_maaj = $dog['koetulos_maaj'];
$koetulos_lume = $dog['koetulos_lume'];
$koetulos_veri = $dog['koetulos_veri'];
$koetulos_pika = $dog['koetulos_pika'];
$koetulos_meja = $dog['koetulos_meja'];
$koetulos_vahi = $dog['koetulos_vahi'];
$koetulos_hirvj = $dog['koetulos_hirvj'];
endforeach;


$kvaa_sel = '';
$maaj1_sel = '';
$maaj2_sel = '';
$maaj3_sel = '';

if ($koetulos_maaj == 'KVAA') {
		$kvaa_sel = ' SELECTED';
	} elseif ($koetulos_maaj == 'MAAJ1') {
		$maaj1_sel = ' SELECTED';
	} elseif ($koetulos_maaj == 'MAAJ2') {
		$maaj2_sel = ' SELECTED';
	} elseif ($koetulos_maaj == 'MAAJ3') {
		$maaj3_sel = ' SELECTED';
} else {}







