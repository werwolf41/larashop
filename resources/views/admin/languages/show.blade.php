@extends('admin.layouts.admin')

@section('title', __('views.admin.languages.index.show', ['name' => $language->name]))

@section('content')
    <div class="row">
        <table class="table table-striped table-hover">
            <tbody>

            <tr>
                <th>{{ __('views.admin.languages.index.table_header_name') }}</th>
                <td>{{ $language->name }}</td>
            </tr>

            <tr>
                <th>{{ __('views.admin.languages.index.table_header_code') }}</th>
                <td>{{ $language->code }}</td>
            </tr>

            <tr>
                <th>{{ __('views.admin.languages.index.table_header_active') }}</th>
                <td>
                    @if($language->active)
                        <span class="label label-primary">{{ __('views.admin.languages.index.table_header_active_on') }}</span>
                    @else
                        <span class="label label-danger">{{ __('views.admin.languages.index.table_header_active_off') }}</span>
                    @endif
                </td>
            </tr>

            <tr>
                <th>{{ __('views.admin.languages.index.table_header_primary') }}</th>
                <td>
                    @if($language->confirmed)
                        <span class="label label-success">{{ __('views.admin.languages.index.table_header_primary_yes') }}</span>
                    @else
                        <span class="label label-warning">{{ __('views.admin.languages.index.table_header_primary_not') }}</span>
                    @endif</td>
                </td>
            </tr>

            <tr>
                <th>{{ __('views.admin.languages.index.table_header_created_at') }}</th>
                <td>{{ $language->created_at }} ({{ $language->created_at->diffForHumans() }})</td>
            </tr>

            <tr>
                <th>{{ __('views.admin.languages.index.table_header_updated_at') }}</th>
                <td>{{ $language->updated_at }} ({{ $language->updated_at->diffForHumans() }})</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection