@extends('main')
@section('content')
    <div class="panel-heading">All Users <a  class="pull-right" style="color:green;font-size:20px;" href="{{'/register'}}" title="Add"><i class="fa fa-plus"></i></a></div>
    <div class="clearfix"></div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="alldepartments">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->ToFormattedDateString() }}</td>
                    <td>{{ $user->updated_at->toFormattedDateString() }}</td>

                    <td>
                        <a class="btn btn-info" href="{{route('users.edit', $user->id)}}" title="Edit">Edit</a>
                        {{Form::open(['method'  => 'delete', 'route' => ['users.destroy',$user->id],'onsubmit' => 'return ConfirmDelete()'])}}
                        {{ Form::hidden('id', $user->id) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
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