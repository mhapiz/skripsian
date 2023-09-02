<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nama Aset</label>
            <select wire:model='aset_id' class="form-control select2js @error('aset_id') is-invalid @enderror"
                form="distribusiForm" id="aset_id{{ $idx }}" name="aset_id[]">
                <option value=""></option>
                @foreach ($barangFree as $b)
                    <option value="{{ $b->id }}">{{ $b->nama }} - {{ $b->kode }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Kondisi</label>
            <select class="form-control @error('kondisi') is-invalid @enderror" form="distribusiForm"
                wire:model="kondisi" id="kondisi{{ $idx }}" name="kondisi[]">
                @if ($arrKondisi)
                    <option value=""></option>
                    @foreach ($arrKondisi as $item)
                        <option value="{{ $item }}">
                            @php
                                // Split the input string by underscores
                                $words = explode('_', $item);
                                // Capitalize the first letter of each word and join them with spaces
                                $convertedString = ucwords(implode(' ', $words));
                            @endphp
                            {{ $convertedString }}
                        </option>
                    @endforeach
                @else
                @endif
            </select>
        </div>
    </div>
    <div class="col-md-3">
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


@push('tambahStyle')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush

@push('tambahScript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.addEventListener('livewire:load', function() {
            var idx = @this.idx;

            $('#aset_id' + idx).on('change', function() {
                @this.set('aset_id', $(this).val());
            });

            $('#kondisi' + idx).on('change', function() {
                @this.set('kondisi', $(this).val());
            });

            initSelect2();
        });

        Livewire.hook('message.processed', (message, component) => {
            initSelect2();
        });

        function initSelect2() {
            $('.select2js').select2({
                placeholder: "Pilih ...",
                theme: 'bootstrap4',
            });
        }
    </script>
@endpush
