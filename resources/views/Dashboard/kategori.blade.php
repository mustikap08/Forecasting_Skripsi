@extends('Dashboard.layouts')

@section('pages')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tambah Kategori UMKM Konveksi</h1>
            <div class="row">
                <div class="col-xl-3 col-md-6 pb-2">

            <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambahkan Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/simpan-kategori">
                                @csrf
                                <div class="mb-3">
                                  <label for="kategori" class="form-label">Kategori</label>
                                  <input name="kategori" type="kategori" class="form-control" id="kategori" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                  <label for="keterangan" class="form-label">Keterangan</label>
                                  <input name="keterangan" type="text" class="form-control" id="keterangan">
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                              </form>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">

                    Data Kategori
                <!-- Button trigger modal -->
                <button type="button" class="btn" style="background-color: #6A8895" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Kategori
                </button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->keterangan }}</td>
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
                                                <form method="POST" action="/edit-kategori/{{$item->id}}">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                      <label for="kategori" class="form-label">Kategori</label>
                                                      <input name="kategori" type="kategori" class="form-control" id="kategori" aria-describedby="emailHelp" value="{{$item->kategori}}" >
                                                    </div>
                                                    <div class="mb-3">
                                                      <label for="keterangan" class="form-label">Keterangan</label>
                                                      <input name="keterangan" type="text" class="form-control" id="keterangan" value="{{$item->keterangan}}">
                                                    </div>
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
@endsection
