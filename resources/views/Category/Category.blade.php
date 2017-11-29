@extends('main')
@section('content')
    <div class="panel-heading">All Category <a  class="pull-right" style="color:green;font-size:20px;" href="{{''}}" title="Add"><i class="fa fa-plus"></i></a></div>
    <div class="clearfix"></div>
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="alldepartments">
                <thead>
                <tr>
                    <th>#</th>
                    <th>CATEGORY NAME</th>
                    <th>DESCRIPTION</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>ACTIONS</th>

                </tr>
                </thead>
                <tbody>

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