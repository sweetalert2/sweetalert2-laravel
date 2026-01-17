@use('SweetAlert2\Laravel\Swal')
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

  @if(session()->has(Swal::SESSION_KEY))
    (async () => {
        window.Swal = await getSweetAlert2();
        {!! Swal::renderFireCall(session()->pull(Swal::SESSION_KEY)) !!};
    })();
  @endif

  window.addEventListener('{{ Swal::SESSION_KEY }}', async (event) => {
    if (!event.detail || typeof event.detail !== 'object') {
      return;
    }
    window.Swal = window.Swal || await getSweetAlert2();

    // Handle callbacks in Livewire events
    const options = {...event.detail};
    const callbackOptions = @json(Swal::CALLBACK_OPTIONS);

    callbackOptions.forEach(callback => {
      if (typeof options[callback] === 'string') {
        try {
          // Sanitize callback to prevent XSS (escape closing script/style tags)
          const sanitized = options[callback]
            .replace(/<\/script/gi, '<\\/script')
            .replace(/<\/style/gi, '<\\/style');
          // Convert string to function (only for callbacks set by PHP backend, not user input)
          options[callback] = new Function('return ' + sanitized)();
        } catch (e) {
          console.error(`Failed to parse ${callback} callback:`, e);
          delete options[callback];
        }
      }
    });

    window.Swal.fire(options);
  });
</script>

