<x-root>
    <x-layout>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="">Daftar Menu</h1>
            <button class="btn btn-warning h-100" type="button" id="tambah">Filter</button>
        </div>

        <div class="row">
            @foreach ($menu as $m)
                <div class="col-12 col-sm-6 col-xl-3 mb-3">
                    <div class="card shadow">
                        <img src="{{ $m->path ? asset('storage/'.$m->path) : 'https://placehold.co/400?text=image+cap'}}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="">
                        <div class="card-body bg-dark text-white rounded-bottom">
                            <h4>{{ $m->nama }}</h4>
                            <p>Rp {{ number_format($m->harga) }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('menu_edit', $m->id) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('menu_hapus', $m->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus Menu ini?')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal fade" id="menu_form" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filter Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('menu_store') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <div class="mb-3">
                                <label for="">Katrgori</label>
                                <input type="text" name="nama" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="harga">Harga</label>
                                <select name="harga_operator" id="">
                                    <option value=">">Lebih Dari</option>
                                    <option value="<">Kurang Dari</option>
                                    <option value="=">Sama Dengan</option>
                                </select>
                                <input type="number" name="harga" id="harga" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="lokasi">Lokasi</label>
                                <input name="lokasi" id="" type="text" class="form-control">
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
