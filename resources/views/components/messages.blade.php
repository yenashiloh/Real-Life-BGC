<div x-data="{ show: true }" x-show="show" x-init="setTimeout(()=> show = false, 5000)" class="w-auto">
    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger p-1">{{ session('error') }}</div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success p-1">{{ session('message') }}</div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success p-1">{{ session('success') }}</div>
    @endif
</div>
