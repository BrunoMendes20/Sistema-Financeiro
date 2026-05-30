@if (session('success'))
    <div class="alert alert-success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
        {{ session('success') }}
    </div>
@endif
