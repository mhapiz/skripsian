<div class="row">
    <div class="col-5">
        <div class="form-group">
            <label>Nama Barang</label>
            <select wire:model='barang_id' class="form-control select2js @error('barang_id') is-invalid @enderror"
                form="distribusiForm" id="barang_id" name="barang_id[]">
                <option>Pilih Barang</option>
                @foreach ($barangFree as $b)
                    <option value="{{ $b->barang_id }}">{{ $b->barang->nama_barang }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="">Jumlah Tersedia</label>
            <input type="number" class="form-control" name="jumlah_tersedia[]"
                id="jumlah_tersedia @error('jumlah_tersedia') is-invalid @enderror" value="{{ $jumlahBarang }}"
                form="distribusiForm" readonly>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Jumlah Distribusi</label>
            <input type="text" class="form-control @error('jumlah_distribusi') is-invalid @enderror"
                name="jumlah_distribusi[]" form="distribusiForm">
        </div>
    </div>

</div>
