@extends('Dashboard.layouts')

@section('pages')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Proses Proyeksi Penjualan UMKM Konveksi</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Metode Regresi Linear
                    
                </li>
            </ol>
            <div class="row">
                <div class="col-xl-12 col-md-6 pb-2 d-flex justify-content-end gap=2">

                @if ($checkData === 0)
                     <!-- Button trigger modal -->
                <button  {{ $checkAktual === 0 ? 'disabled' : '' }} type="button" class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Proses
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Proses Forecasting</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/proses-hitung" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kota</label>
                                    <select name="suburb" type="text" class="form-control" id="suburb">
                                        <!-- <option value="Alexandria">Alexandria</option>
                                        <option value="Altona">Altona</option> -->
                                        <option value="Albany">Albany</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <select name="kategori" type="text" class="form-control" id="kategori">
                                        @foreach ($kategori as $item)
                                        <option value={{$item->id}}>{{$item->kategori}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                @else

                      <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger me-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Hapus Perhitungan
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Proses Forecasting</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-footer">
                                <form action="/hapus-hitung" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                @endif

                @if ($checkRumus == 0)
                <button {{ $checkData === 0 ? 'disabled' : ''  }} type="button" class="btn btn-primary me-4" data-bs-toggle="modal" data-bs-target="#rumus">
                    Implementasi rumus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="rumus" tabindex="-1" aria-labelledby="rumusLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Proses Implementasi Rumus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-footer">
                                <form action="/rumus-altona" method="post">
                                    @csrf
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                @else

                <button type="button" class="btn btn-warning  me-4" data-bs-toggle="modal" data-bs-target="#rumusDelete">
                    Reset Rumus
                </button>
                <!-- Modal -->
                <div class="modal fade" id="rumusDelete" tabindex="-1" aria-labelledby="rumusLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Proses Implementasi Rumus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-footer">
                                <form action="/rumus-altona-reset" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                @endif

                @if ($checkData != 0 && $checkRumus != 0)
                <button {{ $checkHasil > 0 ? 'disabled' : '' }} type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#hasilForecasting">
                    Tampilkan Hasil Forecasting
                </button>
                <!-- Modal -->
                <div class="modal fade" id="hasilForecasting" tabindex="-1" aria-labelledby="rumusLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Proses Implementasi Rumus</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/tampilkan-forecasting" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Bulan</label>
                                    <input name="bulan" type="number" placeholder="Inputkan jumlah bulan" class="form-control" id="bulan" aria-describedby="emailHelp" required>
                                  </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Proses</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>

                @endif


                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Grafik Sales Forecasting
                </div>
                <div class="card-body">
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Forecasting
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>x</th>
                                <th>y</th>
                                <th>X^2</th>
                                <th>X*Y</th>
                                <th>date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Keterangan</th>
                                <th>date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->x }}</td>
                                <td>{{ $item->y }}</td>
                                <td>{{ $item->x_squared }}</td>
                                <td>{{ $item->y_squared }}</td>
                                <td>{{ $item->date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Data uji
                </div>
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">x</th>
                        <th scope="col">y</th>
                        <th scope="col">Hasil</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($uji as $item)
                        <tr>
                          <th scope="row">{{ $item->x }}</th>
                          <td>{{ $item->sales }}</td>
                          <td>{{ $item->sales_forecast }}</td>
                          <td>{{ $item->month }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tabel Rumus
                </div>
                {{-- <h1>a = {{$a}}</h1>
                <h1>b = {{$b}}</h1> --}}
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>n</th>
                            <th>ey</th>
                            <th>ex</th>
                            <th>exy</th>
                            <th>ex2</th>
                            <th>ex square</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($rumus as $item)
                            <tr>
                                <td>{{ $item->n }}</td>
                                <td>{{ $item->ey }}</td>
                                <td>{{ $item->ex }}</td>
                                <td>{{ $item->exy }}</td>
                                <td>{{ $item->ex2 }}</td>
                                <td>{{ $item->ex_square }}</td>
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
@endsection
