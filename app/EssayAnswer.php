<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TestAnswer
 *
 * @package App
 * @property string $question
 * @property string $option
 * @property tinyInteger $correct
 */
class TestAnswer extends Model
{
    use SoftDeletes;

    protected $fillable = ['test_id', 'question_id', 'answer_body'];

    public static function boot()
    {
        parent::boot();

    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
