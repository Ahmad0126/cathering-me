<x-root>
    <x-layout>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="">Invoice Pesanan</h1>
        </div>
        
        <div class="card shadow">
            <div class="card-body">
                <h1>{{ $user->perusahaan ?? $user->name }}</h1>
                <p>Tanggal Transaksi: <span class="fw-bold">{{ date('j F Y', strtotime($pesanan->tanggal)) }}</span> </p>
                <p>Status: <span class="fw-bold">{{ $pesanan->status }}</span> </p>
                <hr>
                <p>Detail:</p>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pesanan->menu }}</td>
                            <td>Rp {{ $pesanan->harga }}</td>
                            <td> {{ $pesanan->jumlah }}</td>
                            <td>Rp {{ $pesanan->jumlah * $pesanan->harga }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </x-layout>
</x-root>