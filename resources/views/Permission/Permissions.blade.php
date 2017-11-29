@extends('main')
@section('content')
    <div class="panel-heading">All Permissions <a  class="pull-right" style="color:green;font-size:20px;" href="{{'permissions/create'}}" title="Add"><i class="fa fa-plus"></i></a></div>
    <div class="clearfix"></div>
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
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $permission->display_name }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->created_at->ToFormattedDateString() }}</td>
                    <td>{{ $permission->updated_at->toFormattedDateString() }}</td>

                    <td>
                        <a class="btn btn-info" href="{{route('permissions.edit',$permission->id)}}" title="Edit">Edit</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection