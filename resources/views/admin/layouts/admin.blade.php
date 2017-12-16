@extends('layouts.app')

@section('body_class','nav-md')

@section('page')
    <div class="container body">
        <div class="main_container">
            @section('header')
                @include('admin.sections.navigation')
                @include('admin.sections.header')
            @show

            @yield('left-sidebar')

            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                        <h1 class="h3">@yield('title')</h1>
                    </div>
                    @if(Breadcrumbs::exists())
                        <div class="title_right">
                            <div class="pull-right">
                                {!! Breadcrumbs::render() !!}
                            </div>
                        </div>
                    @endif
                </div>
                @yield('content')
            </div>

            <footer>
                @include('admin.sections.footer')
            </footer>
        </div>
    </div>
@stop

@section('styles')
    {{ Html::style(mix('assets/admin/css/admin.css')) }}
    {{ Html::style(mix('assets/admin/css/dev.css')) }}
@endsection

@section('scripts')
    {{ Html::script(mix('assets/admin/js/admin.js')) }}
    {{ Html::script(mix('assets/app/js/bootstrap-confirmation.min.js')) }}
    {{ Html::script(mix('assets/admin/js/dev.js')) }}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
@endsection