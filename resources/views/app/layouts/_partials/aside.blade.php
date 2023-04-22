@php
    $menus = [
        [
            'route' => route('app.home'),
            'name' => 'Home',
            'icon' => 'mdi mdi-account-multiple',
        ],
        [
            'route' => route('cliente.index'),
            'name' => 'Cliente',
            'icon' => 'mdi mdi-account-multiple',
        ],
        [
            'route' => route('pedido.index'),
            'name' => 'Pedido',
            'icon' => 'mdi mdi-clipboard-text',
        ],
        [
            'route' => route('app.fornecedor'),
            'name' => 'Fornecedor',
            'icon' => 'mdi mdi-home-modern',
        ],
        [
            'route' => route('produto.index'),
            'name' => 'Produto',
            'icon' => 'mdi mdi-dropbox',
        ],
        [
            'route' => route('app.sair'),
            'name' => 'Sair',
            'icon' => 'mdi mdi-logout-variant',
        ],
    ];
@endphp

<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                @foreach ($menus as $menu)
                    <li class="sidebar-item">
                        <a class="sidebar-link
                        waves-effect waves-dark sidebar-link"
                            href=" {{ $menu['route'] }}" aria-expanded="false">
                            <i class=" {{ $menu['icon'] }}"></i>
                            <span class="hide-menu">
                                {{ $menu['name'] }}
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
