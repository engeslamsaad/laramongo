@extends('default')
@section('content')
<div class="row">
    {{-- <div class="col-md-4 col-sm-4 col-xs-4">
       <div class="panel panel-default">
            <div class="panel-heading">Form User</div>
            <div class="panel-body">
                {!! @Form::open(array('route' => route_save, 'class' => 'test-form')) !!}
                <div class="form-group">
                    {!! @Form::label('username') !!}
                    {!! @Form::text('username', null,
                                    array('required',
                                            'class' => 'form-control',
                                            'placeholder' => 'Username' )) !!}
                </div>
                <div class="form-group">
                    {!! @Form::label('email') !!}
                    {!! @Form::text('email', null,
                                    array('required',
                                            'class' => 'form-control',
                                            'placeholder' => 'Email' )) !!}
                </div>
                <div class="form-group">
                    {!! @Form::label('Address') !!}
                    {!! @Form::textarea('address', null,
                                    array('required',
                                            'class' => 'form-control',
                                            'placeholder' => 'Address' )) !!}
                </div>
                <div class="form-group">
                    {!! @Form::submit('Insert User',
                                        array('class' => 'btn btn-primary')) !!}
                </div>
                {!! @Form::close() !!}
            </div>
        </div>
    </div> --}}
    
    <div class="col-md-12 col-sm-12 col-xs-12">

        {{-- <div class="panel panel-default">
            <div class="panel-heading">Generate Fake Data <span class="label label-success pull-right">Bonus Function</span></div>
            <div class="panel-body">
                {!! @Form::open(array('route' => route_generate, 'class' => 'test-form form-inline')) !!}
                <div class="form-group">
                    {!! @Form::number('fakedata', null,
                                    array('required',
                                            'min' => '0',
                                            'max' => '1000',
                                            'style' => 'width: 200px;',
                                            'class' => 'form-control',
                                            'placeholder' => 'Example: 1000' )) !!}
                </div>
                <div class="form-group">
                    {!! @Form::submit('Generate',
                                        array('class' => 'btn btn-warning')) !!}
                    <a href="{{ route('route_deleteall') }}" class="btn btn-danger">Delete All Data</a>
                </div>
                {!! @Form::close() !!}
            </div>
        </div> --}}
        <div class="panel panel-default">
            <div class="panel-body">
                <table id="geniustable" class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>user_id</th>
                            <th>user_name</th>
                            <th>message</th>
                            <th>created_at</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
   
@stop