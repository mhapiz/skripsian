     <div class="btn-group">

         @if ($status == 'added')
             <a class="btn btn-light text-dark " href="{!! $url !!}" target="_blank">
                 Print Pemeriksaan
             </a>
         @else
             <form action="{!! $url !!}">
                 <button class="btn btn-light text-dark show_confirm">
                     Tambah Inventaris
                     <i class="fa fa-arrow-right ml-2" aria-hidden="true"></i>
                 </button>
             </form>
         @endif

     </div>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
     <script>
         $(document).ready(function() {
             $('.show_confirm').click(function(event) {
                 var form = $(this).closest("form");
                 var name = $(this).data("name");
                 event.preventDefault();
                 swal({
                         title: `Barang Akan Ditambahkan Ke Inventaris!`,
                         text: "Barang Masuk Tidak Bisa Diubah Dan Dihapus!",
                         icon: "info",
                         buttons: true,
                         //  dangerMode: true,
                     })
                     .then((doIt) => {
                         if (doIt) {
                             form.submit();
                         }
                     });
             });
         });
     </script>
