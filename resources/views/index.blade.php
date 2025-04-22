@if (session()->has('sweetalert2'))
  <script type="module">
    Swal.fire(@json(session('sweetalert2')))
  </script>
@endif
