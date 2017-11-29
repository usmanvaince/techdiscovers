@extends('main')
@section('content')

    <div class="panel-heading"> Edit User</div>
    <div class="clearfix"></div>
    <div class="panel-body">
        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            {{Form::label('name','Name:',array('class'=>'control-label'))}}
                        </div>
                        <div class="col-lg-9">
                            {{Form::text('name',Input::old('name',$user->name),array('class'=>'form-control','required' => 'required'))}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            {{Form::label('name','Email:',array('class'=>'control-label'))}}
                        </div>
                        <div class="col-lg-9">
                            {{Form::text('email',Input::old('email',$user->email),array('class'=>'form-control','required' => 'required'))}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            {{Form::label('name','Departments', array('class' => 'control-label'))}}
                        </div>
                        <div class="col-lg-9">
                            <select class="form-control" name="department_id" required>
                                @foreach( $departments as $d )
                                    @if( $user->department_id  ===  $d->id )
                                      <option value="{{$d->id}}" selected="selected">{{$d->name}}</option>
                                    @else
                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                    @endif
                                @endforeach
                            </select>
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