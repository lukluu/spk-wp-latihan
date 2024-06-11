<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Hasil;
use App\Models\Jadwal;
use App\Models\Kriteria;
use App\Models\JadwalSpk;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    public function index()
    {
        $page = 'Perhitungan';
        $dosens = Dosen::all();
        return view('admin.perhitungan.index', compact('page', 'dosens'));
    }

    public function jadwal(Request $request, $id)
    {
        $dosen = Dosen::find($id);
        $page = 'hitung';
        $jadwal = JadwalSpk::all();
        return view('admin.perhitungan.jadwal', compact('dosen', 'page', 'jadwal'));
    }

    public function input(Request $request, $id_dosen, $id_jadwal)
    {
        $dosen = Dosen::find($id_dosen);
        $jadwal = JadwalSpk::find($id_jadwal);
        $page = 'hitung';

        // Mengambil kriteria dengan penilaian yang sesuai dengan jadwal dan dosen tertentu
        $kriteria = Kriteria::with(['penilaian' => function ($query) use ($id_dosen, $id_jadwal) {
            $query->where('dosen_id', $id_dosen)->where('jadwal_spk_id', $id_jadwal);
        }])->get();

        return view('admin.perhitungan.input', compact('id_dosen', 'id_jadwal', 'dosen', 'jadwal', 'kriteria', 'page'));
    }

    public function prosesInput(Request $request, $id_dosen, $id_jadwal)
    {
        $kriteria = Kriteria::all();

        foreach ($kriteria as $k) {
            Penilaian::updateOrCreate(
                ['jadwal_spk_id' => $id_jadwal, 'kriteria_id' => $k->id, 'dosen_id' => $id_dosen],
                ['nilai' => $request->input('kriteria_' . $k->id)]
            );
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }


    public function hapus(Request $request, $id_dosen, $id_jadwal)
    {
        // Hapus semua penilaian yang sesuai dengan ID dosen dan ID jadwal

        Penilaian::where('dosen_id', $id_dosen)
            ->where('jadwal_spk_id', $id_jadwal)
            ->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
    }


    public function alternatif(Request $request)
    {

        $page = 'Alternatif';
        $dosens = Dosen::all();
        $jadwals = JadwalSpk::all();
        $selectedDosen = null;
        $penilaians = [];
        $kriterias = Kriteria::all();

        if ($request->has('dosen_id')) {
            $selectedDosen = Dosen::find($request->input('dosen_id'));
            $penilaians = Penilaian::where('dosen_id', $selectedDosen->id)->get();
        }

        return view('admin.perhitungan.alternatif', compact('dosens', 'selectedDosen', 'penilaians', 'kriterias', 'page', 'jadwals'));
    }



    public function vektor(Request $request)
    {
        $page = 'Vektor';

        // Retrieve all dosens
        $dosens = Dosen::all();

        // Check if a dosen is selected
        $selectedDosen = null;
        $vectorS = [];
        $vektorHasil = [];

        if ($request->has('dosen_id')) {
            $selectedDosen = Dosen::find($request->input('dosen_id'));

            if ($selectedDosen) {
                // Retrieve the criteria and their weights
                $kriteria = Kriteria::whereHas('penilaian', function ($query) use ($selectedDosen) {
                    $query->where('dosen_id', $selectedDosen->id);
                })->get();

                // Calculate the normalized weights
                $totalWeight = $kriteria->sum('bobot');
                $normalizedWeights = [];
                foreach ($kriteria as $k) {
                    $normalizedWeights[$k->id] = $k->bobot / $totalWeight;
                }

                // Retrieve the alternatives and their values for each criterion for the selected dosen
                $alternatif = JadwalSpk::with(['penilaian' => function ($query) use ($selectedDosen) {
                    $query->where('dosen_id', $selectedDosen->id);
                }])->get();

                // Calculate vector S and vektor hasil
                $totalS = 0;
                foreach ($alternatif as $alt) {
                    $score = 1;
                    foreach ($alt->penilaian as $penilaian) {
                        $kriteriaId = $penilaian->kriteria_id;
                        $nilai = $penilaian->nilai;
                        $score *= pow($nilai, $normalizedWeights[$kriteriaId]);
                    }
                    $totalS += $score;
                    $vectorS[] = [
                        'alternatif' => $alt,
                        'score' => $score
                    ];
                }

                // Calculate vektor hasil
                foreach ($vectorS as $vek) {
                    $vektorHasil[] = [
                        'alternatif' => $vek['alternatif'],
                        'nilai_akhir' => $vek['score'] / $totalS
                    ];
                }

                // Sort the alternatives based on their scores
                usort($vectorS, function ($a, $b) {
                    return $b['score'] <=> $a['score'];
                });
            }
        }

        return view('admin.perhitungan.vektor', compact('page', 'dosens', 'selectedDosen', 'vectorS', 'vektorHasil'));
    }

    public function normalisasi(Request $request)
    {
        $page = 'Normalisasi';

        // Retrieve all dosens
        $dosens = Dosen::all();

        // Check if a dosen is selected
        $selectedDosen = null;
        $normalizedWeights = [];

        if ($request->has('dosen_id')) {
            $selectedDosen = Dosen::find($request->input('dosen_id'));

            if ($selectedDosen) {
                // Retrieve the criteria and their weights
                $kriteria = Kriteria::whereHas('penilaian', function ($query) use ($selectedDosen) {
                    $query->where('dosen_id', $selectedDosen->id);
                })->get();

                // Calculate the normalized weights
                $totalWeight = $kriteria->sum('bobot');
                foreach ($kriteria as $k) {
                    $normalizedWeight = $k->bobot / $totalWeight;
                    $normalizedWeights[] = [
                        'kriteria' => $k,
                        'bobot_normalisasi' => $normalizedWeight
                    ];
                }
            }
        }

        return view('admin.perhitungan.normalisasi', compact('page', 'dosens', 'selectedDosen', 'normalizedWeights'));
    }

    public function saveHasil(Request $request)
    {
        $dosen_id = $request->input('dosen_id');
        $hasilData = $request->input('hasil');

        foreach ($hasilData as $hasil) {
            $decodedHasil = json_decode($hasil, true);

            Hasil::create([
                'jadwal_spk_id' => $decodedHasil['alternatif']['id'], // Adjust this as per your alternative's name attribute
                'dosen_id' => $dosen_id,
                'nilai_akhir' => $decodedHasil['nilai_akhir']
            ]);
        }

        // Update the results_saved flag
        $dosen = Dosen::find($dosen_id);
        $dosen->results_saved = true;
        $dosen->save();

        return redirect()->back()->with('success', 'Hasil berhasil disimpan.');
    }







    public function hasil(Request $request)
    {
        $page = 'Hasil';

        // Retrieve all dosens for the filter dropdown
        $dosens = Dosen::all();

        // Check if a dosen is selected
        $selectedDosenId = $request->input('dosen_id');

        // Retrieve results and filter by the selected dosen if specified
        if ($selectedDosenId) {
            $hasils = Hasil::with('jadwal_spk', 'dosen')
                ->where('dosen_id', $selectedDosenId)
                ->orderBy('nilai_akhir', 'desc')
                ->get();
        } else {
            $hasils = Hasil::with('jadwal_spk', 'dosen')
                ->orderBy('nilai_akhir', 'desc')
                ->get();
        }

        return view('admin.perhitungan.hasil', compact('page', 'dosens', 'hasils', 'selectedDosenId'));
    }
}
