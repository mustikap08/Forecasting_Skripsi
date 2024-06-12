<?php

namespace App\Http\Controllers;

use App\Models\Aktual;
use App\Models\Forecasting;
use App\Models\Futurecast;
use App\Models\Hasil;
use App\Models\Kategori;
use App\Models\Rumus;
use App\Models\Ujji;
use Illuminate\Http\Request;

class perhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data dari model Forecasting
        $data = Forecasting::all();

        // Menghitung jumlah data dari model Forecasting
        $checkData = Forecasting::count();

        // Menghitung jumlah data dari model Rumus
        $checkRumus = Rumus::count();

        // Menghitung jumlah data dari model Aktual
        $checkAktual = Aktual::count();

        // Menghitung jumlah data dari model Hasil
        $checkHasil = Hasil::count();

        // Mengambil semua data dari model Rumus
        $rumus = Rumus::all();

        // Mengambil semua data dari model Kategori
        $kategori = Kategori::all();

        // Mengambil semua data dari model Ujji
        $uji = Ujji::all();

        // Mengembalikan view 'Dashboard.perhitungann.perhitungan' dengan data yang sudah diambil
        // compact() untuk mengirimkan variabel ke view
        // Variabel yang dikirimkan adalah $data, $rumus, $checkData, $checkRumus, $checkAktual, $checkHasil, $kategori, dan $uji
        return view('Dashboard.perhitungann.perhitungan', compact('data', 'rumus', 'checkData', 'checkRumus', 'checkAktual', 'checkHasil', 'kategori', 'uji'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mengambil nilai input 'suburb' dan 'kategori' dari request
        $subrub = $request->input('suburb');
        $kategori = $request->input('kategori');

        // Mengambil data dari model Aktual berdasarkan 'subrub' dan 'kategori' dengan batasan 12 data terakhir
        $data = Aktual::where('subrub', $subrub)->where('kategori_id', $kategori)->take(12)->get();

        // Ambil seluruh data sales dari tabel Aktual berdasarkan financial_year dan subrub
        $formatData = Aktual::where('subrub', $subrub)
        ->where('kategori_id', $kategori)
        ->orderBy('bulan')
        ->pluck('sales', 'bulan') // Gunakan sales sebagai value dan bulan sebagai key
        ->toArray();

        // Ambil bulan dari 12 data terbaru
        $recentMonths = $data->pluck('bulan')->toArray();

        // Cari perbedaan antara bulan dari seluruh data dan 12 data terbaru
        $differences = array_diff(array_keys($formatData), $recentMonths);

        // Ambil nilai sales dan bulan yang sesuai dengan bulan yang berbeda
        $differentSales = [];
        foreach ($differences as $month) {
        $differentSales[$month] = $formatData[$month];
        }


        // dd($differentSales);

        // Lakukan iterasi pada data
        foreach ($data as $key => $item) {
            // Hitung nilai X
            $x = $key;
            // Ambil nilai Y dari kolom sales
            $y = $item->sales;
            // Hitung X^2
            $x2 = $x * $x;
            // Hitung XY
            $xy = $x * $y;
            $date = $item->bulan;
            // Simpan hasil perhitungan dalam model Perhitungan
            Forecasting::create([
                'x' => $x,
                'y' => $y,
                'x_squared' => $x2,
                'y_squared' => $xy,
                'date' => $date,
            ]);
        }

         // Masukkan nilai sales dan bulan yang berbeda ke dalam tabel Ujji
         $latestForecasting = Forecasting::orderByDesc('x')->first();
         $x = $latestForecasting->x + 1; // Mengambil nilai x dari entri terbaru dan melakukan increment

         foreach ($differentSales as $month => $sales) {
            // Konversi string tanggal menjadi objek tanggal
            $date = \Carbon\Carbon::parse($month)->toDateString();

            // Membuat entri baru di tabel Ujji dengan nilai x yang diambil dan diincrement
            Ujji::create([
                'month' => $date,
                'sales' => $sales, // Menggunakan sales dari $differentSales
                'x' => $x,
            ]);

            // Melakukan increment untuk nilai x
            $x++;
        }

        return redirect('/perhitungan');
    }

    public function forecastRecord(Request $request)
    {

        // Mengambil nilai dari model Rumus
        $olahRumus = Rumus::first();

        // Mengecek apakah nilai $olahRumus ada
        if($olahRumus) {
            // Menghitung nilai a dan b
            $a = number_format((($olahRumus->ey * $olahRumus->ex2) - ($olahRumus->ex * $olahRumus->exy)) / (($olahRumus->n * $olahRumus->ex2) - $olahRumus->ex_square), 3);
            $b = number_format((($olahRumus->n * $olahRumus->exy) - ($olahRumus->ex * $olahRumus->ey)) / (($olahRumus->n * $olahRumus->ex2) - $olahRumus->ex_square), 3);
        } else {
            $a = 0;
            $b = 0;
        }

        // Mengambil data Forecasting
        $data = Forecasting::all();

        // Melakukan perhitungan untuk setiap item dalam koleksi
        foreach ($data as $key => $item) {
            // Mengambil data dari setiap item
            $xdata = $item->x;
            $date = $item->date;
            $sales = $item->y;

            // Menghitung forecastSales menggunakan nilai a dan b dari Rumus
            $forecastSales = (float) str_replace(',', '', $a) + ( floatval($b) *  $xdata);

            // Menyimpan hasil perhitungan ke model Hasil
            Hasil::create([
                'month' => $date,
                'sales' => $sales,
                'sales_forecast' => $forecastSales,
            ]);
        }

        // mengambil data uji
        $ujiData = Ujji::all();

        foreach ($ujiData as $key => $val) {
            $x = $val->x;

            $y = $val->sales;

            $hasil = (float) str_replace(',', '', $a) + (floatval($b) * $x);

            Ujji::where('sales', $y)->update([
                'sales_forecast' => $hasil,
            ]);
        }

        $currentMonth = Ujji::orderByDesc('month')->pluck('month')->first();

        $formatCurrentDate = \Carbon\Carbon::parse($currentMonth)->toDateString();

        // dd($formatCurrentDate);
        $latestXofUji = Ujji::orderByDesc('x')->pluck('x')->first();

        $jmlBulan = $request->input('bulan');

        for ($i = 1; $i < $jmlBulan+1; $i++) {
            // Tambahkan $i bulan ke tanggal awal
            $newDate = date('Y-m-d', strtotime("$formatCurrentDate +$i months"));

            $hasil = (float) str_replace(',', '', $a) + (floatval($b) * ($latestXofUji+1));

            // Lakukan sesuatu dengan $newDate, misalnya simpan ke dalam database
            // Model::create(['date' => $newDate, ...]);
            Futurecast::create([
                'month' => $newDate,
                'x' => $latestXofUji+1,
                'sales_forecast' => $hasil,
            ]);

            $latestXofUji++;
        }


        return redirect('/perhitungan');
}


    public function implementasiRumus(){
        $n = Forecasting::count();

        $ey = Forecasting::sum('y');

        $ex = Forecasting::sum('x');

        $exy = Forecasting::sum('y_squared');

        $ex2 = Forecasting::sum('x_squared');

        $ex_square = $ex * $ex;

        Rumus::create([
            'n' => $n,
            'ey' => $ey,
            'ex' => $ex,
            'exy' => $exy,
            'ex2' => $ex2,
            'ex_square' => $ex_square,
        ]);

        return redirect('/perhitungan');

    }


    public function getData(){
        $data = Hasil::all(['month', 'sales', 'sales_forecast']);

        $ujiData = Ujji::all(['month', 'sales', 'sales_forecast']);

        $futureCast = Futurecast::all(['month', 'sales', 'sales_forecast']);

        // $concatenatedData = $data->concat($ujiData);

        $concatenatedData = collect($data)->concat($ujiData)->concat($futureCast);

        return response()->json($concatenatedData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Forecasting::truncate();

        Rumus::truncate();

        Hasil::truncate();

        Ujji::truncate();

        Futurecast::truncate();

        return redirect('/perhitungan');
    }

    public function destroyRumus(){
        Rumus::truncate();

        return redirect('/perhitungan');
    }

    public function clearHasil(){
        Hasil::truncate();

        return redirect('/perhitungan');
    }
}
