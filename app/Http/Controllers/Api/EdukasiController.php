<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EdukasiController extends Controller
{
    /**
     * GET /api/edukasi
     * Get all edukasi with filtering
     */
    public function index(Request $request)
    {
        $query = Edukasi::query();

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        // Filter by status published/draft
        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        // Search by title, summary, or content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Pagination or all
        if ($request->filled('per_page')) {
            $edukasi = $query->orderBy('created_at', 'desc')->paginate($request->per_page);
        } else {
            $edukasi = $query->orderBy('created_at', 'desc')->get();
        }

        $stats = [
            'total' => Edukasi::count(),
            'published' => Edukasi::where('is_published', true)->count(),
            'draft' => Edukasi::where('is_published', false)->count(),
            'by_category' => [
                'Healthy' => Edukasi::where('category', 'Healthy')->count(),
                'Insomnia' => Edukasi::where('category', 'Insomnia')->count(),
                'Sleep Apnea' => Edukasi::where('category', 'Sleep Apnea')->count(),
            ]
        ];

        return response()->json([
            'success' => true,
            'stats' => $stats,
            'data' => $edukasi
        ]);
    }

    /**
     * GET /api/edukasi/{id}
     * Get single edukasi detail
     */
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

    /**
     * POST /api/edukasi
     * Create new edukasi with image upload
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Healthy,Insomnia,Sleep Apnea',
            'content' => 'required|string',
            'summary' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'read_time' => 'nullable|string|max:50',
            'is_published' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except(['image', 'tags']);

        // Process tags (convert string to array)
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $data['tags'] = [];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('edukasi-images', $filename, 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $edukasi = Edukasi::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Edukasi berhasil ditambahkan.',
            'data' => $edukasi
        ], 201);
    }

    /**
     * PUT /api/edukasi/{id}
     * Update existing edukasi
     */
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
            'title' => 'required|string|max:255',
            'category' => 'required|in:Healthy,Insomnia,Sleep Apnea',
            'content' => 'required|string',
            'summary' => 'nullable|string',
            'author' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'read_time' => 'nullable|string|max:50',
            'is_published' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $data = $request->except(['image', 'tags', '_method']);

        // Process tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        } else {
            $data['tags'] = [];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($edukasi->image_url) {
                $oldPath = str_replace('/storage/', '', $edukasi->image_url);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('edukasi-images', $filename, 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $edukasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Edukasi berhasil diperbarui.',
            'data' => $edukasi->fresh()
        ]);
    }

    /**
     * DELETE /api/edukasi/{id}
     * Delete edukasi
     */
    public function destroy($id)
    {
        $edukasi = Edukasi::find($id);

        if (!$edukasi) {
            return response()->json([
                'success' => false,
                'message' => 'Edukasi tidak ditemukan.'
            ], 404);
        }

        // Delete image file if exists
        if ($edukasi->image_url) {
            $oldPath = str_replace('/storage/', '', $edukasi->image_url);
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

    /**
     * GET /api/edukasi/published
     * Get only published edukasi (for public frontend)
     */
    public function published(Request $request)
    {
        $query = Edukasi::where('is_published', true);

        if ($request->filled('kategori')) {
            $query->where('category', $request->kategori);
        }

        $edukasi = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'total' => $edukasi->count(),
            'data' => $edukasi
        ]);
    }

    /**
     * GET /api/edukasi/kategori/{kategori}
     * Get edukasi by category
     */
    public function byCategory($kategori)
    {
        $edukasi = Edukasi::where('category', $kategori)
            ->where('is_published', true)
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