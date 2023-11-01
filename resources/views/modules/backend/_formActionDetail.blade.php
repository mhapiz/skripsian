     <div class="btn-group">
         <a class="btn btn-light text-dark" href="{!! $detailUrl !!}">
             Detail
         </a>

         @if ($hapusUrl)
             <a class="btn btn-danger text-dark" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')"
                 href="{!! $hapusUrl !!}">
                 Hapus
             </a>
         @endif

     </div>
