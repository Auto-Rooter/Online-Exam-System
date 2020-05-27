<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @package App
 * @property string $topic
 * @property text $question_text
 * @property text $code_snippet
 * @property text $answer_explanation
 * @property string $more_info_link
 */
class Mark extends Model
{
    use SoftDeletes;

    protected $fillable = ['exam_id', 'grade', 'test_id', 'student_id'];

    public static function boot()
    {
        parent::boot();

    }



    public function user()
    {
        return $this->belongsTo(User::class, 'student_id')->withTrashed();
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id')->withTrashed();
    }

}
