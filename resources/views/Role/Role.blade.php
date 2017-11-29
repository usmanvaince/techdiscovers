@extends('main')
@section('content')
    <div class="clearfix"></div>
    <div class="panel-heading">All Roles</div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="alldepartments">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Display Name</th>
                    <th>Actual Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>ACTIONS</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at->ToFormattedDateString() }}</td>
                    <td>{{ $role->updated_at->toFormattedDateString() }}</td>
                    <td>
                        <a class="btn btn-info" href="{{route('roles.edit',$role->id)}}" title="Edit">Edit</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection