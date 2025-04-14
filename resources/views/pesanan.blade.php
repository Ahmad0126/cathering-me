<x-root>
    <x-layout>
        <h1 class="mb-4">Riwayat Pesanan</h1>
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Katering</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan as $i=>$p)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $p->menu }}</td>
                                <td>{{ $p->perusahaan ?? $p->katering }}</td>
                                <td>{{ date('j F Y', strtotime($p->tanggal)) }}</td>
                                <td>{{ $p->status }}</td>
                                <td>
                                    <a href="{{ route('invoice', $p->id) }}" class="btn btn-primary">Invoice</a>
                                    @can('customer')
                                        @if ($p->status == 'Diminta')
                                            <a href="{{ route('hapus_pesanan', $p->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin membatalkan Pesanan ini?')">Batalkan</a>
                                        @endif
                                    @endcan
                                    @can('merchant')
                                        @if ($p->status == 'Diminta')
                                            <a href="{{ route('proses_pesanan', $p->id) }}" class="btn btn-warning"  onclick="return confirm('Proses Pesanan ini?')">Proses</a>
                                        @endif
                                        @if ($p->status == 'Diproses')
                                            <a href="{{ route('selesai_pesanan', $p->id) }}" class="btn btn-success"  onclick="return confirm('Tandai selesai Pesanan ini?')">Selesaikan</a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </x-layout>
</x-root>