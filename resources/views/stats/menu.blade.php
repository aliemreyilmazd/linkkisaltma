<div class="d-flex">
    <nav class="navbar navbar-expand-xl navbar-light w-100 p-0 mt-3 bg-base-0 rounded shadow-sm">
        <div class="d-flex align-items-center d-xl-none px-3 font-weight-medium text-muted">
            @php
                $menu = [
                    'stats.realtime' => ['Realtime', 'live'],
                    'stats.overview' => ['Overview', 'overview'],
                    'stats.referrers' => ['Referrers', 'link'],
                    'stats.countries' => ['Countries', 'flag'],
                    'stats.cities' => ['Cities', 'city'],
                    'stats.platforms' => ['Platforms', 'platforms'],
                    'stats.browsers' => ['Browsers', 'browser'],
                    'stats.devices' => ['Devices', 'devices']
                ];
            @endphp

            @if(isset($menu[Route::currentRouteName()]))
                @include('icons.'.$menu[Route::currentRouteName()][1], ['class' => 'fill-current width-4 height-4 ' . (__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])
                {{ __($menu[Route::currentRouteName()][0]) }}
            @endif
        </div>
        <button class="navbar-toggler border-0 py-2 collapsed {{ (__('lang_dir') == 'rtl' ? 'mr-auto' : 'ml-auto') }}" type="button" data-toggle="collapse" data-target="#stats-navbar" aria-controls="stats-navbar" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon my-1"></span>
        </button>

        <div class="collapse navbar-collapse border-top border-xl-top-0" id="stats-navbar">
            <ul class="navbar-nav flex-wrap justify-content-between w-100">
                <li class="nav-item {{ Route::currentRouteName() == 'stats.overview' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.overview', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.overview', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Overview') }}</span>
                    </a>
                </li>

                <li class="{{ (__('lang_dir') == 'rtl' ? 'border-lg-left' : 'border-lg-right') }} "></li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.referrers' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.referrers', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.link', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Referrers') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.countries' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.countries', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.flag', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Countries') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.cities' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.cities', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.city', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Cities') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.languages' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.languages', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.language', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Languages') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.platforms' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.platforms', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.platforms', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Platforms') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.browsers' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.browsers', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.browser', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Browsers') }}</span>
                    </a>
                </li>

                <li class="nav-item {{ Route::currentRouteName() == 'stats.devices' ? 'active' : '' }}">
                    <a class="nav-link d-flex align-items-center font-weight-medium py-3 px-3" href="{{ route('stats.devices', ['id' => $link->id, 'from' => $range['from'], 'to' => $range['to']]) }}">
                        <span class="d-flex align-items-center">@include('icons.devices', ['class' => 'fill-current width-4 height-4 '.(__('lang_dir') == 'rtl' ? 'ml-2' : 'mr-2')])</span>
                        <span>{{ __('Devices') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
