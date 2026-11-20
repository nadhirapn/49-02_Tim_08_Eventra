<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    // Admin lihat semua data, user hanya datanya sendiri
    public function index()
    {
        $user = Auth::user();

        $data = $user->isAdmin()
            ? Peserta::orderBy('id')->get()
            : Peserta::where('user_id', $user->id)->orderBy('id')->get();

        return view("peserta.index", compact('data'));
    }

    // User hanya boleh membuka form kalau belum punya data
    public function create()
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $user->peserta) {
            return redirect()->route("peserta.index")
                ->with("error", "Kamu sudah mengisi data peserta.");
        }

        return view("peserta.form", ["peserta" => null]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->isAdmin() && $user->peserta) {
            abort(403, "Kamu sudah mengisi data peserta.");
        }

        $data = $request->validate($this->rules());

        // user_id diisi dari akun yang login, bukan dari form
        if (!$user->isAdmin()) {
            $data['user_id'] = $user->id;
        }

        Peserta::create($data);

        return redirect()->route("peserta.index")->with("success", "Data berhasil ditambahkan");
    }

    // edit, update, destroy hanya bisa dibuka admin (dikunci di route)
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