@section('site_title', formatTitle([__('New'), __('Coupon'), config('settings.title')]))

@include('shared.breadcrumbs', ['breadcrumbs' => [
    ['url' => route('admin.dashboard'), 'title' => __('Admin')],
    ['url' => route('admin.coupons'), 'title' => __('Coupons')],
    ['title' => __('New')],
]])

<h2 class="mb-3 d-inline-block">{{ __('New') }}</h2>

<div class="card border-0 shadow-sm">
    <div class="card-header"><div class="font-weight-medium py-1">{{ __('Coupon') }}</div></div>
    <div class="card-body">
        @include('shared.message')

        <form action="{{ route('admin.coupons.new') }}" method="post" enctype="multipart/form-data" id="form-coupon">
            @csrf

            <div class="form-group">
                <label for="i-type">{{ __('Type') }}</label>
                <select name="type" id="i-type" class="custom-select{{ $errors->has('type') ? ' is-invalid' : '' }}">
                    @foreach([0 => __('Discount'), 1 => __('Redeemable')] as $key => $value)
                        <option value="{{ $key }}" @if (old('type') == $key) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                @if ($errors->has('type'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>

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
                <label for="i-code">{{ __('Code') }}</label>
                <div class="input-group">
                    <input type="text" name="code" id="i-code" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" value="{{ old('code') }}">
                    <div class="input-group-append">
                        <div class="btn btn-primary" data-enable="tooltip-copy" title="{{ __('Copy') }}" data-copy="{{ __('Copy') }}" data-copied="{{ __('Copied') }}" data-clipboard-target="#i-code">{{ __('Copy') }}</div>
                    </div>
                </div>
                @if ($errors->has('code'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group {{ (old('type') == 1 ? '' : 'd-none') }}" id="form-group-redeemable">
                <label for="i-days">{{ __('Days') }}</label>
                <input type="number" name="days" id="i-days" class="form-control{{ $errors->has('days') ? ' is-invalid' : '' }}" value="{{ old('days') ?? 0 }}">
                @if ($errors->has('days'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('days') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group {{ ((old('type') == 0 && old('type') !== null) || old('type') == null ? '' : 'd-none') }}" id="form-group-discount">
                <label for="i-percentage">{{ __('Percentage off') }}</label>
                <div class="input-group">
                    <input type="text" name="percentage" id="i-percentage" class="form-control{{ $errors->has('percentage') ? ' is-invalid' : '' }}" value="{{ old('percentage') }}"  {{ ((old('type') == 0 && old('type') !== null) || old('type') == null ? '' : 'disabled') }}>
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                @if ($errors->has('percentage'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('percentage') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="i-quantity">{{ __('Quantity') }}</label>
                <input type="text" name="quantity" id="i-quantity" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity') }}">
                @if ($errors->has('quantity'))
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
                @endif
            </div>

            <button type="submit" name="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </form>
    </div>
</div>

<script>
    'use strict';

    window.addEventListener('DOMContentLoaded', function () {
        new ClipboardJS('.btn');
    });
</script>