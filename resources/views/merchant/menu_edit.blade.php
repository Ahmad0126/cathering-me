<x-root>
    <x-layout>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="">Edit Menu</h1>
        </div>
        
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('menu_update') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id_menu" value="{{ $menu->id }}">
                                <label for="name">Nama Menu</label>
                                <input type="text" name="nama" id="name" class="form-control" value="{{ $menu->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" id="harga" class="form-control" value="{{ $menu->harga }}">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="" cols="30" rows="10" class="form-control">{{ $menu->deskripsi }}</textarea>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-warning">Simpan</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="mb-3">Foto</label>
                        <div class="row">
                            @foreach ($foto as $f)
                                <div class="col-3 mb-3">
                                    <a href="{{ asset('storage/'.$f->path) }}" data-fancybox="single" data-id="{{ $f->id }}" class="hapus-btn">
                                        <img src="{{ asset('storage/'.$f->path) }}" class="img-fluid" alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="">Tambah</label>
                            <form action="{{ route('menu_foto') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="hidden" name="id_menu" value="{{ $menu->id }}">
                                    <input type="file" name="foto[]" multiple id="" class="form-control">
                                    <button type="submit" class="btn btn-warning">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Kategori</h4>
                    <button class="btn btn-warning" id="tambah">Tambah</button>
                </div>

                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategori as $i=>$k)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $k->kategori }}</td>
                                <td>
                                    <a href="{{ route('hapus_kategori', $k->id) }}" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="menu_form" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('set_kategori') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="id_menu" value="{{ $menu->id }}">
                                <label for="name">Nama Kategori</label>
                                <input type="text" name="kategori" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-layout>
</x-root>