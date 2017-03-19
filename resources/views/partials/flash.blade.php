{{-- Flash Messages --}}
@if(session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@endif

{{-- Flash Errors --}}
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Validaton Errors --}}
@if ($errors)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif