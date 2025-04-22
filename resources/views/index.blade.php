@if (session()->has('sweetalert2'))
  <script type="module">
    import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js';

    Swal.fire(@json(session('sweetalert2')));
  </script>
@endif
