<?php

namespace App\Http\Controllers;

use App\Attendenc;
use DB;
use Auth;
use App\User;
use App\Test;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class SubjectsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_topics = Topic::all();

        $student_topics = User::find(Auth::user()->id)->attendenc()
            ->with('user') // bring along details of the friend
            ->join('topics', 'topics.id', '=', 'attendencs.topic_id')
            ->get(['topics.*']); // exclude extra details from friends table

        $not_regestered_topics = $all_topics->diff($student_topics);

        $relations = [
            'topics' => $not_regestered_topics->pluck('title', 'id')->prepend('Please select', ''),
        ];

        return view('topics.studentRegister', $relations);
    }

    public function viewHome(){

        $user = User::find(Auth::user()->id);
        $topics = $user->attendenc()
            ->with('user') // bring along details of the friend
            ->join('topics', 'topics.id', '=', 'attendencs.topic_id')
            ->get(['topics.*']); // exclude extra details from friends table


        return view('topics.studentSubject_Index', compact('topics'));
    }

    public function store(Request $request)
    {
        $atten = Attendenc::where([['topic_id',$request['topic_id']],['student_id', Auth::user()->id]])->get();
        if(count($atten)>0){
            return redirect('/');
        }else{
            $currentAttendenc =  new Attendenc;
            $currentAttendenc->topic_id = intval($request['topic_id']);
            $currentAttendenc->student_id = intval(Auth::user()->id);
            $currentAttendenc->save();

            return redirect()->route('SubjectsHome');
        }


    }
}
