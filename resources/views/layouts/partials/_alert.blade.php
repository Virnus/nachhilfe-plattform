@if (session('success'))
    <div class="notification is-success">
        <button class="delete"></button>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="notification is-danger">
        <button class="delete"></button>
        {{ session('error') }}
    </div>
@endif
