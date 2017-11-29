@extends('main')
@section('content')

    <div class="panel-heading"> Add Permission</div>
    <div class="clearfix"></div>
    <div class="panel-body">
        <form action="{{route('permissions.store')}}" method="post" role="form" class="form-horizontal">
            {{ csrf_field() }}


            {{--Display Name--}}

            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">Display Name:</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="display_name" name="display_name" required="required">
                        </div>
                    </div>
                </div>
            </div>



            {{--Actual Name--}}

            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">Slug</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="permission_name" name="name" readonly required="required">
                        </div>
                    </div>
                </div>
            </div>


            {{--Description--}}
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label class="control-label">Description:</label>
                        </div>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="description"></textarea>
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