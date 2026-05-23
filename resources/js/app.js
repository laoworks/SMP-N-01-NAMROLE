import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

// Register Collapse plugin (HARUS SEBELUM Alpine.start)
Alpine.plugin(collapse);

// Start Alpine
window.Alpine = Alpine;
Alpine.start();

// Livewire (required untuk Filament)
import { Livewire, Alpine as LivewireAlpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

LivewireAlpine(Alpine);
Livewire.start();
