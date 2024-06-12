@extends('Dashboard.layouts')

@section('pages')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Data Penjualan UMKM Konveksi</h1>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">

                    Data Aktual

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" style="background-color: #12455B" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Tambah Data Aktual
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Aktual</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="/simpan-aktual">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Kategori</label>
                                        <select name="kategori" type="text" class="form-control" id="category">
                                            @foreach ($kategori as $item)
                                            <option value={{$item->id}}>{{$item->kategori}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                      <label for="date" class="form-label">Bulan</label>
                                      <input name="date" type="date" class="form-control" id="date" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                      <label for="financial" class="form-label">Periode Tahun Awal</label>
                                      <select id="yearInput" name="periode-awal"  class="form-control"></select>
                                    </div>
                                    <div class="mb-3">
                                      <label for="financial" class="form-label">Periode Tahun Akhir</label>
                                      <select id="yearInput2" name="periode-akhir" class="form-control"></select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="chain" class="form-label">Jenis</label>
                                        <input name="chain" type="text" class="form-control" id="chain">
                                    </div>
                                    <div class="mb-3">
                                        <label for="suburb" class="form-label">Kota</label>
                                        <select name="suburb" type="text" class="form-control" id="suburb">
                                            <!-- <option value="Alexandria">Alexandria</option>
                                            <option value="Altona">Altona</option> -->
                                            <option value="Albany">Albany</option>
                                        </select>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input name="state" type="text" class="form-control" id="state">
                                    </div>
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input name="country" type="text" class="form-control" id="country">
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="sales" class="form-label">Penjualan</label>
                                        <input name="sales" type="text" class="form-control" id="sales">
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                  </form>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Periode Tahun</th>
                                <th>Jenis</th>
                                <th>Kota</th>
                                <!-- <th>State</th>
                                <th>Country</th> -->
                                <th>Kategori</th>
                                <th>Penjualan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Bulan</th>
                                <th>Periode Tahun</th>
                                <th>Jenis</th>
                                <th>Kota</th>
                                <!-- <th>State</th>
                                <th>Country</th> -->
                                <th>Kategori</th>
                                <th>Penjualan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->financial_year }}</td>
                                <td>{{ $item->chain }}</td>
                                <td>{{ $item->subrub }}</td>
                                <!-- <td>{{ $item->state }}</td>
                                <td>{{ $item->country }}</td> -->
                                <td>{{ $item->kategori->kategori }}</td>
                                <td>{{ $item->sales }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaledit{{$item->id}}">
                                        Edit
                                    </button>
                                <!-- Modal -->
                                    <div class="modal fade" id="modaledit{{$item->id}}" tabindex="-1" aria-labelledby="modaledit{{$item->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/edit-aktual/{{$item->id}}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                        <label for="category" class="form-label">Kategori</label>
                                                        <select name="kategori" type="text" class="form-control" id="category">
                                                            @foreach ($kategori as $kategoriData)
                                                            <option value={{$kategoriData->id}}  {{ $kategoriData->id === $item->kategori_id ? 'selected' : '' }} >{{$kategoriData->kategori}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="date" class="form-label">Bulan</label>
                                                      <input name="date" type="date" class="form-control" id="date" aria-describedby="emailHelp" value={{ $item->bulan }}>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="financial" class="form-label">Periode Tahun Awal</label>
                                                        <select name="periode-awal" class="form-control yearInput">
                                                            <!-- Options will be dynamically generated -->
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="financial" class="form-label">Periode Tahun Akhir</label>
                                                        <select name="periode-akhir" class="form-control yearInput">
                                                            <!-- Options will be dynamically generated -->
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="chain" class="form-label">Jenis</label>
                                                        <input name="chain" type="text" class="form-control" id="chain" value={{ $item->chain }}>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="suburb" class="form-label">Kota</label>
                                                        <select name="suburb" type="text" class="form-control" id="suburb">
                                                            <!-- <option value="Alexandria" {{ $item->subrub == 'Alexandria' ? 'selected' : '' }} >Alexandria</option>
                                                            <option value="Altona" {{ $item->subrub == 'Altona' ? 'selected' : '' }}>Altona</option> -->
                                                            <option value="Albany" {{ $item->subrub == 'Albany' ? 'selected' : '' }}>Albany</option>
                                                        </select>
                                                    </div>
                                                    <!-- <div class="mb-3">
                                                        <label for="state" class="form-label">State</label>
                                                        <input name="state" type="text" class="form-control" id="state" value={{ $item->state }}>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Country</label>
                                                        <input name="country" type="text" class="form-control" id="country" value={{ $item->country }}>
                                                    </div> -->
                                                    <div class="mb-3">
                                                        <label for="sales" class="form-label">Penjualan</label>
                                                        <input name="sales" type="text" class="form-control" id="sales" value={{ $item->sales }}>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapus{{$item->id}}">
                                        Hapus
                                    </button>
                                <!-- Modal -->
                                    <div class="modal fade" id="modalHapus{{$item->id}}" tabindex="-1" aria-labelledby="modaledit{{$item->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="/hapus-aktual/{{$item->id}}">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                  </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Forecasting Dashboard 2024</div>
                {{-- <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div> --}}
            </div>
        </div>
    </footer>
</div>

<script>
// Get the current year
var currentYear = new Date().getFullYear();

// Populate the select dropdown with years from 1000 to current year
var selectYear = document.getElementById("yearInput");
for (var year = currentYear; year >= 1000; year--) {
    var option = document.createElement("option");
    option.text = year;
    option.value = year;
    selectYear.add(option);
}

// Optionally, you can add an event listener to capture the selected year
selectYear.addEventListener("change", function() {
    var selectedYear = selectYear.value;
    console.log("Selected year:", selectedYear);
    // You can perform further actions here if needed
});

var currentYear2 = new Date().getFullYear();

// Populate the select dropdown with years from 1000 to current year
var selectYear2 = document.getElementById("yearInput2");
for (var year = currentYear2; year >= 1000; year--) {
    var option = document.createElement("option");
    option.text = year;
    option.value = year;
    selectYear2.add(option);
}

// Optionally, you can add an event listener to capture the selected year
selectYear2.addEventListener("change", function() {
    var selectedYear2 = selectYear2.value;
    console.log("Selected year:", selectedYear2);
    // You can perform further actions here if needed
});

document.addEventListener("DOMContentLoaded", function() {
    // Ambil semua elemen dengan kelas yearInput
    var yearInputs = document.querySelectorAll('.yearInput');
    
    // Loop melalui setiap elemen
    yearInputs.forEach(function(selectYear) {
        // Dapatkan tahun saat ini
        var currentYear = new Date().getFullYear();

        // Populate the select dropdown with years from 1000 to current year
        for (var year = currentYear; year >= 1000; year--) {
            var option = document.createElement("option");
            option.text = year;
            option.value = year;
            selectYear.add(option);

            
        }
    });
});
</script>

@endsection