<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\ShiftHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;
        $shift     = $request->shift;

        // MINGGU BERJALAN (DEFAULT)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $endOfWeek   = Carbon::now()->endOfWeek(Carbon::SUNDAY);

        $baseQuery = Barang::query();

        /**
         * ==========================
         * FILTER RENTANG TANGGAL
         * ==========================
         */
        if ($startDate && $endDate) {

            $from = Carbon::parse($startDate)->startOfDay();
            $to   = Carbon::parse($endDate)->endOfDay();

            // VALIDASI: MAKS 7 HARI
            if ($from->diffInDays($to) > 6) {
                return back()->withErrors([
                    'start_date' => 'Rentang tanggal maksimal 7 hari'
                ]);
            }

            $baseQuery->whereBetween('created_at', [$from, $to]);

        } else {
            // DEFAULT: minggu berjalan
            $baseQuery->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }

        // FILTER SHIFT
        if ($shift) {
            $baseQuery->where('shift', $shift);
        }


        /**
         * ==========================
         * DATA TERBARU
         * ==========================
         */
        $getbarang = (clone $baseQuery)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        /**
         * ==========================
         * REKAP PER SHIFT
         * ==========================
         */
        $totalshift1 = (clone $baseQuery)
            ->where('shift', 'Shift 1')
            ->sum(DB::raw('chargis_to - chargis_from + 1'));

        $totalshift2 = (clone $baseQuery)
            ->where('shift', 'Shift 2')
            ->sum(DB::raw('chargis_to - chargis_from + 1'));

        $totalshift3 = (clone $baseQuery)
            ->where('shift', 'Shift 3')
            ->sum(DB::raw('chargis_to - chargis_from + 1'));

        $totalAll = $totalshift1 + $totalshift2 + $totalshift3;

        return view('pageadmin.dashboard.index', compact(
            'getbarang',
            'totalshift1',
            'totalshift2',
            'totalshift3',
            'totalAll'
        ));
    }

    /* =====================================================
     * CRUD LAIN (TIDAK DIUBAH)
     * ===================================================== */

    public function create()
    {
        return view('pageadmin.dashboard.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_barang'    => 'required',
            'line_code'    => 'required',
            'chargis_from' => 'required|numeric',
            'chargis_to'   => 'required|numeric',
            'info'         => 'nullable'
        ]);

        $exists = Barang::where('no_barang', $request->no_barang)
            ->where(function ($q) use ($request) {
                $q->where('chargis_from', '<=', $request->chargis_to)
                ->where('chargis_to', '>=', $request->chargis_from);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'chargis_from' => 'Range chargis sudah pernah diproses'
            ])->withInput();
        }

        if ($request->chargis_from > $request->chargis_to) {
            return back()->withErrors([
                'chargis_from' => 'Chargis From tidak boleh lebih besar dari Chargis To'
            ])->withInput();
        }

        Barang::create([
            'no_barang'    => $request->no_barang,
            'line_code'    => $request->line_code,
            'chargis_from' => $request->chargis_from,
            'chargis_to'   => $request->chargis_to,
            'shift'        => ShiftHelper::getShift(),
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

        $exists = Barang::where('no_barang', $request->no_barang)
            ->where('id', '!=', $id) // ⬅️ PENTING
            ->where(function ($q) use ($request) {
                $q->where('chargis_from', '<=', $request->chargis_to)
                ->where('chargis_to', '>=', $request->chargis_from);
            })
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'chargis_from' => 'Range chargis sudah pernah diproses'
            ])->withInput();
        }

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
        Barang::findOrFail($id)->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('admin.dashboard');
    }
}
