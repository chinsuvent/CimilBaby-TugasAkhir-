<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Anak;

class AnakPelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Auth::user();
        $anak = Anak::where('users_id', $pelanggan->id)->paginate(10);
        return view('pelanggan.anak', compact('pelanggan', 'anak'));
    }

    public function simpanAnak(Request $request)
    {
        $pelanggan = Auth::user();

        // Validasi data
        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'nullable|numeric|min:0',
            'alergi' => 'nullable|string|max:255',
        ]);

        $pelanggan->anak()->create($validated);

        return redirect()->route('pelanggan.anak')->with('added', 'Data anak berhasil ditambahkan.');
    }


    public function tambahAnak(Request $request)
    {
        return view('pelanggan.tambahAnak');
    }

    public function editAnak($id)
    {
        $pelanggan = Auth::user();
        $anak = $pelanggan->anak()->findOrFail($id);

        return view('pelanggan.editAnak', compact('anak'));
    }

    public function updateAnak(Request $request, $id)
    {
        $pelanggan = Auth::user();
        $anak = $pelanggan->anak()->findOrFail($id);

        $validated = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'usia' => 'nullable|numeric|min:0',
            'alergi' => 'nullable|string|max:255',
        ]);

        $anak->update($validated);

        return redirect()->route('pelanggan.anak')->with('edited', 'Data anak berhasil diupdate.');
    }

    public function hapusAnak($id)
    {
        $pelanggan = Auth::user();
        $anak = $pelanggan->anak()->findOrFail($id);

        $anak->delete();

        return redirect()->back()->with('delete', 'Data anak berhasil dihapus.');
    }
}
