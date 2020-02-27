<?php

function logo_profil()
{
    $gambar = DB::table('instansis')->orderBy('id','desc')->get()->first();

    $pathFile = 'img/logo/' . $gambar->logo;

    echo '<img src="'. asset($pathFile) .'" alt="Profil Logo" class="brand-image"
    style="opacity: .8">';
}

function login()
{
    $gambar = DB::table('instansis')->orderBy('id','desc')->get()->first();

    $pathFile = 'img/logo/' . $gambar->logo;

    echo '<img src="'. asset($pathFile) .'" width="200px" height="180px">';
}

function pdf()
{
    $gambar = DB::table('instansis')->orderBy('id','desc')->get()->first();

    $pathFile = 'img/logo/' . $gambar->logo;

    echo '<img src="'. asset($pathFile) .'" width="70" height="70">';
}

?>