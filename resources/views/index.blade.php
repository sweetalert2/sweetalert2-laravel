<script type="module">
    const loadSweetAlert2IfNeeded = async () => {
        // If SweetAlert2 is already loaded, use it
        if (window.Swal) {
            return window.Swal;
        }
        // Otherwise, dynamically import it from CDN
        try {
            return (await import('https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.esm.all.min.js')).default;
        }
            // Fallback in case of an error (e.g., network issues)
        catch (error) {
            console.error('Failed to load SweetAlert2:', error);
            return { fire: () => {} };
        }
    };
    const Swal = await loadSweetAlert2IfNeeded();
    @session('sweetalert2')
    Swal.fire(@json($value));
    @endsession
    window.addEventListener('sweetalert2', async (event) => {
        if (!event.detail || typeof event.detail !== 'object') {
            return;
        }
        Swal.fire(event.detail);
    });
</script>

