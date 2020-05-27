<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionEssay;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionsEssayRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use Auth;
use DB;

class QuestionEssayController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }

    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::all();

        return view('questions.index', compact('questions'));
    }



    public function createEssayQ()
    {
        $user_id = Auth::user()->id;
        $teacher_exams = DB::select("SELECT e.id, e.exam_date, e.exam_type, t.title FROM exams e JOIN topics t ON t.id = e.subject_id Where t.teacher_id = '$user_id'");

        $relations = [
            'topics' => \App\Topic::where('teacher_id', Auth::user()->id)->pluck('title', 'id')->prepend('Please select', ''),
            'exams' => collect($teacher_exams)->pluck('exam_type', 'id')->prepend('Please select', ''),
        ];


        return view('questions.essay_create',  $relations);
    }



    public function storeEssayQ(StoreQuestionsEssayRequest $request)
    {

        $question =  new Question;
        $question->topic_id = $request['topic_id'];
        $question->question_text = $request['question_text'];
        $question->exam_id = $request['exam_id'];
        $question->grade = $request['grade'];
        $question->type = false;
        $question->save();

        return redirect()->route('questions.index');
    }


    /**
     * Show the form for editing Question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = QuestionEssay::findOrFail($id);

        return view('questions.edit_essay', compact('question') + $relations);
    }

    /**
     * Update Question in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionsRequest $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());

        return redirect()->route('questions.index');
    }


    /**
     * Display Question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = [
            'topics' => \App\Topic::get()->pluck('title', 'id')->prepend('Please select', ''),
        ];

        $question = Question::findOrFail($id);

        return view('questions.show', compact('question') + $relations);
    }


    /**
     * Remove Question from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = QuestionEssay::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index');
    }



}
