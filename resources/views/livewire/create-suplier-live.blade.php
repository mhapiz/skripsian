<div>
    {{-- The whole world belongs to you. --}}
    <button type="button" class="btn btn-primary btn-block d-flex align-items-center justify-content-center"
        style="margin-top: 2rem" data-toggle="modal" data-target="#addSuplierLive">
        <i class="fa fa-plus mr-2" aria-hidden="true"></i>
        Suplier Baru
    </button>
    {{--  --}}
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addSuplierLive" tabindex="-1" aria-labelledby="addSuplierLiveLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSuplierLiveLabel">Tambah Suplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSuplierForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Suplier</label>
                                    <input class="form-control @error('nama_suplier') is-invalid @enderror "
                                        type="text" form="addSuplierForm" wire:model="nama_suplier"
                                        value="{{ old('nama_suplier') }}" placeholder="Nama Suplier" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kota</label>
                                    <input class="form-control @error('kota') is-invalid @enderror " type="text"
                                        form="addSuplierForm" wire:model="kota" value="{{ old('kota') }}"
                                        placeholder="Kota" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Telpon</label>
                                    <input class="form-control @error('no_telp') is-invalid @enderror " type="text"
                                        form="addSuplierForm" wire:model="no_telp" value="{{ old('no_telp') }}"
                                        placeholder="Nomor Telpon" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror " form="addSuplierForm" wire:model="alamat"
                                        placeholder="Alamat Lengkap" rows="4" required>{{ old('alamat') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="storeSuplier()" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
