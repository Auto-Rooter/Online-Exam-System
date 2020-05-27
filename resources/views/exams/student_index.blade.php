@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-10">
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
                                            <a class="btn btn-success" href="{!! route('examwithid', ['exam_id'=>$exam->id]) !!}">Start Exam</a>
                                        </div>
                                 @else

                                        <div class="col-md-4 text-center">
                                            <h4><b>{{$exam->title}} :</b> {{ $exam->exam_type }}</h4>
                                            <h4>{{ $exam->exam_date }}</h4>
                                            <a class="btn btn-success" href="{!! route('examwithid', ['exam_id'=>$exam->id]) !!}">Start Exam</a>
                                        </div>
                                 @endif


                            @endforeach
                        @endif


                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
