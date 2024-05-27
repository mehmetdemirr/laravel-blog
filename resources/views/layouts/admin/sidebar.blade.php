<div class="app-sidebar">
    <div class="logo">
        <a href="{{ route('home') }}" class="logo-icon"><span class="logo-text">Neptune</span></a>
        <div class="sidebar-user-switcher user-activity-online">
            <a href="#">
                <img src="{{ asset('assets/admin/images/avatars/avatar.png') }}">
                <span class="activity-indicator"></span>
                <span class="user-info-text">Chloe<br><span class="user-state-info">On a call</span></span>
            </a>
        </div>
    </div>
    <div class="app-menu">
        <ul class="accordion-menu">
            <li class="sidebar-title">
                Apps
            </li>
            <li class="{{ Route::is('home')? 'active-page': ''}}"> 
                <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : ''}}">
                    <i class="material-icons-two-tone">dashboard</i>
                    Dashboard
                </a>
            </li> 
            {{-- <li class="sidebar-title">
                UI Elements
            </li> --}}
            <li class="{{ Route::is('article.create') || Route::is('article.index') ? 'open': ''}}">
                <a href="#">  
                    <i class="material-icons-two-tone">tune</i>
                        Makale Yönetimi
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('article.create') }}" class="{{ Route::is('article.create') ? 'active': ''}}">Makale Ekle</a>
                    </li>
                    <li>
                        <a href="{{ route('article.index') }}" class="{{ Route::is('article.index') ? 'active': ''}}">Makale Listesi</a>
                    </li>
                
                </ul>
            </li>
            <li class="{{ Route::is('category.create') || Route::is('category.index') ? 'open': ''}}">
                <a href="#">  
                    <i class="material-icons-two-tone">tune</i>
                        Kategori
                    <i class="material-icons has-sub-menu">keyboard_arrow_right</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('category.create') }}" class="{{ Route::is('category.create') ? 'active': ''}}">Kategori Ekle</a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}" class="{{ Route::is('category.index') ? 'active': ''}}">Kategori Listesi</a>
                    </li>
                
                </ul>
            </li>
        </ul>
    </div>
</div>