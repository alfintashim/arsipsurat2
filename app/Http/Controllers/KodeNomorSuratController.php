<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KodeNomorSurat;
use Alert;
use Validator;

class KodeNomorSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kd_nmr_surat = KodeNomorSurat::orderBy('kode', 'desc')->get();

        return view('kode_nomor_surat.index', [
            'kd_nmr_surat' => $kd_nmr_surat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'numeric' => ':attribute hanya boleh diisi angka!',
        ];
        
        $this->validate($request,[
            'nama_kode' => ['required', 'string', 'max:255'],
            'kode' => ['required', 'numeric', 'unique:kode_nomor_surats'],
            'kategori' => ['required']
        ],$messages);
        
        $kd_nmr_surat = new KodeNomorSurat;
        $kd_nmr_surat->kode = $request->kode;
        $kd_nmr_surat->nama_kode = $request->nama_kode;
        $kd_nmr_surat->kategori  = $request->kategori;
        $kd_nmr_surat->save();

        Alert::success('Sukses', 'Data kode nomor surat baru berhasil ditambahkan.');

        return redirect('kns');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
