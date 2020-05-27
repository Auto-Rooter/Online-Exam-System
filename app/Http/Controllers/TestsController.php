<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Mark;
use DB;
use Auth;
use App\Test;
use App\QuestionEssay;
use App\TestAnswer;
use App\Topic;
use App\Question;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTestRequest;

class TestsController extends Controller
{
    /**
     * Display a new test.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();

        $questions = Question::inRandomOrder()->limit(10)->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }


        return view('tests.create', compact('questions'));
    }

    public function getexam($exam_id){

        $mark = Mark::where([['exam_id','=', $exam_id],['student_id', '=', Auth::id()]])->get();

        if(count($mark)>0){
            return redirect('/');
        }else{
            $questions = collect(Question::where('exam_id', $exam_id)->get());

            $topic_name = "";
            $exam_name = "";

            foreach ($questions as &$question) {

                $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
                $topic_name = Topic::where('id', $question->topic_id)->first()->title;
                $exam_name = Exam::where('id', $question->exam_id)->first()->exam_type;
            }

            $mark = new Mark;
            $mark->student_id = Auth::id();
            $mark->exam_id = $exam_id;
            $mark->test_id = 0;
            $mark->grade = 0 ;
            $mark->save();


            return view('tests.create', compact(['questions','topic_name', 'exam_name']));
        }

    }

    public function listExams()
    {
        // $topics = Topic::inRandomOrder()->limit(10)->get();

        $questions = Question::inRandomOrder()->limit(10)->get();
        foreach ($questions as &$question) {
            $question->options = QuestionsOption::where('question_id', $question->id)->inRandomOrder()->get();
        }


        return view('tests.create', compact('questions'));
    }

    /**
     * Store a newly solved Test in storage with results.
     *
     * @param  \App\Http\Requests\StoreResultsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $result = 0;
        $exam_id = 0;

        $test = Test::create([
            'user_id' => Auth::id(),
            'result'  => $result,
        ]);

        foreach ($request->input('questions', []) as $key => $question) {
            $status = 0;
            $exam_id = Question::find($question)->exam_id;
            $grade = 0;

            if(Question::find($question)->type == true){
                if ($request->input('answers.'.$question) != null
                    && QuestionsOption::find($request->input('answers.'.$question))->correct
                ) {
                    $status = 1;
                    $result += Question::find($question)->grade ;
                    $grade = Question::find($question)->grade;
                }


                TestAnswer::create([
                    'user_id'     => Auth::id(),
                    'test_id'     => $test->id,
                    'question_id' => $question,
                    'option_id'   => $request->input('answers.'.$question),
                    'correct'     => $status,
                    'given_mark'  => $grade
                ]);


            }else{

                if ($request->input('essay_answers.'.$question) != null
                ) {
                    //dd("[*]".$question." : ".$request->input('essay_answers.'.$question));
                    TestAnswer::create([
                        'user_id'     => Auth::id(),
                        'test_id'     => $test->id,
                        'question_id' => $question,
                        'essay_answer' => $request->input('essay_answers.'.$question)
                    ]);
                    //dd($request->input('essay_answers.'.$question));
                }



            }

        }

        $test->update(['result' => $result]);

        $mark = Mark::where([['exam_id','=', $exam_id],['student_id', '=', Auth::id()]])->first();
        $mark->test_id = $test->id;
        $mark->grade = $grade ;
        $mark->save();

        return redirect()->route('results.show', [$test->id]);
    }
}
