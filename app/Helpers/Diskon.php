<?php

function diskon($v) 
{
    
  $harga_awal = $v->harga_awal;
  $diskon = $v->diskon;
  $persentase_diskon = $diskon / $harga_awal * 100/100 ;

  return round($persentase_diskon, 2);
}
