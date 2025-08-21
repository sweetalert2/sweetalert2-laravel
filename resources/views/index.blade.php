<script type="module">
    let Swal;
    if (window.Swal) {
        Swal = window.Swal;
    } else {
        const sweetalert2Module = await import('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js');
        Swal = sweetalert2Module.default;
    }
    @session('sweetalert2')
    Swal.fire(@json($value));
    @endsession
    window.addEventListener('sweetalert2', (event) => {
        console.log(event);
        Swal.fire(event.detail);
    });
</script>

