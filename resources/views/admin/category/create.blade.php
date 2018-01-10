@extends('admin.layouts.admin')

@section('title',__('views.admin.categories.create.title') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.category.store', ],'method' => 'post','class'=>'form-horizontal form-label-left', 'id'=>'category-create', 'enctype'=>'multipart/form-data']) }}
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="col-xs-2">
                        <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left">
                            @foreach($languages as $language)
                                <li class="@if($language->primary == 1 ) active @endif"><a
                                            href="#lang{{ $language->id }}" data-toggle="tab"
                                            aria-expanded="false">{{ $language->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-xs-9">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach($languages as $language)
                                <div class="tab-pane @if($language->primary == 1 ) active @endif"
                                     id="lang{{ $language->id }}">
                                    <div class="form-group">

                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                               for="name_{{ $language->id }}">
                                            {{ __('views.admin.category.index.table_header_name') }}
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">

                                            <input id="name_{{ $language->id }}" type="text"
                                                   class="form-control col-md-7 col-xs-12 @if($errors->has('name')) parsley-error @endif"
                                                   name="title[{{ $language->id }}]['name']"
                                                   value="{{ old('title.'.$language->id.'.name') }}" required>
                                            @if($errors->has('title.'.$language->id.'.name'))
                                                <ul class="parsley-errors-list filled">
                                                    @foreach($errors->get('title.'.$language->id.'.name') as $error)
                                                        <li class="parsley-required">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="parent">
                            {{ __('views.admin.category.index.table_header_parent') }}
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <select id="parent" type="text"
                                   class="form-control col-md-7 col-xs-12 @if($errors->has('parent')) parsley-error @endif"
                                    name="parent" required>
                                    <option value="0">Нет</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}}">{{ $category->title->name }}</option>
                                    @endforeach
                            </select>
                            @if($errors->has('parent'))
                                <ul class="parsley-errors-list filled">
                                    @foreach($errors->get('parent') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="slug">
                            {{ __('views.admin.category.index.table_header_slug') }}
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <input id="parent" type="text"
                                    class="form-control col-md-7 col-xs-12 @if($errors->has('slug')) parsley-error @endif"
                                    name="slug" value="{{ old('slug') }}" required>


                            @if($errors->has('slug'))
                                <ul class="parsley-errors-list filled">
                                    @foreach($errors->get('slug') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                               for="file">
                            {{ __('views.admin.category.index.table_header_image') }}
                            <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if( old('image') )
                                <img src="{{ old('image') }}">
                            @else
                                <input id="file" type="file"
                                       class="form-control col-md-7 col-xs-12 @if($errors->has('image')) parsley-error @endif"
                                       name="file" value="{{ old('image') }}" required>
                            @endif

                            <input type="hidden" name="image" value="{{ old('mage') }}">

                            @if($errors->has('image'))
                                <ul class="parsley-errors-list filled">
                                    @foreach($errors->get('image') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>


            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <a class="btn btn-primary"
                       href="{{ route('admin.category.index') }}"> {{ __('views.admin.users.edit.cancel') }}</a>
                    <button type="submit" class="btn btn-success"> {{ __('views.admin.users.edit.save') }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    {!! JsValidator::formRequest('App\Http\Requests\CreateLanguageRequest', '#category-create')->render() !!}

    <script>
        $(document).ready(function () {
            $('[name=file]').on('change', function () {
                var file = this.files[0];

                var data = new FormData();
                $.each( file, function( key, value ){
                    data.append( key, value );
                });
                $.ajax({
                    url: '{{ route('admin.category.upload') }}',
                    type: 'POST',
                    data: data,
                    cache: false,
                    dataType: 'json',
                    processData: false, // Не обрабатываем файлы (Don't process the files)
                    contentType: false, // Так jQuery скажет серверу что это строковой запрос
                    success: function( respond, textStatus, jqXHR ){

                        // Если все ОК

                        if( typeof respond.error === 'undefined' ){
                            // Файлы успешно загружены, делаем что нибудь здесь

                            // выведем пути к загруженным файлам в блок '.ajax-respond'

                            var files_path = respond.files;
                            var html = '';
                            $.each( files_path, function( key, val ){ html += val +'<br>'; } )
                            $('.ajax-respond').html( html );
                        }
                        else{
                            console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error );
                        }
                    },
                    error: function( jqXHR, textStatus, errorThrown ){
                        console.log('ОШИБКИ AJAX запроса: ' + textStatus );
                    }
                });
            });
        });
    </script>
@endsection