<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa_Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
        return view('mahasiswa.index', [
            'mahasiswa' => $paginate
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->search;

        $mahasiswa = Mahasiswa::where('nama', 'like', "%" . $keyword . "%")->paginate(3);
        return view('mahasiswa.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi Data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tgl_lahir' => 'required',
            'foto' => 'required',
        ]);
        // End Validasi Data

        $imageName = '';

        if ($request->file('foto')) {
            $imageName = $request->file('foto')->store('images', 'public');
        }

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tgl_lahir = $request->get('Tgl_lahir');
        $mahasiswa->save();
        $mahasiswa->featured_image = $imageName;

        $kelas = new Kelas;
        $kelas->id = request('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index') //jika data berhasil ditambahkan kembali ke hal. utama
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //Menampilkan data dengan menemukan nim mahasiswa 
        //kode sebelum dibuat relasi --> $Mahasiswa = Mahasiswa::->where('nim', $Nim)->first(); 
        $Mahasiswa = Mahasiswa::with('Kelas')->where('nim', $Nim)->first();
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //Menampilkan data dengan menemukan nim yang pertama untuk diedit
        $Mahasiswa = Mahasiswa::with('Kelas')->where('Nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //Validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'Email' => 'required',
            'Alamat' => 'required',
            'Tgl_lahir' => 'required',
            'foto' => 'required',
        ]);

        $mahasiswa = Mahasiswa::with('Kelas')->where('nim', $Nim)->first();

        if ($mahasiswa->featured_image && file_exists(storage_path('app/public' . $mahasiswa->featured_image))) {
            Storage::delete('public/' . $mahasiswa->featured_image);
        }

        $imageName = $request->file('foto')->store('images', 'public');

        $mahasiswa->featured_image = $imageName;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->tgl_lahir = $request->get('Tgl_lahir');
        $mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = request('Kelas');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        Mahasiswa::where('nim', $Nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function nilai($id_mhs)
    {
        $mhsMatkul = Mahasiswa_Matakuliah::with('matakuliah')
            ->where('mahasiswa_id', $id_mhs)->get();
        $mhsMatkul->mahasiswa = Mahasiswa::with('kelas')
            ->where('id_mahasiswa', $id_mhs)->first();

        return view('mahasiswa.nilai', compact('mhsMatkul'));
    }
}
