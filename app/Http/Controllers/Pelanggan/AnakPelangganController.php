<?php
namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Anak;
use RealRashid\SweetAlert\Facades\Alert; 

class AnakPelangganController extends Controller
{
    public function index()
    {
        $orangTua = Auth::user()->orangTua;
        $anak = Anak::where('orang_tua_id', $orangTua->id)->paginate(10);

        return view('pelanggan.anak', compact('orangTua', 'anak'));
    }

public function simpanAnak(Request $request)
{
    $orangTua = Auth::user()->orangTua;

    $validated = $request->validate([
        'nama_anak' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'usia' => 'nullable|numeric|min:0',
        'alergi' => 'nullable|string|max:255',
    ]);

    $tanggalLahir = \Carbon\Carbon::parse($validated['tanggal_lahir']);
    $usiaDalamBulan = $tanggalLahir->diffInMonths(\Carbon\Carbon::now());

    if ($usiaDalamBulan < 3 || $usiaDalamBulan > 60) {
        return redirect()->back()
            ->with('error', 'Usia anak harus antara 3 bulan hingga 5 tahun.')
            ->withInput();
    }

    $orangTua->anaks()->create($validated);

    return redirect()->route('pelanggan.anak')
        ->with('success', 'Data anak berhasil ditambahkan.');
}




    public function tambahAnak(Request $request)
    {
        return view('pelanggan.tambahAnak');
    }

    public function editAnak($id)
    {
        $pelanggan = Auth::user();
        $anak = $pelanggan->orangTua->anaks()->findOrFail($id);

        return view('pelanggan.editAnak', compact('anak'));
    }

    public function updateAnak(Request $request)
{
    $orangTua = Auth::user()->orangTua;

    $validated = $request->validate([
        'nama_anak' => 'required|string|max:255',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'usia' => 'nullable|numeric|min:0',
        'alergi' => 'nullable|string|max:255',
    ]);

    $tanggalLahir = \Carbon\Carbon::parse($validated['tanggal_lahir']);
    $usiaDalamBulan = $tanggalLahir->diffInMonths(\Carbon\Carbon::now());

    if ($usiaDalamBulan < 3 || $usiaDalamBulan > 60) {
        return redirect()->back()
            ->with('error', 'Usia anak harus antara 3 bulan hingga 5 tahun.')
            ->withInput();
    }

    $orangTua->anaks()->create($validated);

    return redirect()->route('pelanggan.anak')
        ->with('edited', 'Data anak berhasil diubah.');
}




    public function hapusAnak($id)
    {
        $pelanggan = Auth::user();
        $anak = $pelanggan->orangTua->anaks()->findOrFail($id);

        $anak->delete();

        return redirect()->back()->with('deleted', 'Data anak berhasil dihapus.');
    }
}
