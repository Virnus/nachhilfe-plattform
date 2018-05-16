<section class="hero is-info">
  <div class="hero-body">
    <div class="container has-text-centered">
      <p class="title">
        Admin
      </p>
    </div>
  </div>

  <div class="hero-foot">
    <nav class="tabs is-boxed is-fullwidth">
      <div class="container">
        <ul>
          <li class="{{ on_page('*/users*') ? 'is-active' : '' }}">
            <a href="{{ route('admin.users') }}">Benutzer</a>
          </li>
          <li class="{{ on_page('*/lernzentrum*') ? 'is-active' : '' }}">
            <a href="{{ route('admin.lernzentrum.index') }}">Lernzentrum</a>
          </li>
          <li class="{{ on_page('*/angebote*') ? 'is-active' : '' }}">
            <a href="{{ route('admin.angebote.index') }}">Angebote</a>
            </li>
          <li class="{{ on_page('*/subjects') ? 'is-active' : '' }}">
            <a href="{{ route('admin.subjects') }}">Fächer</a>
          </li>
          <li class="{{ on_page('*/topics') ? 'is-active' : '' }}">
            <a href="{{ route('admin.topics') }}">Themen</a>
            </li>
        </ul>
      </div>
    </nav>
  </div>
</section>
