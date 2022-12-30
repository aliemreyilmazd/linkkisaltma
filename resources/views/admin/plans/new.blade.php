@section('site_title', formatTitle([__('New'), __('Plan'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('admin.dashboard'), 'title' => __('Admin')],
    ['url' => route('admin.plans'), 'title' => __('Plans')],
    ['title' => __('New')],
]])

<h2 class="mb-3 d-inline-block">{{ __('New') }}</h2>

<div class="card border-0 shadow-sm">
    <div class="card-header"><div class="font-weight-medium py-1">{{ __('Plan') }}</div></div>
    <div class="card-body">
        @include('shared.message')

        <form action="{{ route('admin.plans.new') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="i-name">{{ __('Name') }}</label>
                <input type="text" name="name" id="i-name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-description">{{ __('Description') }}</label>
                <input type="text" name="description" id="i-description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{ old('description') }}">
                @if ($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-trial-days">{{ __('Trial days') }}</label>
                <input type="number" name="trial_days" id="i-trial-days" class="form-control{{ $errors->has('trial_days') ? ' is-invalid' : '' }}" value="{{ old('trial_days') ?? 0 }}">
                @if ($errors->has('trial_days'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('trial_days') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-currency">{{ __('Currency') }}</label>
                <select name="currency" id="i-currency" class="custom-select{{ $errors->has('currency') ? ' is-invalid' : '' }}">
                    @foreach(config('currencies.all') as $key => $value)
                        <option value="{{ $key }}" @if(old('currency') == $key) selected @endif>{{ $key }} - {{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('currency'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('currency') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="i-amount-month">{{ __('Monthly amount') }}</label>
                        <input type="text" name="amount_month" id="i-amount-month" class="form-control{{ $errors->has('amount_month') ? ' is-invalid' : '' }}" value="{{ old('amount_month') }}">
                        @if ($errors->has('amount_month'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount_month') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="i-amount-year">{{ __('Yearly amount') }}</label>
                        <input type="text" name="amount_year" id="i-amount-year" class="form-control{{ $errors->has('amount_year') ? ' is-invalid' : '' }}" value="{{ old('amount_year') }}">
                        @if ($errors->has('amount_year'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('amount_year') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="i-tax-rates">{{ __('Tax rates') }}</label>
                        <select name="tax_rates[]" id="i-tax-rates" class="custom-select{{ $errors->has('tax_rates') ? ' is-invalid' : '' }}" size="3" multiple>
                            @foreach($taxRates as $taxRate)
                                <option value="{{ $taxRate->id }}" @if(old('tax_rates') !== null && in_array($taxRate->id, old('tax_rates'))) selected @endif>{{ $taxRate->name }} ({{ number_format($taxRate->percentage, 2, __('.'), __(',')) }}% {{ ($taxRate->type ? __('Exclusive') : __('Inclusive')) }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('tax_rates'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('tax_rates') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="i-coupons">{{ __('Coupons') }}</label>
                        <select name="coupons[]" id="i-coupons" class="custom-select{{ $errors->has('coupons') ? ' is-invalid' : '' }}" size="3" multiple>
                            @foreach($coupons as $coupon)
                                <option value="{{ $coupon->id }}" @if(old('coupons') !== null && in_array($coupon->id, old('coupons'))) selected @endif>{{ $coupon->name }} ({{ number_format($coupon->percentage, 2, __('.'), __(',')) }}% {{ ($coupon->type ? __('Redeemable') : __('Discount')) }})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('coupons'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('coupons') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="i-visibility">{{ __('Visibility') }}</label>
                <select name="visibility" id="i-visibility" class="custom-select{{ $errors->has('public') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('Public'), 0 => __('Unlisted')] as $key => $value)
                        <option value="{{ $key }}" @if(old('visibility') == $key && old('visibility') !== null) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('visibility'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('visibility') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-color">{{ __('Color') }}</label>
                <input type="color" name="color" id="i-color" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" value="{{ old('color') }}">
                @if ($errors->has('color'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('color') }}</strong>
                    </span>
                @endif
            </div>

            <div class="hr-text"><span class="font-weight-medium text-body">{{ __('Features') }}</span></div>

            <div class="form-group">
                <label for="i-features-links">{{ __('Links') }}</label>
                <input type="number" name="features[links]" id="i-features-links" class="form-control{{ $errors->has('features.links') ? ' is-invalid' : '' }}" value="{{ old('features.links') ?? 0 }}">
                @if ($errors->has('features.links'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.links') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-spaces">{{ __('Spaces') }}</label>
                <input type="number" name="features[spaces]" id="i-features-spaces" class="form-control{{ $errors->has('features.spaces') ? ' is-invalid' : '' }}" value="{{ old('features.spaces') ?? 0 }}">
                @if ($errors->has('features.spaces'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.spaces') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-domains">{{ __('Domains') }}</label>
                <input type="number" name="features[domains]" id="i-features-domains" class="form-control{{ $errors->has('features.domains') ? ' is-invalid' : '' }}" value="{{ old('features.domains') ?? 0 }}">
                @if ($errors->has('features.domains'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.domains') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-global-domains">{{ __('Additional domains') }}</label>
                <select name="features[global_domains]" id="i-features-global-domains" class="custom-select{{ $errors->has('features.global_domains') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.global_domains') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.global_domains'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.global_domains') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-pixels">{{ __('Pixels') }}</label>
                <input type="number" name="features[pixels]" id="i-features-pixels" class="form-control{{ $errors->has('features.pixels') ? ' is-invalid' : '' }}" value="{{ old('features.pixels') ?? 0 }}">
                @if ($errors->has('features.pixels'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.pixels') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-stats">{{ __('Advanced stats') }}</label>
                <select name="features[stats]" id="i-features-stats" class="custom-select{{ $errors->has('features.stats') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.stats') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.stats'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.stats') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-targeting">{{ __('Targeting') }}</label>
                <select name="features[targeting]" id="i-features-targeting" class="custom-select{{ $errors->has('features.targeting') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.targeting') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.targeting'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.targeting') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-deep-links">{{ __('Deep links') }}</label>
                <select name="features[deep_links]" id="i-features-deep-links" class="custom-select{{ $errors->has('features.deep_links') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.deep_links') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.deep_links'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.deep_links') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-password">{{ __('Link password') }}</label>
                <select name="features[password]" id="i-features-password" class="custom-select{{ $errors->has('features.password') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.password') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-expiration">{{ __('Link expiration') }}</label>
                <select name="features[expiration]" id="i-features-expiration" class="custom-select{{ $errors->has('features.expiration') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.expiration') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.expiration'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.expiration') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-disabled">{{ __('Link deactivation') }}</label>
                <select name="features[disabled]" id="i-features-disabled" class="custom-select{{ $errors->has('features.disabled') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.disabled') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.disabled'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.disabled') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-data-export">{{ __('Data export') }}</label>
                <select name="features[data_export]" id="i-features-data-export" class="custom-select{{ $errors->has('features.data_export') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.data_export') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.data_export'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.data_export') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-utm">{{ __('UTM Builder') }}</label>
                <select name="features[utm]" id="i-features-utm" class="custom-select{{ $errors->has('features.utm') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.utm') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.utm'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.utm') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-features-api">{{ __('API access') }}</label>
                <select name="features[api]" id="i-features-api" class="custom-select{{ $errors->has('features.api') ? ' is-invalid' : '' }}">
                    @foreach([1 => __('On'), 0 => __('Off')] as $key => $value)
                        <option value="{{ $key }}" @if(old('features.api') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('features.api'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('features.api') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" name="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>
</div>