@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.questions.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['exams.correct_commit']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Correct
        </div>
        <input
                type="hidden"
                name="questions_id"
                value="{{ $student_answer->id}}">

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <h5> <STRONG>Question:</STRONG> {{ $student_answer->question }} </h5><hr>
                    <h5> <strong><i>{{ $student_answer->student_name }}</i>&nbsp;  Answer :</strong></h5><br>
                    <h4 style="text-align: center; border: solid 1px #0c91e5; margin: 1px; padding: 8px; ">{{ $student_answer->essay_answer }} </h4><hr>
                    <p class="help-block"></p>
                    @if($errors->has('topic_id'))
                        <p class="help-block">
                            {{ $errors->first('topic_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <label name="Grade"> Grade* <b>(From {{  $student_answer->question_grade }} Points)</b> </label>
                    {!! Form::text('grade', old('grade'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('more_info_link'))
                        <p class="help-block">
                            {{ $errors->first('more_info_link') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('Feedback', 'Notes *', ['class' => 'control-label']) !!}
                    {!! Form::textarea('Feedback', "", ['class' => 'form-control ', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('question_text'))
                        <p class="help-block">
                            {{ $errors->first('question_text') }}
                        </p>
                    @endif
                </div>
            </div>


        </div>
    </div>

    {!! Form::submit(trans('quickadmin.save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

