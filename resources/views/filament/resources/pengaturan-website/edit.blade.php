<div>
    {{ $this->form }}

    <div class="mt-6">
        {{ $this->getActions() }}
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('refresh-page', () => {
                window.location.reload();
            });
        });

        // Refresh setiap kali ada file upload selesai
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'src') {
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    }
                });
            });

            const images = document.querySelectorAll('img');
            images.forEach(img => {
                observer.observe(img, { attributes: true });
            });
        });
    </script>
</div>
