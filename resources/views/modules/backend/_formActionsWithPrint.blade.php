     <div class="btn-group">
         <a class="btn btn-warning text-dark" href="{!! $editUrl !!}">
             Edit
         </a>
         <a class="btn btn-info text-dark" href="{!! $printUrl !!}" target="_blank">
             {{-- Detail --}}
             <i class="fa fa-print" aria-hidden="true"></i>
         </a>
         {{-- <button class="btn btn-light" type="button">Middle</button> --}}
         <form action=" {!! $deleteUrl !!} " method="POST">
             @csrf
             @method('delete')
             <button class="btn btn-danger text-dark" type="submit"
                 style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;"
                 onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">
                 <span class="mx-2">Hapus
                 </span>
             </button>
         </form>

     </div>
