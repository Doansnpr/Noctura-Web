<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Storage;
>>>>>>> 78445fc8f47ac16ef762062ba42d98ef9ab7ba15

class EdukasiController extends Controller
{
    public function index()
    {
        $edukasi = Edukasi::all();
        return view('edukasi.index', compact('edukasi'));
    }

<<<<<<< HEAD
=======
    

>>>>>>> 78445fc8f47ac16ef762062ba42d98ef9ab7ba15
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required',
            'content' => 'required',
<<<<<<< HEAD
        ]);

        try {
            // Pastikan tags selalu menjadi array
=======
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('edukasi', 'public');
            }

>>>>>>> 78445fc8f47ac16ef762062ba42d98ef9ab7ba15
            $tags = $request->tags;
            if (is_string($tags)) {
                $tags = array_map('trim', explode(',', $tags));
            }

            $edukasi = Edukasi::create([
                'title'        => $request->title,
                'category'     => $request->category,
                'summary'      => $request->summary,
                'content'      => $request->content,
<<<<<<< HEAD
                'image_url'    => $request->image_url,
                'author'       => $request->author ?? 'Admin',
                'tags'         => $tags ?: [], // Jika kosong kasih array kosong
                'read_time'    => $request->read_time,
                'is_published' => filter_var($request->is_published, FILTER_VALIDATE_BOOLEAN),
=======
                'image_url'    => $imagePath, // simpan path
                'author'       => $request->author ?? 'Admin',
                'tags'         => $tags ?: [],
                'read_time'    => $request->read_time,
                'is_published' => $request->is_published ? true : false,
>>>>>>> 78445fc8f47ac16ef762062ba42d98ef9ab7ba15
            ]);

            return response()->json([
                'success' => true,
<<<<<<< HEAD
                'message' => 'Data berhasil disimpan',
                'data'    => $edukasi
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
=======
                'data' => $edukasi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
>>>>>>> 78445fc8f47ac16ef762062ba42d98ef9ab7ba15
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $edukasi = Edukasi::findOrFail($id);
            $data = $request->all();

            // Pastikan tags dikirim sebagai array ke MongoDB
            if (isset($data['tags']) && is_string($data['tags'])) {
                $data['tags'] = array_map('trim', explode(',', $data['tags']));
            }

<<<<<<< HEAD
=======
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('edukasi', 'public');
                $data['image_url'] = $imagePath;
            }
            
>>>>>>> 78445fc8f47ac16ef762062ba42d98ef9ab7ba15
            $edukasi->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'data'    => $edukasi->fresh()
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Mencari data berdasarkan ID string yang dikirim JS
            $edukasi = Edukasi::where('_id', $id)->first();

            if (!$edukasi) {
                return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
            }

            $edukasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
