<footer>
    © 2026 SmartLMS
</footer>

<script>
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/SmartLMS/service-worker.js')
            .then(function(registration) {
                console.log('Service Worker berhasil:', registration.scope);
            })
            .catch(function(error) {
                console.log('Service Worker gagal:', error);
            });
    });
}
</script>