<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionsEssayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic_id'           => 'required',
            'question_text'      => 'required',
            'exam_id'      => 'required',
            'grade'      => 'required',
        ];
    }
}
