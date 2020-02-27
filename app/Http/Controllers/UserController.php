<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Alert;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::orderBy('id', 'asc')->get();

        $user = User::join('roles','users.id_role','roles.id')
                ->get();
        
        return view('user.index',
            [
                'role' => $role,
                'user' => $user
            ]
        )
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
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute harus diisi minimal :min karakter!',
            'max' => ':attribute harus diisi maksimal :max karakter!',
            'numeric' => ':attribute hanya boleh diisi angka!',
            'email' => ':attribute hanya boleh diisi menggunakan email!'
        ];
        
        $this->validate($request,[
            'username' => ['required', 'min:5', 'max:20', 'unique:users'],
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ],$messages);
        
        $user = new User;
        $user->id_role  = $request->role;
        $user->nama     = $request->nama;
        $user->nip      = $request->nip;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Sukses', 'Data user baru berhasil ditambahkan.');

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::orderBy('id', 'asc')->get();
        
        $user = User::join('roles','users.id_role','roles.id')
            ->select('users.id', 'users.id_role', 'users.nama', 'users.email', 'users.username', 'users.nip', 'roles.nama_role')
            ->where('users.id',$id)
            ->first();
        
        return view('user.show', 
            [
                'role' => $role,
                'user' => $user
            ]
        );
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
            'email' => ':attribute hanya boleh diisi menggunakan email!'
        ];
        
        $this->validate($request,[
            'username' => ['required', 'min:5', 'max:20'],
            'nama' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:255']
        ],$messages);
        
        $user = User::findOrFail($id);
        $user->id_role  = $request->role;
        $user->nama     = $request->nama;
        $user->nip      = $request->nip;
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->update();

        Alert::success('Sukses', 'Data berhasil diubah.');

        return redirect('user/'.$user->id);
    }

    public function update_role(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->id_role  = $request->id_role;
        $user->update();

        Alert::success('Sukses', 'Data berhasil diubah.');

        return redirect('user/'.$user->id);
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
