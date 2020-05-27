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
class Exam extends Model
{
    use SoftDeletes;

    protected $fillable = ['topic_id', 'date', 'type'];

    public static function boot()
    {
        parent::boot();

    }



    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id')->withTrashed();
    }

    public function mark()
    {
        return $this->belongsTo(Mark::class, 'topic_id')->withTrashed();
    }

    public function question()
    {
        return $this->hasMany(Question::class, 'exam_id')->withTrashed();
    }

}
