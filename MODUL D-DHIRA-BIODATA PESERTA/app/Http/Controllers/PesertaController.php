<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    private function rules(): array
    {
        return [
            "nama"      => "required|string|max:100",
            "nim"       => "required|string|max:20",
            "instansi"  => "required|string|max:100",
            "no_kontak" => "required|string|max:20",
            "email"     => "required|email|max:100",
        ];
    }
    public function index()
    {
        $data = Peserta::orderBy('id')-> get();
        return view("peserta.index", compact('data'));
    }
    public function create()
    {
        return view("peserta.form", ["peserta" => null]);
    }
    public function store(Request $request)
    {
        Peserta::create($request->validate($this->rules()));
        return redirect()->route("peserta.index")->with("success", "Data berhasil ditambahkan");
    }
    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view("peserta.form", compact("peserta"));
    }
    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->update($request->validate($this->rules()));
        return redirect()->route("peserta.index")->with("success", "Data berhasil diupdate");
    }
    public function destroy($id)
    {
        Peserta::findOrFail($id)->delete();
        return redirect()->route("peserta.index")->with("success", "Data berhasil dihapus");
    }
}
