<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CreateProjectRequest extends FormRequest
{
    protected $errorBag = 'create';    
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
            //'name'=>'required|unique:projects,name',
            'name'=>[
                        'required',
                        Rule::unique('projects')->where(function($query){
                            return $query->where('user_id',Auth::user()->id);
                        })
                    ],
            'thumbnail'=>'image|dimensions:min_width=260,min_height=100' 
        ];
    }

    public function messages(){
        return [
            'name.required'=>'project Name must been take',
            'name.unique'=>'project Name is exists',
            'thumbnail.image'=>'project File is not image type',
            'thumbnail.dimensions' => 'File min size is 260px*200px'   
        ];
    }
}
