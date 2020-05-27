@extends('layouts.app')

@section('content')
    <h3 class="page-title"> Add new Exam</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['exams.store']]) !!}

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


                <div class="col-xs-12 form-group">
                    {!! Form::label('typetitle', 'Exam Type*', ['class' => 'control-label']) !!}
                    {!! Form::text('exam_type', old('exam_type'), ['class' => 'form-control', 'placeholder' => 'MidTerm, Final Exam, ....']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('exam_type'))
                        <p class="help-block">
                            {{ $errors->first('exam_type') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-12 form-group">
                    {!! Form::label('datetitle', 'Exam Date*', ['class' => 'control-label']) !!}
                    {!! Form::text('exam_date', old('exam_date'), ['class' => 'form-control', 'placeholder' => 'DD/MM/YYYY']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('exam_date'))
                        <p class="help-block">
                            {{ $errors->first('exam_date') }}
                        </p>
                    @endif
                </div>


            </div>



        </div>
    </div>

    {!! Form::submit("Add", ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

