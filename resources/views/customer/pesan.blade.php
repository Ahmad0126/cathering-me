<x-root>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-layout>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="">Pesan Menu</h1>
        </div>
        
        <div class="card shadow">
            <form action="{{ route('pesan_menu') }}" method="post">
                <div class="card-body">
                    <div class="mb-3">
                        <input type="hidden" name="id_menu" value="{{ $menu->id }}">
                        <label for="name">Nama Menu</label>
                        <input type="text" id="name" class="form-control" value="{{ $menu->nama }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" id="harga" class="form-control" value="{{ $menu->harga }}" disabled>
                    </div>
                    <h4>Pemesanan</h4>
                    <div class="mb-3">
                        @csrf
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="loaksi">Loaksi</label>
                        <textarea name="lokasi" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal">Tanggal Pengiriman</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning">Pesan</button>
                </div>
            </form>
        </div>
    </x-layout>
</x-root>