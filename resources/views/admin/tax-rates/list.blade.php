@section('site_title', formatTitle([__('Tax rates'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('admin.dashboard'), 'title' => __('Admin')],
    ['title' => __('Tax rates')],
]])

<div class="d-flex">
    <div class="flex-grow-1">
        <h2 class="mb-3 d-inline-block">{{ __('Tax rates') }}</h2>
    </div>
    <div>
        <a href="{{ route('admin.tax_rates.new') }}" class="btn btn-primary mb-3">{{ __('New') }}</a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header align-items-center">
        <div class="row">
            <div class="col"><div class="font-weight-medium py-1">{{ __('Tax rates') }}</div></div>
            <div class="col-auto">
                <form method="GET" action="{{ route('admin.tax_rates') }}">
                    <div class="input-group input-group-sm">
                        <input class="form-control" name="search" placeholder="{{ __('Search') }}" value="{{ app('request')->input('search') }}">
                        <div class="input-group-append">
                            <button type="button" class="btn {{ request()->input('search') || request()->input('type') || request()->input('status') || request()->input('sort') ? 'btn-primary' : 'btn-outline-primary' }} d-flex align-items-center dropdown-toggle dropdown-toggle-split reset-after" data-enable="tooltip" title="{{ __('Filters') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@include('icons.filter', ['class' => 'fill-current width-4 height-4'])&#8203;</button>
                            <div class="dropdown-menu {{ (__('lang_dir') == 'rtl' ? 'dropdown-menu' : 'dropdown-menu-right') }} border-0 shadow width-64" id="search-filters">
                                <div class="dropdown-header py-1">
                                    <div class="row">
                                        <div class="col"><div class="font-weight-medium m-0 text-dark">{{ __('Filters') }}</div></div>
                                        <div class="col-auto">
                                            @if(request()->input('search') || request()->input('type') || request()->input('status') || request()->input('sort'))
                                                <a href="{{ route('admin.tax_rates') }}" class="text-secondary">{{ __('Reset') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                <div class="form-group px-4">
                                    <label for="i-type" class="small">{{ __('Type') }}</label>
                                    <select name="type" id="i-type" class="custom-select custom-select-sm">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach([0 => __('Inclusive'), 1 => __('Exclusive')] as $key => $value)
                                            <option value="{{ $key }}" @if(request()->input('type') == $key && request()->input('type') !== null) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group px-4">
                                    <label for="i-status" class="small">{{ __('Status') }}</label>
                                    <select name="status" id="i-status" class="custom-select custom-select-sm">
                                        <option value="">{{ __('All') }}</option>
                                        @foreach([0 => __('Active'), 1 => __('Disabled')] as $key => $value)
                                            <option value="{{ $key }}" @if(request()->input('status') == $key && request()->input('status') !== null) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group px-4">
                                    <label for="i-sort" class="small">{{ __('Sort') }}</label>
                                    <select name="sort" id="i-sort" class="custom-select custom-select-sm">
                                        @foreach(['desc' => __('Descending'), 'asc' => __('Ascending')] as $key => $value)
                                            <option value="{{ $key }}" @if(request()->input('sort') == $key) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group px-4 mb-2">
                                    <button type="submit" class="btn btn-primary btn-sm btn-block">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        @include('shared.message')

        @if(count($taxRates) == 0)
            {{ __('No results found.') }}
        @else
            <div class="list-group list-group-flush my-n3">
                <div class="list-group-item px-0 text-muted">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-12 col-lg-5">{{ __('Name') }}</div>
                                <div class="col-12 col-lg-5">{{ __('Tax rate') }}</div>
                                <div class="col-12 col-lg-2">{{ __('Status') }}</div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="form-row">
                                <div class="col">
                                    <div class="invisible btn d-flex align-items-center btn-sm text-primary">@include('icons.horizontal-menu', ['class' => 'fill-current width-4 height-4'])&#8203;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($taxRates as $taxRate)
                    <div class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col text-truncate">
                                <div class="row text-truncate">
                                    <div class="col-12 col-lg-5 text-truncate">
                                        <a href="{{ route('admin.tax_rates.edit', $taxRate->id) }}" class="text-truncate">{{ $taxRate->name }}</a>
                                    </div>

                                    <div class="col-12 col-lg-5 text-truncate">
                                        {{ number_format($taxRate->percentage, 2, __('.'), __(',')) }}% <span class="text-muted">{{ ($taxRate->type ? __('Exclusive') : __('Inclusive')) }}</span>
                                    </div>

                                    <div class="col-12 col-lg-2 text-truncate d-flex align-items-center">
                                        <span class="badge badge-{{ ($taxRate->trashed() ? 'danger' : 'success') }}">{{ ($taxRate->trashed() ? __('Disabled') : __('Active')) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-row">
                                    <div class="col">
                                        @include('admin.tax-rates.partials.menu')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3 align-items-center">
                    <div class="row">
                        <div class="col">
                            <div class="mt-2 mb-3">{{ __('Showing :from-:to of :total', ['from' => $taxRates->firstItem(), 'to' => $taxRates->lastItem(), 'total' => $taxRates->total()]) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            {{ $taxRates->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>