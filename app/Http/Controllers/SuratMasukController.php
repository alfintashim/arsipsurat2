<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KodeNomorSurat;
use Alert;
use App\SuratMasuk;
use Validator;
use Auth;
use Storage;
use App\Helpers\LogSurat;
use Carbon;
use App\Log_surat;

class SuratMasukController extends Controller
{
    protected $rules = [
        'kode_nomor_surat' => ['required'],
        'no_surat' => ['required'],
        'asal' => ['required'],
        'perihal' => ['required'],
        'tgl_surat' => ['required', 'date'],
        'tgl_diterima' => ['required', 'date'],
        'file' => ['required', 'file', 'max:2048', 'mimes:jpeg,png,doc,docx,pdf'],
        'keterangan' => ['required']
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

        $tsm = SuratMasuk::orderBy('id','desc')->get();

        return view('surat_masuk.index',[
            'kd_nmr_surat' => $kd_nmr_surat,
            'tsm'          => $tsm
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
        
        $tsm = new SuratMasuk;
        $tsm->id_kns = $request->kode_nomor_surat;
        $tsm->no_surat = $request->no_surat;
        $tsm->asal = $request->asal;
        $tsm->perihal = $request->perihal;
        $tsm->tgl_surat = $request->tgl_surat;
        $tsm->tgl_diterima = $request->tgl_diterima;

            $file = $request->file('file');
            $nama = 'sm-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            Storage::putFileAs('public/sm', $request->file('file'), $namabaru);

        $tsm->file = $namabaru;

        $tsm->keterangan = $request->keterangan;
        $tsm->status = 'DIKIRIM';
        $tsm->notif = '1';
        $tsm->read = true;
        $tsm->id_create = Auth::user()->id;
        $tsm->save();

        $id_create = $tsm->id_create;
        $status = $tsm->status;
        $read = NULL;
        $disp_ke = NULL;
        $tgl_disp = Carbon\Carbon::now();

        LogSurat::createLog($tsm->id, $id_create, $status, $read, $disp_ke, $tgl_disp);

        Alert::success('Sukses', 'Data surat masuk berhasil ditambahkan.');

        return redirect ('/tsm');
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

        $tsm = SuratMasuk::join('users','suratmasuks.id_create','users.id')
        ->select('suratmasuks.*', 'users.nama')
        ->where('suratmasuks.id',$id)
        ->first();

        $disposisi = Log_surat::join('users','log_surats.id_create','users.id')
        ->select('log_surats.*', 'users.nama')
        ->where('log_surats.id_sm',$id)
        ->where('log_surats.status','DISPOSISI')
        ->orderBy('log_surats.id', 'desc')
        ->first();

        $log = Log_surat::join('users','log_surats.id_create','users.id')
        ->join('suratmasuks', 'log_surats.id_sm', 'suratmasuks.id')
        ->select('users.nama', 'log_surats.status', 'log_surats.read', 'log_surats.created_at')
        ->where('log_surats.id_sm',$id)
        ->get();

        return view('surat_masuk.show',[
            'kd_nmr_surat' => $kd_nmr_surat,
            'tsm'          => $tsm,
            'disposisi'    => $disposisi,
            'log'          => $log
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
        
        $tsm = SuratMasuk::findOrFail($id);
        $tsm->id_kns = $request->kode_nomor_surat;
        $tsm->no_surat = $request->no_surat;
        $tsm->asal = $request->asal;
        $tsm->perihal = $request->perihal;
        $tsm->tgl_surat = $request->tgl_surat;
        $tsm->tgl_diterima = $request->tgl_diterima;
        if($request->file('file') == "") {
            $tsm->file = $tsm->file;
        } else {
            $file = $request->file('file');
            $nama = 'sm-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            Storage::putFileAs('public/sm', $request->file('file'), $namabaru);

            $tsm->file = $namabaru;
        }
        $tsm->keterangan = $request->keterangan;
        $tsm->status = $tsm->status;
        $tsm->notif = $tsm->notif;
        $tsm->read = $tsm->read;
        $tsm->id_create = $tsm->id_create;
        $tsm->update();

        Alert::success('Sukses', 'Data surat masuk berhasil diubah.');

        return redirect ('/tsm/'.$tsm->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tsm = SuratMasuk::findOrFail($id);
        $tsm->delete();
        Alert::success('Sukses', 'Data berhasil di hapus!');

        return redirect()->route('tsm.index');
    }

    public function file($id)
    {
        $file = SuratMasuk::findOrFail($id);

        return response()->file('storage/sm/'.$file->file);
    }
}
