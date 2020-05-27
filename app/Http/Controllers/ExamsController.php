<?php

namespace App\Http\Controllers;

use App\Question;
use App\TestAnswer;
use App\Topic;
use App\Exam;
use App\User;
use App\QuestionEssay;
use App\QuestionsOption;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionsRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use Auth;
use DB;

class ExamsController extends Controller
{
    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $teacher_exams = DB::select("SELECT e.id, e.exam_date, e.exam_type, t.title FROM exams e JOIN topics t ON t.id = e.subject_id Where t.teacher_id = '$user_id'");
        $exams = collect($teacher_exams);

        return view('exams.index', compact('exams'));
    }

    public function student_index()
    {
         $student_id = Auth::id();
         $exams = DB::select("Select exam.id, exam.exam_date, exam.exam_type, topic.title 
                              FROM exams exam 
                              Join attendencs ON attendencs.topic_id = exam.subject_id 
                              Join topics topic ON topic.id = attendencs.topic_id 
                              Where attendencs.student_id = '$student_id' 
                              and exam.id not in (SELECT exam_id FROM marks where student_id = '$student_id' )");

         return view('exams.student_index', compact('exams'));
    }



    public function correct_answer_index(){

        $essays_questions = TestAnswer::where([['essay_answer','<>', null], ['given_mark',null]])
            ->whereIn('question_id', Question::where('type', false)->pluck('id'))->get();


        $essays_questions->map(function ($answer) {
            $answer['topic'] = Topic::find(Question::find($answer->question_id)->topic_id)->title;
            $answer['exam_type'] = Exam::find(Question::find($answer->question_id)->exam_id)->exam_type;
            $answer['exam_date'] = Exam::find(Question::find($answer->question_id)->exam_id)->exam_date;
            $answer['student_name'] = User::find($answer->user_id)->name;
            $answer['question'] = Question::find($answer->question_id)->question_text;
            return $answer;
        });


        return view('exams.exams_correct_index', compact('essays_questions'));
    }


    public function correct_answer_create($answer_id){
        $student_answer = TestAnswer::find($answer_id);

        $student_answer['student_name'] = User::find($student_answer->user_id)->name;
        $student_answer['question'] = Question::find($student_answer->question_id)->question_text;
        $student_answer['question_grade'] = Question::find($student_answer->question_id)->grade;
        //dd($student_answer);
        return view('exams.exams_correct_create', compact('student_answer'));
    }

    public function correct_answer_commit(Request $request){

        $student_answer = TestAnswer::find($request->questions_id);
        $student_answer->given_mark = $request->grade;
        $student_answer->teacher_feedback = $request->Feedback;
        $student_answer->save();

        return redirect()->route('exams.correct_index');
    }
    /**
     * Show the form for creating new Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_topics = Topic::where('teacher_id', Auth::user()->id);


        $relations = [
            'topics' => $all_topics->pluck('title', 'id')->prepend('Please select', ''),
        ];

        return view('exams.create', $relations);
    }


    /**
     * Store a newly created Question in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $currentexam =  new Exam;
        $currentexam->subject_id = $request['topic_id'];
        $currentexam->exam_date = $request['exam_date'];
        $currentexam->exam_type = $request['exam_type'];
        $currentexam->save();


        return redirect()->route('exams.index');
    }

    public function storeEssayQ(StoreQuestionsRequest $request)
    {

        $question = QuestionEssay::create($request->all());


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

        $question = Question::findOrFail($id);

        return view('questions.edit', compact('question') + $relations);
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
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index');
    }

    /**
     * Delete all selected Question at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Question::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
