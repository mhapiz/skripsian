<div>
    <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center" data-toggle="modal"
        data-target="#addBarangLive">
        <i class="fa fa-plus mr-2" aria-hidden="true"></i>
        Barang Baru
    </button>
    {{--  --}}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addBarangLive" tabindex="-1" aria-labelledby="addBarangLiveLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBarangLiveLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addBarangLive">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    @if ($foto_path)
                                        <img src="{{ $foto_path->temporaryUrl() }}" width="100%" id="foto_path">
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" form="addBarangLive"
                                            class="custom-file-input @error('foto_path') is-invalid @enderror"
                                            name="foto_path" wire:model="foto_path">
                                        <label class="custom-file-label">Pilih foto...</label>
                                    </div>
                                    @error('foto_path')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Barang</label>
                                            <input class="form-control @error('nama_barang') is-invalid @enderror "
                                                type="text" name="nama_barang" value="{{ old('nama_barang') }}"
                                                form="addBarangLive" placeholder="Barang" wire:model="nama_barang">
                                            @error('nama_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <input class="form-control @error('kode_barang') is-invalid @enderror "
                                                type="text" name="kode_barang" value="{{ old('kode_barang') }}"
                                                form="addBarangLive" placeholder="Kode Barang" wire:model="kode_barang">
                                            @error('kode_barang')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input class="form-control @error('merk') is-invalid @enderror "
                                                type="text" name="merk" value="{{ old('merk') }}"
                                                form="addBarangLive" placeholder="Merk" wire:model="merk">
                                            @error('merk')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="storeBarang()" class="btn btn-primary">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
</div>
