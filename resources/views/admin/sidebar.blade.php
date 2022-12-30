@section('menu')

    @php

        /**

         * key => [icon, title, route, [

         *  subKey => [title, route]

         * ]]

         */

        $menu = [

            'dashboard' => ['dashboard', 'Yönetim', 'admin.dashboard'],

            'settings' => ['settings', 'Ayarlar', null, [

                'general' => ['general', 'Genel', 'admin.general'],

                'appearance' => ['design', 'Görünüm', 'admin.appearance'],

                'email' => ['email', 'Email', 'admin.email'],

                'social' => ['share', 'Sosyal', 'admin.social'],

                'registration' => ['register', 'Kayıtlar', 'admin.registration'],

            ]],


            'users' => ['users', 'Kullanıcılar', 'admin.users'],

            'links' => ['link', 'Linkler', 'admin.links'],

        ];

    @endphp



    <div class="nav d-block text-truncate">

        @foreach ($menu as $key => $value)

            <li class="nav-item">

                <a class="nav-link d-flex px-4 @if (request()->segment(2) == $key && isset($value[3]) == false) active @endif" @if(isset($value[3])) data-toggle="collapse" href="#sub-menu-{{ $key }}" role="button" @if (array_key_exists(request()->segment(2), $value[3])) aria-expanded="true" @else aria-expanded="false" @endif aria-controls="collapse-{{ $key }}" @else href="{{ (Route::has($value[2]) ? route($value[2]) : $value[2]) }}" @endif>

                    <span class="sidebar-icon d-flex align-items-center">@include('icons.' . $value[0], ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')])</span>

                    <span class="flex-grow-1 text-truncate">{{ __($value[1]) }}</span>

                    @if (isset($value[3])) <span class="d-flex align-items-center ml-auto sidebar-expand">@include('icons.expand', ['class' => 'fill-current text-muted width-3 height-3'])</span> @endif

                </a>

            </li>



            @if (isset($value[3]))

                <div class="collapse sub-menu @if (array_key_exists(request()->segment(2), $menu[$key][3])) show @endif" id="sub-menu-{{ $key }}">

                    @foreach ($value[3] as $subKey => $subValue)

                        <a href="{{ (Route::has($subValue[2]) ? route($subValue[2]) : $subValue[2]) }}" class="nav-link px-4 d-flex text-truncate @if (request()->segment(2) == $subKey) active @endif">

                            <span class="sidebar-icon d-flex align-items-center">@include('icons.' . $subValue[0], ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-3' : 'mr-3')])</span>

                            <span class="flex-grow-1 text-truncate">{{ __($subValue[1]) }}</span>

                        </a>

                    @endforeach

                </div>

            @endif

        @endforeach

    </div>

@endsection