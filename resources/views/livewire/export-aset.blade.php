<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <button type="button" class="btn btn-light btn-air-light mr-2" data-toggle="modal" data-target="#exportModal">
        <i class="fa fa-qrcode mr-2"></i>
        <span>Print</span>
    </button>

    <div wire:ignore.self class="modal fade" id="exportModal" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Pilih Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="exportForm">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nama Aset</label>
                                    <select wire:model='aset_id'
                                        class="form-control select2js @error('aset_id') is-invalid @enderror"
                                        id="aset_id">
                                        <option value=""></option>
                                        @foreach ($asetList as $aset)
                                        <option value="{{ $aset->id }}">{{ $aset->nama }} -
                                            {{ $aset->kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Dari</label>
                                    <input type="number" wire:model='dari' class="form-control">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Sampai</label>
                                    <input type="number" wire:model='sampai' class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <p>
                                    {{ $note }}
                                </p>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeButton" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="submitButton"
                        wire:click.prevent="export()">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>


@push('tambahStyle')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush

@push('tambahScript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    initSelect2();

        document.addEventListener('livewire:load', function() {

            $('#aset_id').on('change', function() {
                @this.set('aset_id', $(this).val());
                Livewire.emit('updateAsetSelected');
            });

            initSelect2();
        });

        Livewire.hook('message.processed', (message, component) => {
            initSelect2();
        });

        function initSelect2() {
            $('.select2js').select2({
                dropdownParent: $('#exportModal'),
                placeholder: "Pilih ...",
                theme: 'bootstrap4',
            });
        }

        $("#submitButton").click(function() {
            $(this).text("Proses...");
            $(this).prop("disabled", true);
            $('#closeButton').prop("disabled", true);
        });
</script>
@endpush