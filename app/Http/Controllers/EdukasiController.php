<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::orderBy('created_at', 'desc')->get();

        return view('edukasi.index', compact('edukasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_artikel'             => 'required|string|max:150',
            'kategori_gangguan_tidur'   => 'required|string|in:healthy,insomnia,sleep_apnea',
            'jenis_edukasi'             => 'required|string|in:informasi_umum,gejala,penyebab,penanganan,tips_tidur,pencegahan',
            'ringkasan'                 => 'required|string|max:500',
            'isi_artikel'               => 'required|string',
            'tips_penanganan'           => 'nullable|string',
            'saran_konsultasi'          => 'nullable|string',
            'penulis'                   => 'nullable|string|max:100',
            'estimasi_waktu_baca'       => 'nullable|string|max:50',
            'status_publish'            => 'nullable',
            'gambar_artikel'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $gambarPath = null;

            if ($request->hasFile('gambar_artikel')) {
                $gambarPath = $request->file('gambar_artikel')->storePublicly('edukasi', 'public');
            }

            $edukasi = Edukasi::create([
                'judul_artikel'           => $validated['judul_artikel'],
                'kategori_gangguan_tidur' => $validated['kategori_gangguan_tidur'],
                'jenis_edukasi'           => $validated['jenis_edukasi'],
                'ringkasan'               => $validated['ringkasan'],
                'isi_artikel'             => $validated['isi_artikel'],
                'gambar_artikel'          => $gambarPath,
                'tips_penanganan'         => $this->formatTipsPenanganan($request->tips_penanganan),
                'saran_konsultasi'        => $request->saran_konsultasi,
                'penulis'                 => $request->penulis ?: 'Admin Noctura',
                'estimasi_waktu_baca'     => $request->estimasi_waktu_baca ?: '3 menit',
                'status_publish'          => $request->boolean('status_publish'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Artikel edukasi berhasil ditambahkan.',
                'data'    => $edukasi->fresh(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan edukasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul_artikel'             => 'required|string|max:150',
            'kategori_gangguan_tidur'   => 'required|string|in:healthy,insomnia,sleep_apnea',
            'jenis_edukasi'             => 'required|string|in:informasi_umum,gejala,penyebab,penanganan,tips_tidur,pencegahan',
            'ringkasan'                 => 'required|string|max:500',
            'isi_artikel'               => 'required|string',
            'tips_penanganan'           => 'nullable|string',
            'saran_konsultasi'          => 'nullable|string',
            'penulis'                   => 'nullable|string|max:100',
            'estimasi_waktu_baca'       => 'nullable|string|max:50',
            'status_publish'            => 'nullable',
            'gambar_artikel'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $edukasi = Edukasi::findOrFail($id);

            $data = [
                'judul_artikel'           => $validated['judul_artikel'],
                'kategori_gangguan_tidur' => $validated['kategori_gangguan_tidur'],
                'jenis_edukasi'           => $validated['jenis_edukasi'],
                'ringkasan'               => $validated['ringkasan'],
                'isi_artikel'             => $validated['isi_artikel'],
                'tips_penanganan'         => $this->formatTipsPenanganan($request->tips_penanganan),
                'saran_konsultasi'        => $request->saran_konsultasi,
                'penulis'                 => $request->penulis ?: 'Admin Noctura',
                'estimasi_waktu_baca'     => $request->estimasi_waktu_baca ?: '3 menit',
                'status_publish'          => $request->boolean('status_publish'),
            ];

            if ($request->hasFile('gambar_artikel')) {
                if ($edukasi->gambar_artikel) {
                    Storage::disk('public')->delete($edukasi->gambar_artikel);
                }

                $data['gambar_artikel'] = $request->file('gambar_artikel')->storePublicly('edukasi', 'public');
            }

            $edukasi->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Artikel edukasi berhasil diperbarui.',
                'data'    => $edukasi->fresh(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui edukasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $edukasi = Edukasi::find($id);

            if (!$edukasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data edukasi tidak ditemukan.',
                ], 404);
            }

            if ($edukasi->gambar_artikel) {
                Storage::disk('public')->delete($edukasi->gambar_artikel);
            }

            $edukasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Artikel edukasi berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus edukasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function formatTipsPenanganan($tips)
    {
        if (!$tips) return [];

        return collect(preg_split("/\r\n|\n|\r/", $tips))
            ->map(fn($item) => trim($item))
            ->filter()
            ->values()
            ->toArray();
    }
}
