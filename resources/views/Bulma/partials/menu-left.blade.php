@foreach($items as $menu_item)
    @php ($hasChildren = count($menu_item->children) > 0)    
        @if ($hasChildren)
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    {{ $menu_item->title }}
                </a>

                <div class="navbar-dropdown">
                    @include('Bulma.partials.menu-left', ['items' => $menu_item->children])
                </div>
            </div>
        @else
        <a class="navbar-item" href="{{ url($menu_item->link()) }}">{{ $menu_item->title }}</a>
        @endif
@endforeach
