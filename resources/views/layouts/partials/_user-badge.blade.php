<div class="user-badge">
    <figure class="image is-32x32">
      <img src="https://bulma.io/images/placeholders/32x32.png">
    </figure>
    <a href="{{ route('user.detail', ['id' => $user->username]) }}">{{ $user->name }}</a>
</div>
