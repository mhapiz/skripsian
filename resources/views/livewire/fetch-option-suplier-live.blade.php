<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="form-group">
        <label for="">Suplier </label>
        <select name="suplier_id" id="suplier_id" class="form-control select2js" form="formBarangMasuk">
            <option></option>
            @foreach ($all_suplier as $s)
                <option value="{{ $s->id_suplier }}" {{ $s->id_suplier == $suplier_id ? 'selected' : '' }}>
                    {{ $s->nama_suplier }}</option>
            @endforeach
        </select>
    </div>
</div>
