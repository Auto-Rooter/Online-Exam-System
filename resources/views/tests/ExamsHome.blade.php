@extends('layouts.app')

@section('content')
    <h3 class="page-title"> Chose Your Subject</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['registerSubject.register']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Register
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('topic_id', 'Subject', ['class' => 'control-label']) !!}
                    {!! Form::select('topic_id', $topics, old('topic_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('topic_id'))
                        <p class="help-block">
                            {{ $errors->first('topic_id') }}
                        </p>
                    @endif
                </div>
            </div>



        </div>
    </div>

    {!! Form::submit("Register", ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

