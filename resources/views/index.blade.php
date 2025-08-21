<script type="module">
    let Swal;
    const getSwal = (async () => {
        if (window.Swal) {
            return window.Swal;
        }
        try {
            const module = await import('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js');
            return module.default;
        } catch (error) {
            return { fire: () => {} };
        }
    })();

    (async () => {
        Swal = await getSwal;
        @session('sweetalert2')
        const alertOptions = @json($value);
        if (alertOptions && typeof alertOptions === 'object') {
            Swal.fire(alertOptions);
        }
        @endsession
    })();

    window.addEventListener('sweetalert2', async (event) => {
        if (!event.detail || typeof event.detail !== 'object') {
            return;
        }
        Swal = Swal || await getSwal;
        Swal.fire(event.detail);
    });
</script>

