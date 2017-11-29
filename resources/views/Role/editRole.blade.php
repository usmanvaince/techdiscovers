@extends('main')
@section('content')

    <div class="panel-heading"> Edit Role </div>
    <div class="clearfix"></div>
    <div class="panel-body">

        <form action="{{route('roles.update', $role->id)}}" method="post" id="updateRole"/>
           {{csrf_field()}}
           {{method_field('PUT')}}
            <div class="row theme-row">
                <div class="col-lg-10">
                    <div class="form-group">
                        <div class="col-lg-3">
                            {{Form::label('name','Display Name:',array('class'=>'control-label'))}}
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control"  name="display_name" value="{{ $role['display_name']}}"  required="required"/>
                        </div>
                    </div>
                </div>
            </div>

        {{--hidden--}}
        <input type="hidden" value="" name="permissions" id="role-permission"/>

        <div class="row theme-row">
            <div class="col-lg-10">
                <div class="form-group">
                    <div class="col-lg-3">
                        {{Form::label('name','Role Name',array('class'=>'control-label'))}}
                    </div>
                    <div class="col-lg-9">
                        <input type="text" class="form-control"  name="name" value="{{ $role->name }}" readonly="readonly" required="required">
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
                            <textarea name="description" class="form-control" rows="4">{{$role->description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>


        {{--Permissions--}}

        <div class="row theme-row">
            <div class="col-lg-10">
                <div class="form-group">
                    <div class="col-lg-3">
                        {{Form::label('name','Permissions',array('class'=>'control-label'))}}
                    </div>
                    <div class="col-lg-9" id="all-permissions">
                        @foreach ($permissions as $key => $p )
                            <div>
                                @if ( $key < $role->permissions->count()   )
                                  @if( $role->permissions[$key]->id === $p->id )
                                    <input class="permission_checkbox" type="checkbox" value="{{ $p->id  }}" checked="checked"/>
                                    <label>{{$p->display_name}}</label>
                                  @else
                                        <input class="permission_checkbox" type="checkbox" value="{{ $p->id  }}"/>
                                        <label>{{$p->display_name}}</label>
                                  @endif
                                @else
                                    <input class="permission_checkbox" type="checkbox" value="{{ $p->id  }}"/>
                                    <label>{{$p->display_name}}</label>
                                @endif
                            </div>
                        @endforeach


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