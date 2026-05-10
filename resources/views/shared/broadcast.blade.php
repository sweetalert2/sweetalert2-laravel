@use('SweetAlert2\Laravel\Swal')
@php($isPrivate = isset($private) && $private)
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

  const isValidCallback = callback =>
    /^\s*(?:async\s+)?function\b|^\s*(?:async\s*)?\([^)]*\)\s*=>|^\s*(?:async\s*)?[A-Za-z_$][A-Za-z0-9_$]*\s*=>/.test(callback);

  if (!window.Echo) {
    console.warn('SweetAlert2 broadcast: window.Echo is not defined. Make sure Laravel Echo is configured to receive broadcast notifications.');
  } else {
    @if ($isPrivate)
    const echoChannel = window.Echo.private(@json($channel));
    @else
    const echoChannel = window.Echo.channel(@json($channel));
    @endif

    echoChannel.listen(@json('.' . Swal::SESSION_KEY), async (options) => {
      if (!options || typeof options !== 'object') {
        return;
      }
      window.Swal = window.Swal || await getSweetAlert2();

      // Handle callbacks in broadcast events
      const callbackOptions = @json(Swal::CALLBACK_OPTIONS);

      callbackOptions.forEach(callback => {
        if (typeof options[callback] === 'string') {
          if (!isValidCallback(options[callback])) {
            delete options[callback];
            return;
          }

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
  }
</script>
