<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//panggil model AnggotaModel
use App\Models\AnggotaModel;

class AnggotaController extends Controller
{
    //method untuk tampil data anggota
    public function Anggotatampil()
    {
        $dataanggota = AnggotaModel::orderby('id_anggota', 'ASC')
        ->paginate(5);

        return view('halaman/view_anggota',['anggota'=>$dataanggota]);
    }

    //method untuk tambah data anggota
    public function anggotatambah(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama_anggota' => 'required',
            'prodi' => 'required',
            'nomor_hp' => 'required',
        ]);

        AnggotaModel::create([
            'nim' => $request->nim,
            'nama_anggota' => $request->nama_anggota,
            'prodi' => $request->prodi,
            'nomor_hp' => $request->nomor_hp
        ]);

        return redirect('/anggota');
    }

    //method untuk hapus data anggota
    public function anggotahapus($id_anggota)
    {
        $dataanggota=AnggotaModel::find($id_anggota);
        $dataanggota->delete();

        return redirect()->back();
    }

    //method untuk edit data anggota
    public function anggotaedit($id_anggota, Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama_anggota' => 'required',
            'prodi' => 'required',
            'nomor_hp' => 'required',
        ]);

        $id_anggota = AnggotaModel::find($id_anggota);
        $id_anggota->nim = $request->nim;
        $id_anggota->nama_anggota = $request->nama_anggota;
        $id_anggota->prodi = $request->prodi;
        $id_anggota->nomor_hp = $request->nomor_hp;

        $id_anggota->save();

        return redirect()->back();
    }
}
