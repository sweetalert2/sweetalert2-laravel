@use('SweetAlert2\Laravel\Swal')
@if(session()->has(Swal::SESSION_KEY))
  <script type="module">
    const getSweetAlert2 = async () => {
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

    (async () => {
      window.Swal = await getSweetAlert2();
      {!! Swal::renderFireCall(session()->pull(Swal::SESSION_KEY)) !!};
    })();
  </script>
@endif

