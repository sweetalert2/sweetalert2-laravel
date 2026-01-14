@use('SweetAlert2\Laravel\Swal')
<script type="module">
  let Swal;
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

  // Listen to Inertia navigation events
  document.addEventListener('inertia:navigate', async (event) => {
    const sweetalert2Data = event.detail.page.props.flash?.['{{ Swal::SESSION_KEY }}'];

    if (sweetalert2Data && typeof sweetalert2Data === 'object') {
      Swal = Swal || await getSweetAlert2();
      
      // Handle callbacks in Inertia
      const options = {...sweetalert2Data};
      const callbacks = ['didOpen', 'didClose', 'didDestroy', 'willOpen', 'willClose', 'didRender', 'preDeny', 'preConfirm', 'inputValidator', 'inputOptions', 'loaderHtml'];
      
      callbacks.forEach(callback => {
        if (typeof options[callback] === 'string') {
          try {
            // Convert string to function
            options[callback] = new Function('return ' + options[callback])();
          } catch (e) {
            console.error(`Failed to parse ${callback} callback:`, e);
            delete options[callback];
          }
        }
      });
      
      Swal.fire(options);
    }
  });
</script>

