<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::all();
        return view('edukasi.index', compact('edukasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string',
            'category' => 'required',
            'content'  => 'required',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('image')) {
                // storePublicly → set visibility = public → tidak 403
                $imagePath = $request->file('image')->storePublicly('edukasi', 'public');
            }

            $tags = $request->tags;
            if (is_string($tags)) {
                $tags = array_map('trim', explode(',', $tags));
            }

            $edukasi = Edukasi::create([
                'title'        => $request->title,
                'category'     => $request->category,
                'summary'      => $request->summary,
                'content'      => $request->content,
                'image_url'    => $imagePath,
                'author'       => $request->author ?? 'Admin',
                'tags'         => $tags ?: [],
                'read_time'    => $request->read_time,
                'is_published' => $request->is_published ? true : false,
            ]);

            return response()->json([
                'success' => true,
                'data'    => $edukasi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $edukasi = Edukasi::findOrFail($id);

            $data = $request->except(['_method', '_token']);

            if (isset($data['tags']) && is_string($data['tags'])) {
                $data['tags'] = array_map('trim', explode(',', $data['tags']));
            }

            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($edukasi->image_url) {
                    Storage::disk('public')->delete($edukasi->image_url);
                }
                // storePublicly → visibility = public
                $data['image_url'] = $request->file('image')->storePublicly('edukasi', 'public');
            }

            $edukasi->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'data'    => $edukasi->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $edukasi = Edukasi::where('_id', $id)->first();

            if (!$edukasi) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            // Hapus file gambar juga saat delete data
            if ($edukasi->image_url) {
                Storage::disk('public')->delete($edukasi->image_url);
            }

            $edukasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
