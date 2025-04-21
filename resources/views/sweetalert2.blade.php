@if (session()->has('sweetalert2'))
  @vite('resources/js/vendor/sweetalert2.js')
  <script type="module">
    Swal.fire(@json(session('sweetalert2')));
  </script>
@endif
