<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;
use Auth;
use Alert;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Instansi::first();

        return view('profil.index', compact('profil'));
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
        //
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
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'numeric' => ':attribute hanya boleh diisi angka!',
            'file' => ':attribute belum dipilih!',
            'mimes' => 'Format :attribute yang dipilih adalah .JPG, .PNG!'
        ];
        
        $this->validate($request,[
            'nama' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'kepala' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'logo' => ['file', 'max:2048', 'mimes:jpeg,png'],
        ],$messages);
        
        $profil = Instansi::findOrFail($id);
        $profil->nama = $request->nama;
        $profil->status = $request->status;
        $profil->alamat = $request->alamat;
        $profil->ketua = $request->kepala;
        $profil->nip = $request->nip;
        $profil->website = $request->website;
        $profil->email = $request->email;
        if($request->file('logo') == "") {
            $profil->logo = $profil->logo;
        } else {
            $file = $request->file('file');
            $path = base_path() . '/public/img/logo';
            $nama = 'logo-' . str_random(5);
            $extension = $file->getClientOriginalExtension();
            $namabaru = $nama . '.' . $extension;
            $file->move($path, $namabaru);

            $tsm->file = $namabaru;
        }
        $profil->id_create = Auth::user()->id;
        $profil->update();

        Alert::success('Sukses', 'Data berhasil diubah');

        return redirect ('/profil');
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
