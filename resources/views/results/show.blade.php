@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.results.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view-result')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        @if(Auth::user()->isAdmin())
                        <tr>
                            <th>@lang('quickadmin.results.fields.user')</th>
                            <td>{{ $test->user->name or '' }} ({{ $test->user->email or '' }})</td>
                        </tr>
                        @endif
                        <tr>
                            <th>@lang('quickadmin.results.fields.date')</th>
                            <td>{{ $test->created_at or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.results.fields.result')</th>
                            <td>{{ $total_mark }}</td>
                        </tr>
                    </table>
                <?php $i = 1 ?>
                @foreach($results as $result)
                    @if($result->question != null)
                        @if($result->question->type == true)
                                <table class="table table-bordered table-striped">
                                    <tr class="test-option{{ $result->correct ? '-true' : '-false' }}">
                                        <th style="width: 10%">Question #{{ $i }}</th>
                                        <th>{{ $result->question->question_text or '' }}</th>
                                    </tr>
                                    <tr >
                                        <td>Question Points</td>
                                        <td>{!! $result->question->grade !!} / {{ $result->correct ? $result->question->grade : 0 }}</td>
                                    </tr>
                                    @if ($result->question->code_snippet != '')
                                        <tr>
                                            <td>Code snippet</td>
                                            <td><div class="code_snippet">{!! $result->question->code_snippet !!}</div></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Options</td>
                                        <td>
                                            <ul>
                                                @foreach($result->question->options as $option)
                                                    <li style="@if ($option->correct == 1) font-weight: bold; @endif
                                                    @if ($result->option_id == $option->id) text-decoration: underline @endif">{{ $option->option }}
                                                        @if ($option->correct == 1) <em>(correct answer)</em> @endif
                                                        @if ($result->option_id == $option->id) <em>(your answer)</em> @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Answer Explanation</td>
                                        <td>
                                            {!! $result->question->answer_explanation  !!}
                                            @if ($result->question->more_info_link != '')
                                                <br>
                                                <br>
                                                Read more:
                                                <a href="{{ $result->question->more_info_link }}" target="_blank">{{ $result->question->more_info_link }}</a>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                        @else
                                <table class="table table-bordered table-striped">
                                    <tr class="test-option">
                                        <th style="width: 10%">Question #{{ $i }} (Essay)</th>
                                        <th>{{ $result->question->question_text or '' }}</th>
                                    </tr>
                                    <tr>
                                        <td>Question Points</td>
                                        <td>
                                                {{  $result->question->grade }} / {{ $result->given_mark ? $result->given_mark :  '         ( Your answer is not corrected yet )'  }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student Answer</td>
                                        <td>
                                            <ul>
                                                {{ $result->essay_answer  }}
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher Feedback</td>
                                        <td>
                                            {{ $result->teacher_feedback ? $result->teacher_feedback : '   (Your answer is not corrected yet)' }}
                                        </td>
                                    </tr>
                                </table>
                        @endif

                    @endif

                <?php $i++ ?>
                @endforeach
                </div>
            </div>

            <p>&nbsp;</p>

        </div>
    </div>
@stop
