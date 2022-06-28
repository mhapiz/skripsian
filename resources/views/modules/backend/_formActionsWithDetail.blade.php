     <div class="btn-group">
         <a class="btn btn-warning text-dark" href="{!! $editUrl !!}">
             {{-- Edit --}}
             <i class="fa fa-pencil" aria-hidden="true"></i>
         </a>
         <a class="btn btn-info text-dark" href="{!! $detailUrl !!}">
             {{-- Detail --}}
             <i class="fa fa-eye" aria-hidden="true"></i>
         </a>
         {{-- <button class="btn btn-light" type="button">Middle</button> --}}
         <form action=" {!! $deleteUrl !!} " method="POST">
             @csrf
             @method('delete')
             <button class="btn btn-danger text-dark" type="submit"
                 style="border-top-left-radius: 0px;border-bottom-left-radius: 0px;"
                 onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')">
                 <span class="mx-2">
                     <i class="fa fa-trash" aria-hidden="true"></i>
                 </span>
             </button>
         </form>

     </div>
