<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::all()->count();
        $quizzes = Test::count();
        $average = Test::avg('result');

        $user = User::find(Auth::user()->id);
        $topics = $user->attendenc()
            ->with('user') // bring along details of the friend
            ->join('topics', 'topics.id', '=', 'attendencs.topic_id')
            ->get(['topics.*']); // exclude extra details from friends table

        $exams = null;
        if(Auth::user()->isStudent()){
            $student_id = Auth::id();
            $exams = DB::select("Select exam.id, exam.exam_date, exam.exam_type, topic.title 
                              FROM exams exam 
                              Join attendencs ON attendencs.topic_id = exam.subject_id 
                              Join topics topic ON topic.id = attendencs.topic_id 
                              Where attendencs.student_id = '$student_id' 
                              and exam.id not in (SELECT exam_id FROM marks where student_id = '$student_id' )");
        }

        return view('home', compact('questions', 'users', 'quizzes', 'average', 'topics', 'exams'));
    }
}
