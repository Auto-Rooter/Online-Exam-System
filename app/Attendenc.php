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
class Attendenc extends Model
{
    use SoftDeletes;

    protected $fillable = ['topic_id', 'student_id'];

    public static function boot()
    {
        parent::boot();

    }



    public function user()
    {
        return $this->belongsTo(User::class, 'id')->withTrashed();
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id')->withTrashed();
    }

}
