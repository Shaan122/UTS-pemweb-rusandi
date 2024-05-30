@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.datapembayaran.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datapembayarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.datapembayaran.fields.id') }}
                        </th>
                        <td>
                            {{ $datapembayaran->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapembayaran.fields.name') }}
                        </th>
                        <td>
                            {{ $datapembayaran->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapembayaran.fields.no') }}
                        </th>
                        <td>
                            {{ $datapembayaran->no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapembayaran.fields.tanggal') }}
                        </th>
                        <td>
                            {{ $datapembayaran->tanggal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapembayaran.fields.total') }}
                        </th>
                        <td>
                            {{ $datapembayaran->total }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.datapembayaran.fields.status') }}
                        </th>
                        <td>
                            {{ $datapembayaran->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.datapembayarans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection