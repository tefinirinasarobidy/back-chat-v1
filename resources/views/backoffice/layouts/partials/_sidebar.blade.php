
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        {{-- menu dynamique --}}
{{--  
        @foreach ($menus as $menu)
        <?php
            try {
               
        ?>
            @if (count($menu->childs) > 0)
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-admin-{{ $menu->id }}" aria-expanded="false" aria-controls="ui-admin">
                        <i class="mdi mdi-circle-outline menu-icon"></i>
                            <span class="menu-title">{{ $menu->name }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-admin-{{ $menu->id }}">
                        @foreach ($menu->childs as $submenus)
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route($submenus->url) }}">{{$submenus->name}}</a></li>
                            </ul>
                        @endforeach
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($menu->url) }}">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">{{$menu->name}}</span>
                    </a>
                </li>
            @endif
        <?php
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        ?>
        @endforeach
  --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                    <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admin">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('user.index') }}">liste Users</a></li>
                </ul>
                
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('conversation.index') }}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">conversation</span>
            </a>
        </li>

    </ul> 
</nav>

