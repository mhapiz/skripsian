<div>
    <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center mr-2"
        data-toggle="modal" data-target="#listBarang">
        List Barang
    </button>
    {{-- --}}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="listBarang" tabindex="-1" aria-labelledby="listBarangLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="listBarangLabel">List Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                        </tr>
                        @foreach ($barang as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->kode_barang }}</td>
                            </tr>
                        @endforeach
                        {{ $barang->links() }}
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- --}}
</div>
