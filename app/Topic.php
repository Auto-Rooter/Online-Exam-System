<?php
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 *
 * @package App
 * @property string $title
*/
class Topic extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];

    public static function boot()
    {
        parent::boot();

        Topic::observe(new \App\Observers\UserActionsObserver);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'topic_id')->withTrashed();
    }

    public function questionEssay()
    {
        return $this->hasMany(QuestionEssay::class, 'topic_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id')->withTrashed();
    }

    public function topic()
    {
        return $this->hasMany(Exam::class, 'topic_id')->withTrashed();
    }


    public function attendenc()
    {
        return $this->belongsTo(Attendenc::class, 'topic_id')->withTrashed();
    }
}
