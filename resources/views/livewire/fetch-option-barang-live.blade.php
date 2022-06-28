{{-- <div class="form-group">
    <label>Pilih Barang</label>
    <select name="barang_id[]" class="form-control @error('nama_barang') is-invalid @enderror" id=""
        form="addBarangMasuk">
        @foreach ($all_barang as $b)
            <option value="{{ $b->id_barang }}">{{ $b->nama_barang }}</option>
        @endforeach
    </select>
    @error('nama_barang')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div> --}}

{{-- <div class="box" id="wrapper">
    <div class="row"> --}}

{{-- </div>
</div> --}}

{{-- <script>
    $(document).ready(function() {
        var max_fields = 10;
        var wrapper = $("#wrapper");
        var add_button = $("#btnTambah");

        var x = 1; //initlal text box count
        $(add_button).click(function(e) { //on add input button click
            e.preventDefault();
            console.log('ajajaj');
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(`
                            <div class="row">
                                <div class="col-md-4">
                                    <livewire:fetch-option-barang-live />
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Jumlah</label>
                                        <input type="number" name="jumlah_masuk[]" id="jumlah_masuk"
                                            class="form-control" form="addBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Harga Satuan</label>
                                        <input type="number" name="harga_satuan[]" id="harga_satuan"
                                            class="form-control" form="addBarangMasuk">
                                    </div>
                                </div>
                                <div class="col-2 d-flex align-items-center pt-2">
                                    <a href="#" class="btn btn-block btn-danger remove_field">Hapus</a>
                                </div>
                            </div>
            `); //add input box
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.row').remove();
            x--;
        })
    });
</script> --}}
