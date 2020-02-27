<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KodeNomorSurat;
use App\SuratKeluar;
use Alert;
use Validator;
use Auth;
use Storage;

class SuratKeluarController extends Controller
{
    protected $rules = [
        'kode_nomor_surat' => ['required'],
        'no_surat' => ['required'],
        'tujuan' => ['required'],
        'perihal' => ['required'],
        'tgl_surat' => ['required', 'date'],
        'tgl_catat' => ['required', 'date'],
        'file' => ['required', 'file', 'max:2048', 'mimes:jpeg,png,doc,docx,pdf'],
        'keterangan' => ['required'],
    ];

    protected $messages = [
        'required' => ':attribute wajib diisi!',
        'min' => ':attribute harus diisi minimal :min karakter!',
        'max' => ':attribute harus diisi maksimal :max karakter!',
        'numeric' => ':attribute hanya boleh diisi angka!',
        'file' => ':attribute belum dipilih!',
        'mimes' => 'Format :attribute yang dipilih adalah .JPG, .PNG, .DOC, .DOCX, .PDF!'
    ];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kd_nmr_surat = KodeNomorSurat::all();

        $tsk = SuratKeluar::orderBy('id','desc')->get();

        return view('surat_keluar.index',[
            'kd_nmr_surat' => $kd_nmr_surat,
            'tsk'          => $tsk
        ])
        ->with('no',1);
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
        $this->validate($request, $this->rules, $this->messages);
        
        $tsk = new SuratKeluar;
        $tsk->id_kns = $request->kode_nomor_surat;
        $tsk->no_surat = $request->no_surat;
        $tsk->tujuan = $request->tujuan;
        $tsk->perihal = $request->perihal;
        $tsk->tgl_surat = $request->tgl_surat;
        $tsk->tgl_catat = $request->tgl_catat;

            $file = $request->file('file');
            $nama = 'sk-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            Storage::putFileAs('public/sk', $request->file('file'), $namabaru);

        $tsk->file = $namabaru;

        $tsk->keterangan = $request->keterangan;
        $tsk->id_create = Auth::user()->id;
        $tsk->save();

        Alert::success('Sukses', 'Data surat keluar berhasil ditambahkan.');

        return redirect ('/tsk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kd_nmr_surat = KodeNomorSurat::all();
        $tsk = SuratKeluar::join('users','suratkeluars.id_create','users.id')
        ->select('suratkeluars.*', 'users.nama')
        ->where('suratkeluars.id',$id)
        ->first();

        return view('surat_keluar.show',[
            'kd_nmr_surat' => $kd_nmr_surat,
            'tsk'          => $tsk
        ]);
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
        $this->validate($request, $this->rules, $this->messages);
        
        $tsk = SuratKeluar::findOrFail($id);
        $tsk->id_kns = $request->kode_nomor_surat;
        $tsk->no_surat = $request->no_surat;
        $tsk->tujuan = $request->tujuan;
        $tsk->perihal = $request->perihal;
        $tsk->tgl_surat = $request->tgl_surat;
        $tsk->tgl_catat = $request->tgl_catat;
        if($request->file('file') == "") {
            $tsk->file = $tsk->file;
        } else {
            $file = $request->file('file');
            $nama = 'sk-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            Storage::putFileAs('public/sk', $request->file('file'), $namabaru);

            $tsk->file = $namabaru;
        }
        $tsk->keterangan = $request->keterangan;
        $tsk->id_create = $tsk->id_create;
        $tsk->update();

        Alert::success('Sukses', 'Data surat keluar berhasil diubah.');

        return redirect ('/tsk/'.$tsk->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tsk = SuratKeluar::findOrFail($id);
        $tsk->delete();
        Alert::success('Sukses', 'Data berhasil di hapus!');

        return redirect()->route('tsk.index');
    }

    public function file($id)
    {
        $file = SuratKeluar::findOrFail($id);

        return response()->file('storage/sk/'.$file->file);
    }
}
