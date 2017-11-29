@extends('main')
@section('content')

    <div class="panel-heading"> Add Department</div>
    <div class="clearfix"></div>
    <div class="panel-body">
        <form action="{{route('department.store')}}" method="post" role="form" class="form-horizontal">
            {{ csrf_field() }}
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">Department Name:</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name" required="required">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">Department Description:</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea name="desc" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-row row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-3">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection