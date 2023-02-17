<?php

use Illuminate\Database\Eloquent\Collection;

function uploader($filename = '')
{
    return env('UPLOADER_URL') . $filename;
}

function cariResumeProvinsi($idKandidat, Collection $dataResume)
{
    return $dataResume->where('id_kandidat', $idKandidat)->values()->all();
}

function cetakStringAngkaAcak($length = 10)
{
  $characters = '01234567890';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}