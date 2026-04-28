<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JawabanRequest;
use App\Models\Jawaban;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
    public function index(Request $request)
    {
        $query = Jawaban::query();
        if ($request->filled('tipe')) $query->where('tipe', $request->tipe);
        if ($request->filled('pertanyaan_id')) $query->where('pertanyaan_id', (int) $request->pertanyaan_id);
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) => $q->where('label', 'like', "%{$s}%")->orWhere('unit', 'like', "%{$s}%"));
        }
        $jawaban = $query->orderBy('pertanyaan_id')->get();
        $stats = [
            'total'        => $jawaban->count(),
            'total_select' => $jawaban->where('tipe', 'select')->count(),
            'total_range'  => $jawaban->where('tipe', 'range')->count(),
            'total_opsi'   => $jawaban->where('tipe', 'select')->sum(fn($j) => is_array($j->opsi) ? count($j->opsi) : 0),
        ];
        return response()->json(['status' => true, 'stats' => $stats, 'data' => $jawaban]);
    }

    public function show(string $id)
    {
        $jawaban = Jawaban::find($id);
        if (!$jawaban) return response()->json(['status' => false, 'message' => 'Jawaban tidak ditemukan.'], 404);
        return response()->json(['status' => true, 'data' => $jawaban]);
    }

    public function store(JawabanRequest $request)
    {
        $exists = Jawaban::where('pertanyaan_id', $request->pertanyaan_id)->first();
        if ($exists) return response()->json(['status' => false, 'message' => 'Jawaban untuk pertanyaan ini sudah ada. Gunakan endpoint update.'], 409);
        $jawaban = Jawaban::create($this->buildData($request));
        return response()->json(['status' => true, 'message' => 'Jawaban berhasil ditambahkan.', 'data' => $jawaban], 201);
    }

    public function update(JawabanRequest $request, string $id)
    {
        $jawaban = Jawaban::find($id);
        if (!$jawaban) return response()->json(['status' => false, 'message' => 'Jawaban tidak ditemukan.'], 404);
        $conflict = Jawaban::where('pertanyaan_id', $request->pertanyaan_id)->where('_id', '!=', $id)->first();
        if ($conflict) return response()->json(['status' => false, 'message' => 'Pertanyaan ini sudah memiliki jawaban lain.'], 409);
        $jawaban->update($this->buildData($request));
        return response()->json(['status' => true, 'message' => 'Jawaban berhasil diperbarui.', 'data' => $jawaban->fresh()]);
    }

    public function destroy(string $id)
    {
        $jawaban = Jawaban::find($id);
        if (!$jawaban) return response()->json(['status' => false, 'message' => 'Jawaban tidak ditemukan.'], 404);
        $jawaban->delete();
        return response()->json(['status' => true, 'message' => 'Jawaban berhasil dihapus.']);
    }

    public function byPertanyaan(int $pertanyaanId)
    {
        $jawaban = Jawaban::where('pertanyaan_id', $pertanyaanId)->first();
        if (!$jawaban) return response()->json(['status' => false, 'message' => 'Jawaban tidak ditemukan untuk pertanyaan ini.'], 404);
        return response()->json(['status' => true, 'data' => $jawaban]);
    }

    public function bulkStore(Request $request)
    {
        $request->validate(['jawaban' => 'required|array|min:1']);
        $created = []; $skipped = [];
        foreach ($request->jawaban as $item) {
            $exists = Jawaban::where('pertanyaan_id', $item['pertanyaan_id'])->first();
            if ($exists) { $skipped[] = $item['pertanyaan_id']; continue; }
            $d = ['pertanyaan_id' => $item['pertanyaan_id'], 'tipe' => $item['tipe']];
            if ($item['tipe'] === 'select') {
                $d['opsi'] = $item['opsi'] ?? [];
            } else {
                $d['range_min'] = $item['range_min'] ?? 0;
                $d['range_max'] = $item['range_max'] ?? 100;
                $d['unit']      = $item['unit'] ?? '';
                $d['label']     = $item['label'] ?? '';
            }
            $created[] = Jawaban::create($d);
        }
        return response()->json(['status' => true, 'message' => count($created).' jawaban ditambahkan, '.count($skipped).' dilewati.', 'created' => $created, 'skipped_pertanyaan_ids' => $skipped], 201);
    }

    private function buildData(JawabanRequest $request): array
    {
        $data = ['pertanyaan_id' => $request->pertanyaan_id, 'tipe' => $request->tipe];
        if ($request->tipe === 'select') {
            $data['opsi'] = $request->opsi;
            $data['range_min'] = null; $data['range_max'] = null; $data['unit'] = null; $data['label'] = null;
        } else {
            $data['range_min'] = $request->range_min;
            $data['range_max'] = $request->range_max;
            $data['unit']      = $request->input('unit', '');
            $data['label']     = $request->input('label', '');
            $data['opsi'] = null;
        }
        return $data;
    }
}