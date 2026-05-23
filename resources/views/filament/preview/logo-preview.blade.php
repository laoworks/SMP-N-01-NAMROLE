<div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg mt-4">
    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Preview:</h4>

    <div class="space-y-3">
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500 w-24">Logo Large:</span>
            <div class="bg-white p-2 rounded border">
                @if($record && $record->logo)
                    <img src="{{ asset('storage/' . $record->logo) }}" class="h-10 w-auto">
                @else
                    <span class="text-gray-400 text-xs">Belum diupload</span>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500 w-24">Logo Small:</span>
            <div class="bg-white p-2 rounded border">
                @if($record && $record->logo_small)
                    <img src="{{ asset('storage/' . $record->logo_small) }}" class="h-6 w-auto">
                @else
                    <span class="text-gray-400 text-xs">Belum diupload</span>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500 w-24">Nama Website:</span>
            <span class="font-semibold" style="color: {{ $record->primary_color ?? '#4361ee' }}">
                {{ $record->nama_website ?? '-' }}
            </span>
        </div>
    </div>
</div>
