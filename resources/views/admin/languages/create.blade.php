@extends('admin.layouts.admin')

@section('title',__('views.admin.languages.create.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.language.store', ],'method' => 'post','class'=>'form-horizontal form-label-left', 'id'=>'language-create']) }}

                <div class="form-group">

                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name" >
                        {{ __('views.admin.languages.index.table_header_name') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <input id="name" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('name')) parsley-error @endif"
                               name="name" value="{{ old('name') }}" required>
                        @if($errors->has('name'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('name') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                        {{ __('views.admin.languages.index.table_header_code') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="code" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('code')) parsley-error @endif"
                               name="code" value="{{ old('code') }}" required>
                        @if($errors->has('code'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('code') as $error)
                                    <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="active" >
                        {{ __('views.admin.languages.index.table_header_active_on') }}
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input id="active" type="checkbox" class="@if($errors->has('active')) parsley-error @endif"
                                       name="active" @if(old('active')) checked="checked" @endif value="1">
                                @if($errors->has('active'))
                                    <ul class="parsley-errors-list filled">
                                        @foreach($errors->get('active') as $error)
                                            <li class="parsley-required">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primary" >
                        {{ __('views.admin.languages.index.table_header_primary') }}
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input id="primary" type="checkbox" class="@if($errors->has('primary')) parsley-error @endif"
                                       name="confirmed" @if(old('active')) checked="checked" @endif value="1">
                                @if($errors->has('primary'))
                                    <ul class="parsley-errors-list filled">
                                        @foreach($errors->get('primary') as $error)
                                            <li class="parsley-required">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a class="btn btn-primary" href="{{ route('admin.language.index') }}"> {{ __('views.admin.users.edit.cancel') }}</a>
                        <button type="submit" class="btn btn-success"> {{ __('views.admin.users.edit.save') }}</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\CreateLanguageRequest', '#language-create')->render() !!}
@endsection