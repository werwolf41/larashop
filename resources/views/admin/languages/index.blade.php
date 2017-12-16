@extends('admin.layouts.admin')

@section('title', __('views.admin.languages.index.title'))

@section('content')
    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('admin.language.create') }}"
                   class="btn btn-sm btn-success">{{ __('create') }}</a>
            </div>
        </div>
        {{ Form::open(['route'=>'admin.language.index', 'method' => 'GET', 'class'=>'query']) }}
        <div class="row">
            <div class="col-sm-6">
                <div class="" id="">
                    <label for="perPage">{!! __('perPage', ['PERPAGE' => Form::select('perPage', ['10'=>10, '25'=>25, '50'=>50, '100'=>100], $languages->perPage(), ['class'=>'form-control input-sm perpage', 'aria-controls'=>'datatable']) ]) !!}</label>
                </div>
            </div>
            <div class="col-sm-6">
                <div id="datatable_filter" class="dataTables_filter">
                    <label>{{ __('search') }}
                        {{ Form::text('search', old('search'), ['class'=>'form-control input-sm', 'placeholder'=>'', 'aria-controls'=>'datatable']) }}
                    </label>
                </div>
            </div>
        </div>
        {{ Form::close() }}
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                   width="100%">
                <thead>
                <tr>
                    <th>@sortablelink('name', __('views.admin.languages.index.table_header_name'),['page' =>
                        $languages->currentPage()])
                    </th>
                    <th>@sortablelink('code', __('views.admin.languages.index.table_header_code'),['page' =>
                        $languages->currentPage()])
                    </th>
                    <th>@sortablelink('active', __('views.admin.languages.index.table_header_active'),['page' =>
                        $languages->currentPage()])
                    </th>
                    <th>@sortablelink('primary', __('views.admin.languages.index.table_header_primary'),['page' =>
                        $languages->currentPage()])
                    </th>
                    <th>@sortablelink('created_at', __('views.admin.languages.index.table_header_created_at'),['page' =>
                        $languages->currentPage()])
                    </th>
                    <th>@sortablelink('updated_at', __('views.admin.languages.index.table_header_updated_at'),['page' =>
                        $languages->currentPage()])
                    </th>
                    <th>{{ __('views.admin.languages.index.table_header_actions') }}</th>
                </tr>
                </thead>
                <tbody class="list">
                @foreach($languages as $language)
                    <tr role="row" id="tr_{{$language->id}}">
                        <td>{{ $language->name }}</td>
                        <td>{{ $language->code }}</td>
                        <td>
                            @if($language->active)
                                <span class="label label-primary">{{ __('views.admin.languages.index.table_header_active_on') }}</span>
                            @else
                                <span class="label label-danger">{{ __('views.admin.languages.index.table_header_active_off') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($language->primary)
                                <span class="label label-success">{{ __('views.admin.languages.index.table_header_primary') }}</span>
                            @endif
                        </td>
                        <td>{{ $language->created_at }}</td>
                        <td>{{ $language->updated_at }}</td>
                        <td class="action">
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.language.show', [$language->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.languages.index.show') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.language.edit', [$language->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.languages.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>

                            {{ Form::open(['route' =>['admin.language.destroy', 'id'=> $language->id], 'method'=>'DELETE', 'class'=>'delete']) }}
                            <button
                                    class="btn btn-xs btn-danger user_destroy"
                                    data-tr="tr_{{$language->id}}"
                                    data-toggle="confirmation"
                                    data-btn-ok-label="{{ __('views.admin.languages.index.delete') }}"
                                    data-btn-ok-icon="fa fa-remove"
                                    data-btn-ok-class="btn btn-sm btn-danger user_destroy"
                                    data-btn-cancel-label="{{ __('Cancel') }}"
                                    data-btn-cancel-icon="fa fa-chevron-circle-left"
                                    data-btn-cancel-class="btn btn-sm btn-default"
                                    data-title="{{ __('sure') }}"
                                    data-placement="left"
                                    data-popout="true"
                                    data-singleton="true"><i class="fa fa-trash"></i></button>
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right pagination">
                {{ $languages->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent


    <script>
        $('form.query').on('submit', function (e) {
            e.preventDefault();
            var url = window.location.pathname,
                data = $(this).serialize();
            openPage(url + '?' + data)
        });


        function createTable(data) {
            $('tbody.list').html('');
            $('.pull-right.pagination').html('');
            $.each(data.data, function (i, data) {
                var res = '<tr role="row" id="tr_' + data.id + '">' +
                    '<td>' + data.name + '</td>' +
                    '<td>' + data.code + '</td>' +
                    '<td>';
                if (data.active) {
                    res += '<span class="label label-primary">{{ __('views.admin.languages.index.table_header_active_on') }}</span>';
                } else {
                    res += '<span class="label label-danger">{{ __('views.admin.languages.index.table_header_active_off') }}</span>';
                }
                res += '</td>' +
                    '<td>';
                if (data.primary) {
                    res += ' <span class="label label-success">{{ __('views.admin.languages.index.table_header_primary') }}</span>';
                }
                res += '</td>' +
                    '<td>' + data.created_at + '</td>' +
                    '<td>' + data.updated_at + '</td>' +
                    '<td class="action">' +
                    '<a class="btn btn-xs btn-primary" href="{{ route('admin.language.index') }}/' + data.id + '/"' +
                    'data-toggle="tooltip" data-placement="top"' +
                    'data-title="{{ __('views.admin.languages.index.show') }}">' +
                    '<i class="fa fa-eye"></i>' +
                    '</a>' +
                    '<a class="btn btn-xs btn-info" href="{{ route('admin.language.index') }}/' + data.id + '/edit/"' +
                    'data-toggle="tooltip" data-placement="top"' +
                    'data-title="{{ __('views.admin.languages.index.edit') }}">' +
                    '<i class="fa fa-pencil"></i>' +
                    '</a>' +
                    '<form method="POST" action="{{ route('admin.language.index') }}/' + data.id + '/" accept-charset="UTF-8" class="delete">' +
                    '<input name="_method" value="DELETE" type="hidden">' +
                    '<button ' +
                    'class="btn btn-xs btn-danger user_destroy" ' +
                    'data-tr="tr_' + data.id + '" ' +
                    'data-toggle="confirmation" ' +
                    'data-btn-ok-label="{{ __('views.admin.languages.index.delete') }}"' +
                    'data-btn-ok-icon="fa fa-remove" ' +
                    'data-btn-ok-class="btn btn-sm btn-danger user_destroy" ' +
                    'data-btn-cancel-label="{{ __('Cancel') }}"' +
                    'data-btn-cancel-icon="fa fa-chevron-circle-left" ' +
                    'data-btn-cancel-class="btn btn-sm btn-default" ' +
                    'data-title="{{ __('sure') }}"' +
                    'data-placement="left"' +
                    'data-popout="true" ' +
                    'data-singleton="true" ' +
                    'data-original-title="" ' +
                    'title="">' +
                    '<i class="fa fa-trash"></i>' +
                    '</button>' +
                    '</form>' +
                    '</td>' +
                    '</tr>';
                $('tbody.list').append(res);
            });
            var pages = '';
            if (data.total > 1) {
                if (data.prev_page_url == null) {
                    pages += '<li class="disabled"><span>«</span></li>';
                } else {
                    pages += '<li><a href="' + data.prev_page_url + '" rel="prev">«</a></li>';
                }
                for (var i = 1; i <= data.total; i++) {
                    if (i == data.current_page) {
                        pages += '<li class="active"><span>' + i + '</span></li>';
                    } else {
                        pages += '<li><a href="' + data.path + '?page=' + i + '">' + i + '</a></li>'
                    }
                }
                if (data.next_page_url == null) {
                    pages += '<li class="disabled"><span>»</span></li>';
                } else {
                    pages += '<li><a href="' + data.next_page_url + '" rel="next">»</a></li>';
                }

                pages = '<ul class="pagination">' + pages + '</ul>';
                $('.pull-right.pagination').html(pages);
            }

        }

    </script>

@endsection