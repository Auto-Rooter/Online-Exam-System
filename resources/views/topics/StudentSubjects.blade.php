@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Registered Subjects </div>


                <div class="panel-body">
                    <div class="row">
                        @if (count($topics) > 0)
                            @foreach ($topics as $topic)

                                <div class="col-md-6 text-center">
                                    <h1>{{ $topic->name }}</h1>
                                </div>

                            @endforeach
                        @endif


                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Incoming Exams </div>

                <div class="panel-body">
                    <div class="row">



                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
