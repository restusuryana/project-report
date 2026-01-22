<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\ShiftHelper;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data (buat tabel list)
        $getbarang = Barang::orderBy('created_at', 'desc')->get();

        // OPTIONAL: kalau mau rekap per hari saja
        // $today = Carbon::today();

        /**
         * ==========================
         * REKAP SHIFT 1
         * ==========================
         */
        $barangs1 = Barang::where('shift', 'Shift 1')
            // ->whereDate('created_at', $today)
            ->get();

        $totalshift1 = 0;
        foreach ($barangs1 as $barang) {
            $selisih = abs($barang->chargis_to - $barang->chargis_from + 1);
            $totalshift1 += $selisih;
        }

        /**
         * ==========================
         * REKAP SHIFT 2
         * ==========================
         */
        $barangs2 = Barang::where('shift', 'Shift 2')
            // ->whereDate('created_at', $today)
            ->get();

        $totalshift2 = 0;
        foreach ($barangs2 as $barang) {
            $selisih = abs($barang->chargis_to - $barang->chargis_from + 1);
            $totalshift2 += $selisih;
        }

        /**
         * ==========================
         * REKAP SHIFT 3
         * ==========================
         */
        $barangs3 = Barang::where('shift', 'Shift 3')
            // ->whereDate('created_at', $today)
            ->get();

        $totalshift3 = 0;
        foreach ($barangs3 as $barang) {
            $selisih = abs($barang->chargis_to - $barang->chargis_from + 1);
            $totalshift3 += $selisih;
        }

        /**
         * ==========================
         * TOTAL KESELURUHAN
         * ==========================
         */
        $totalAll = $totalshift1 + $totalshift2 + $totalshift3;

        return view('pageadmin.dashboard.index', compact(
            'getbarang',
            'totalshift1',
            'totalshift2',
            'totalshift3',
            'totalAll'
        ));
    }

    public function create()
    {
        return view('pageadmin.dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_barang'    => 'required|unique:barangs',
            'line_code'    => 'required',
            'chargis_from' => 'required|numeric',
            'chargis_to'   => 'required|numeric',
            'info'         => 'nullable'
        ]);

        Barang::create([
            'no_barang'    => $request->no_barang,
            'line_code'    => $request->line_code,
            'chargis_from' => $request->chargis_from,
            'chargis_to'   => $request->chargis_to,
            'shift'        => ShiftHelper::getShift(), // 🔥 AUTO SHIFT
            'info'         => $request->info
        ]);

        Alert::success('Success', 'Data berhasil disimpan');
        return redirect()->route('admin.dashboard');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('pageadmin.dashboard.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_barang'    => 'required|unique:barangs,no_barang,' . $id,
            'line_code'    => 'required',
            'chargis_from' => 'required|numeric',
            'chargis_to'   => 'required|numeric',
            'info'         => 'nullable'
        ]);

        $barang = Barang::findOrFail($id);

        // SHIFT TIDAK DIUBAH (tetap sesuai waktu input awal)
        $barang->update([
            'no_barang'    => $request->no_barang,
            'line_code'    => $request->line_code,
            'chargis_from' => $request->chargis_from,
            'chargis_to'   => $request->chargis_to,
            'info'         => $request->info
        ]);

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->route('admin.dashboard');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('admin.dashboard');
    }
}
