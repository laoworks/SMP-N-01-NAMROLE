import Alpine from 'alpinejs';

// Untuk Filament Forms
import mask from '@alpinejs/mask'
import intersect from '@alpinejs/intersect'

// Register Alpine plugins
Alpine.plugin(mask)
Alpine.plugin(intersect)

// Start Alpine
window.Alpine = Alpine
Alpine.start()

// Untuk Livewire (required untuk Filament)
import { Livewire, Alpine as LivewireAlpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

LivewireAlpine(Alpine)
Livewire.start()
