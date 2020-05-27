@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome! </div>

                @if(Auth::user()->isAdmin())
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h1>{{ $questions }}</h1>
                                questions in our database
                            </div>
                            <div class="col-md-6 text-center">
                                <h1>{{ $users }}</h1>
                                users registered
                            </div>
                        </div>
                    </div>
                @endif


                @if(Auth::user()->isStudent())

                    <div class="row" style="margin: 12px">
                        <div class="col-md-12" >
                            <div class="panel panel-default" >
                                <div class="panel-heading">Registered Subjects </div>


                                <div class="panel-body">
                                    <div class="row">
                                        @if (count($topics) > 0)
                                            @foreach ($topics as $topic)

                                                <div class="col-md-6 text-center">
                                                    <h1>{{ $topic->title }}</h1>
                                                </div>

                                            @endforeach
                                        @endif


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row" style="margin: 12px">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Incoming Exams </div>

                                <div class="panel-body">
                                    <div class="row">


                                        @if (count($exams) > 0)
                                            @foreach ($exams as $key => $exam)

                                                @if($key % 3 == 0)
                                    </div><br><br>
                                    <div class="row">
                                        <div class="col-md-4 text-center">
                                            <h4><b>{{$exam->title}} :</b> {{ $exam->exam_type }}</h4>
                                            <h4>{{ $exam->exam_date }}</h4>
                                        </div>
                                        @else

                                            <div class="col-md-4 text-center">
                                                <h4><b>{{$exam->title}} :</b> {{ $exam->exam_type }}</h4>
                                                <h4>{{ $exam->exam_date }}</h4>
                                            </div>
                                        @endif


                                        @endforeach
                                        @endif


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                @endif


                @if(Auth::user()->isTeacher())
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-4 text-center">
                                <h1>{{ $quizzes }}</h1>
                                quizzes in Database
                            </div>

                            <div class="col-md-4 text-center">
                                <h1>{{ $quizzes }}</h1>
                                Subjects in Database
                            </div>

                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection
