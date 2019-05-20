@extends('layouts.app', ['main_css_class' => 'food-page', 'custom_claim' => 'mettiamo in contatto chi opera nel sociale con chi ha qualcosa da mangiare!'])

@section('title', 'Food')

@section('content')
    <div class="project">
        <div class="row primary-6">
            <div class="col-md-6">
                <img src="{{ asset('images/food-bg.svg') }}" class="img-responsive">
            </div>

            <div class="col-md-6">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus pellentesque dolor nec eros imperdiet, ut molestie dolor interdum. Nunc iaculis turpis vel massa gravida placerat. Suspendisse potenti. Praesent posuere posuere sapien ut tincidunt. Pellentesque accumsan, tortor nec euismod mattis, nisl orci maximus nunc, et gravida justo metus ac dolor. Praesent fringilla quis ante ut vehicula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus eu scelerisque nulla, in eleifend diam. Fusce aliquam gravida eleifend. Sed vel risus faucibus, accumsan purus eget, euismod leo. Praesent ultrices nibh sed lorem vestibulum, nec porta eros varius. Mauris tincidunt elit eu fringilla bibendum. Aliquam cursus turpis est.
                </p>
            </div>
        </div>
    </div>
@endsection
