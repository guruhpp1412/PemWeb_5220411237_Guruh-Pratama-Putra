<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//panggil model PetugasModel
use App\Models\PetugasModel;

class PetugasController extends Controller
{
    //method untuk tampil data petugas
    public function Petugastampil()
    {
        $datapetugas = PetugasModel::orderby('id_petugas', 'ASC')
        ->paginate(5);

        return view('halaman/view_petugas',['petugas'=>$datapetugas]);
    }

    //method untuk tambah data anggota
    public function petugastambah(Request $request)
    {
        $this->validate($request, [
            'nama_petugas' => 'required',
            'nomor_hp' => 'required'
        ]);

        PetugasModel::create([
            'nama_petugas' => $request->nama_petugas,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return redirect('/petugas');
    }

    //method untuk hapus data petugas
    public function petugashapus($id_petugas)
    {
        $datapetugas=PetugasModel::find($id_petugas);
        $datapetugas->delete();

        return redirect()->back();
    }

    //method untuk edit data petugas
    public function petugasedit($id_petugas, Request $request)
    {
        $this->validate($request, [
            'nama_petugas' => 'required',
            'nomor_hp' => 'required'
        ]);

        $id_petugas = PetugasModel::find($id_petugas);
        $id_petugas->nama_petugas = $request->nama_petugas;
        $id_petugas->nomor_hp = $request->nomor_hp;

        $id_petugas->save();

        return redirect()->back();
    }
}
