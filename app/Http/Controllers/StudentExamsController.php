<?php

namespace App\Http\Controllers;

use App\Question;
use App\Topic;
use App\Exam;
use App\User;
use App\QuestionEssay;
use App\QuestionsOption;
use Illuminate\Http\Request;
use App\Http\Requests\StoreQuestionsRequest;
use App\Http\Requests\UpdateQuestionsRequest;
use Auth;
use DB;

class StudentExamsController extends Controller
{
    public function __construct()
    {
        $this->middleware('student');
    }

    /**
     * Display a listing of Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {dd("wedwe");
        $user_id = Auth::user()->id;
        $teacher_exams = DB::select("SELECT e.id, e.exam_date, e.exam_type, t.title FROM exams e JOIN topics t ON t.id = e.subject_id Where t.teacher_id = '$user_id'");
        $exams = collect($teacher_exams);

        $examsStudent = DB::select("Select exam.id, exam.exam_date, exam.exam_type, topic.title FROM exam exam Join topics attendencs ON attendencs.topic_id = exam.subject_id Join topics topic ON topic.id = attendencs.topic_id Where a.student_id = 2");

        // attendence Subject exams
        // Select exam.id, exam.exam_date, exam.exam_type, topic.title FROM exam exam Join topics attendencs ON attendencs.topic_id = exam.subject_id Join topics topic ON topic.id = attendencs.topic_id Where a.student_id = 2;
        return view('exams.index', compact('exams'));
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
