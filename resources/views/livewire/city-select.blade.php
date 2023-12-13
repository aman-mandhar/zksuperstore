<!-- resources/views/livewire/city-select.blade.php -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZK Super Store') }}</title>

    <!-- Fonts -->
    
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    
    <!-- Style -->
    

    
    <link rel="stylesheet" href="{{ asset('store/css/style.css') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    @livewireStyles  
</head>
<body>
<div class="row mb-3">
    <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>
    
    <div class="col-md-6">
        <select id="city" wire:model="selectedCity" class="form-control @error('selectedCity') is-invalid @enderror" required>
            <option value="">Select nearest City</option>
            @foreach ($cities as $city)
                <option value="{{ $city }}">{{ $city }}</option>
            @endforeach
        </select>

        @error('selectedCity')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@push('scripts')
    <script src="{{ asset('path/to/select2.min.js') }}"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', (message, component) => {
                $('#city').select2(); // Initialize Select2 after Livewire update
            });

            $('#city').select2({
                placeholder: 'Select or type to search',
                tags: true,
                allowClear: true,
                tokenSeparators: [',', ' '],
            });

            $('#city').on('change', function (e) {
                @this.set('selectedCity', e.target.value);
            });
        });
    </script>
@endpush
</body>
</html>

