@extends('layouts.app')

@section('content')
    <h3 class="page-title">Essay Questions</h3>


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')

        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($essays_questions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                <tr>
                    <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                    <th>Student</th>
                    <th>Topic</th>
                    <th> Exam </th>
                    <th> Date </th>
                    <th>@lang('quickadmin.questions.fields.question-text')</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>

                <tbody>
                @if (count($essays_questions) > 0)

                    @foreach ($essays_questions as $e_question)
                        <tr data-entry-id="{{ $e_question->id }}">
                            <td></td>
                            <td>{{ $e_question->student_name }} </td>

                            <td>{{  $e_question->topic }}</td>

                            <td>{{  $e_question->exam_type }}</td>

                            <td>{{ $e_question->exam_date }}</td>

                            <td>{{  $e_question->question }}</td>
                            <td>
                                <a href="{{ route('exams.correct_create',[$e_question->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">@lang('quickadmin.no_entries_in_table')</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('questions.mass_destroy') }}';
    </script>
@endsection