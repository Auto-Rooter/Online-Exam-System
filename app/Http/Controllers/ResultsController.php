<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Mark;
use App\Topic;
use Auth;
use App\Test;
use App\TestAnswer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreResultsRequest;
use App\Http\Requests\UpdateResultsRequest;

class ResultsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('student');
    }

    /**
     * Display a listing of Result.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Test::all()->load('user');

        if (!Auth::user()->isAdmin()) {
            $results = $results->where('user_id', '=', Auth::id());
        }

        $results->map(function ($result) {
            $result['grade'] = Mark::where('student_id', Auth::user()->id)->first()->grade;
            $result['subject'] = Topic::find(Exam::find(Mark::where('student_id', Auth::user()->id)->first()->exam_id)->subject_id)->title;
            $result['exam'] = Exam::find(Mark::where('student_id', Auth::user()->id)->first()->exam_id)->exam_type;
            return $result;
        });
        return view('results.index', compact('results'));
    }

    /**
     * Display Result.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

            $test = Test::find($id)->load('user');

            if ($test) {
                $results = TestAnswer::where('test_id', $id)
                    ->with('question')
                    ->with('question.options')
                    ->get()
                ;
            }

            $mark = Mark::where([['test_id', '=', $id] , ['student_id', '=', Auth::id()]])->first();
            $test_answers = TestAnswer::where([['user_id', '=', Auth::id()], ['test_id', '=', $id]])->get();

            $total_mark = 0;
            if($mark !=null){
                foreach ($test_answers as $answer){
                    $total_mark+= $answer->given_mark;
                }

                if($mark->grade != $total_mark){
                    $mark->grade = $total_mark;
                    $mark->save();
                }

                return view('results.show', compact('test', 'results','total_mark'));
            }else{
                return redirect('/');
            }





    }
}
