@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Incoming Exams </div>

                <div class="panel-body">
                    <div class="row">


                        @if (count($exams) > 0)
                            @foreach ($exams as $exam)

                                <div class="col-md-3 text-center">
                                    <h4><b>{{$exam->title}} :</b> {{ $exam->exam_type }}</h4>
                                    <h4>{{ $exam->exam_date }}</h4>
                                </div>

                            @endforeach
                        @endif


                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
