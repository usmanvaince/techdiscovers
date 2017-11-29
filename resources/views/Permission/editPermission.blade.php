@extends('main')
@section('content')

    <div class="panel-heading"> Edit Permission </div>
    <div class="clearfix"></div>
    <div class="panel-body">
        {!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            {{Form::label('name','Display Name:',array('class'=>'control-label'))}}
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $permission->display_name  }}" required="required"/>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row theme-row">
            <div class="col-lg-10">
                <div class="form-group">
                    <div class="col-lg-3">
                        {{Form::label('name','Permission Name',array('class'=>'control-label'))}}
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control" id="permission_name" name="name" value="{{ $permission->name }}" readonly="readonly" required="required">
                    </div>
                </div>
            </div>
        </div>

            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            {{Form::label('name','Description',array('class'=>'control-label'))}}
                        </div>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control" rows="4">{{$permission->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="theme-row row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-3">
                            {!! Form::submit('Update',array('class'=>'btn btn-success form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection