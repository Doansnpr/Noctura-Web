<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EdukasiController extends Controller
{
    // GET /api/edukasi
    public function index(Request $request)
    {
        $query = Edukasi::query();

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_gangguan_tidur', $request->kategori);
        }

        // Filter by status published/draft
        if ($request->filled('status')) {
            $query->where('status_publish', $request->status === 'published');
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul_artikel', 'like', "%{$search}%")
                  ->orWhere('ringkasan', 'like', "%{$search}%")
                  ->orWhere('isi_artikel', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
            });
        }

        if ($request->filled('per_page')) {
            $edukasi = $query->orderBy('created_at', 'desc')->paginate($request->per_page);
        } else {
            $edukasi = $query->orderBy('created_at', 'desc')->get();
        }

        $stats = [
            'total' => Edukasi::count(),
            'published' => Edukasi::where('status_publish', true)->count(),
            'draft' => Edukasi::where('status_publish', false)->count(),
            'by_category' => [
                'Healthy' => Edukasi::where('kategori_gangguan_tidur', 'healthy')->count(),
                'Insomnia' => Edukasi::where('kategori_gangguan_tidur', 'insomnia')->count(),
                'Sleep Apnea' => Edukasi::where('kategori_gangguan_tidur', 'sleep_apnea')->count(),
            ]
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats,
            'data' => $edukasi
        ]);
    }

    // GET /api/edukasi/{id}
    public function show($id)
    {
        $edukasi = Edukasi::find($id);

        if (!$edukasi) {
            return response()->json([
                'success' => false,
                'message' => 'Edukasi tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $edukasi
        ]);
    }

    // POST /api/edukasi
    public function store(Request $request)
    {
        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'kategori_gangguan_tidur' => 'required|in:insomnia,sleep_apnea,healthy',
            'jenis_edukasi' => 'required|in:informasi_umum,tips_tidur_sehat,penanganan_medis',
            'isi_artikel' => 'required|string',
            'ringkasan' => 'nullable|string',
            'penulis' => 'nullable|string|max:100',
            'tips_penanganan' => 'nullable|array',
            'saran_konsultasi' => 'nullable|string',
            'estimasi_waktu_baca' => 'nullable|string',
            'status_publish' => 'boolean',
            'gambar_artikel' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except(['gambar_artikel', 'tips_penanganan']);

        if ($request->has('tips_penanganan')) {
            $data['tips_penanganan'] = $request->tips_penanganan;
        } else {
            $data['tips_penanganan'] = [];
        }

        if ($request->hasFile('gambar_artikel')) {
            $file = $request->file('gambar_artikel');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('edukasi-images', $filename, 'public');
            $data['gambar_artikel'] = '/storage/' . $path;
        }

        $edukasi = Edukasi::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Edukasi berhasil ditambahkan.',
            'data' => $edukasi
        ], 201);
    }

    // PUT /api/edukasi/{id}
    public function update(Request $request, $id)
    {
        $edukasi = Edukasi::find($id);

        if (!$edukasi) {
            return response()->json([
                'success' => false,
                'message' => 'Edukasi tidak ditemukan.'
            ], 404);
        }

        $request->validate([
            'judul_artikel' => 'required|string|max:255',
            'kategori_gangguan_tidur' => 'required|in:insomnia,sleep_apnea,healthy',
            'jenis_edukasi' => 'required|in:informasi_umum,tips_tidur_sehat,penanganan_medis',
            'isi_artikel' => 'required|string',
            'ringkasan' => 'nullable|string',
            'penulis' => 'nullable|string|max:100',
            'tips_penanganan' => 'nullable|array',
            'saran_konsultasi' => 'nullable|string',
            'estimasi_waktu_baca' => 'nullable|string',
            'status_publish' => 'boolean',
            'gambar_artikel' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except(['gambar_artikel', 'tips_penanganan', '_method']);

        if ($request->has('tips_penanganan')) {
            $data['tips_penanganan'] = $request->tips_penanganan;
        }

        if ($request->hasFile('gambar_artikel')) {
            if ($edukasi->gambar_artikel) {
                $oldPath = str_replace('/storage/', '', $edukasi->gambar_artikel);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $file = $request->file('gambar_artikel');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('edukasi-images', $filename, 'public');
            $data['gambar_artikel'] = '/storage/' . $path;
        }

        $edukasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Edukasi berhasil diperbarui.',
            'data' => $edukasi->fresh()
        ]);
    }

    // DELETE /api/edukasi/{id}
    public function destroy($id)
    {
        $edukasi = Edukasi::find($id);

        if (!$edukasi) {
            return response()->json([
                'success' => false,
                'message' => 'Edukasi tidak ditemukan.'
            ], 404);
        }

        if ($edukasi->gambar_artikel) {
            $oldPath = str_replace('/storage/', '', $edukasi->gambar_artikel);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $edukasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Edukasi berhasil dihapus.'
        ]);
    }

    // GET /api/edukasi/published
    public function published(Request $request)
    {
        $query = Edukasi::where('status_publish', true);

        if ($request->filled('kategori')) {
            $query->where('kategori_gangguan_tidur', $request->kategori);
        }

        $edukasi = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'total' => $edukasi->count(),
            'data' => $edukasi
        ]);
    }

    // GET /api/edukasi/kategori/{kategori}
    public function byCategory($kategori)
    {
        $edukasi = Edukasi::where('kategori_gangguan_tidur', $kategori)
            ->where('status_publish', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'category' => $kategori,
            'total' => $edukasi->count(),
            'data' => $edukasi
        ]);
    }
}