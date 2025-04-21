@if (isset($swal))
  @vite('resources/js/vendor/sweetalert2.js')
  <script type="module">
    Swal.fire(@json($swal));
  </script>
@endif
