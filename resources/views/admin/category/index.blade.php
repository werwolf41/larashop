@extends('admin.layouts.admin')

@section('title', __('views.admin.category.index.title'))

@section('content')
    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('admin.category.create') }}"
                   class="btn btn-sm btn-success">{{ __('create') }}</a>
            </div>
        </div>
        {{ Form::open(['route'=>'admin.category.index', 'method' => 'GET', 'class'=>'query']) }}
        <div class="row">
            <div class="col-sm-6">
                <div class="" id="">
                    <label for="perPage">{!! __('perPage', ['PERPAGE' => Form::select('perPage', ['10'=>10, '25'=>25, '50'=>50, '100'=>100], $categories->perPage(), ['class'=>'form-control input-sm perpage', 'aria-controls'=>'datatable']) ]) !!}</label>
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
                    <th>@sortablelink('name', __('views.admin.category.index.table_header_name'),['page' =>
                        $categories->currentPage()])
                    </th>
                    <th>@sortablelink('code', __('views.admin.category.index.table_header_code'),['page' =>
                        $categories->currentPage()])
                    </th>
                    <th>@sortablelink('active', __('views.admin.category.index.table_header_active'),['page' =>
                        $categories->currentPage()])
                    </th>
                    <th>@sortablelink('primary', __('views.admin.category.index.table_header_primary'),['page' =>
                        $categories->currentPage()])
                    </th>
                    <th>@sortablelink('created_at', __('views.admin.category.index.table_header_created_at'),['page' =>
                        $categories->currentPage()])
                    </th>
                    <th>@sortablelink('updated_at', __('views.admin.category.index.table_header_updated_at'),['page' =>
                        $categories->currentPage()])
                    </th>
                    <th>{{ __('views.admin.category.index.table_header_actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr role="row" id="tr_{{$category->id}}">
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->code }}</td>
                        <td>
                            @if($category->active)
                                <span class="label label-primary">{{ __('views.admin.category.index.table_header_active_on') }}</span>
                            @else
                                <span class="label label-danger">{{ __('views.admin.category.index.table_header_active_off') }}</span>
                            @endif
                        </td>
                        <td>
                            @if($category->primary)
                                <span class="label label-success">{{ __('views.admin.category.index.table_header_primary') }}</span>
                            @endif</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="action">
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.category.show', [$category->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.category.index.show') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-xs btn-info" href="{{ route('admin.category.edit', [$category->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               data-title="{{ __('views.admin.category.index.edit') }}">
                                <i class="fa fa-pencil"></i>
                            </a>

                            {{ Form::open(['route' =>['admin.category.destroy', 'id'=> $category->id], 'method'=>'DELETE']) }}
                            <button
                                    class="btn btn-xs btn-danger user_destroy"
                                    data-tr="tr_{{$category->id}}"
                                    data-toggle="confirmation"
                                    data-btn-ok-label="{{ __('views.admin.category.index.delete') }}"
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
            <div class="pull-right">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection