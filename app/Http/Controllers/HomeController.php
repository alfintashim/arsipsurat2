<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use App\User;
use App\SuratMasuk;
use App\SuratKeluar;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sm = SuratMasuk::count();
        $sk = SuratKeluar::count();
        $disposisi = SuratMasuk::where('status', 'DISPOSISI')->count();
        $selesai = SuratMasuk::where('status', 'SELESAI')->count();

        $profil = Instansi::first();

        return view('home', [
            // 'logo' => $logo
            'sm' => $sm,
            'sk' => $sk,
            'disposisi' => $disposisi,
            'selesai' => $selesai,
            'profil' => $profil
        ]);
    }
}
