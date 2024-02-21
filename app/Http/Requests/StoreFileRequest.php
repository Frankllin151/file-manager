<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class StoreFileRequest extends ParentIdBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /*public function authorize(): bool
    {
        return false;
    }*/

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
           'files.*' =>[
            'required' , 
            'file',
            
            function($attibute , $value , $fail){
                  /** @var $value \Illuminate\Http\UploadedFile */
            $file =  File::query()->where('name' , $value->getClientOriginalName())
             ->where("created_by" , Auth::id())
             ->where('parent_id' , $this->parent_id) // or parent
             ->whereNull('deleted_at')
             ->exists(); 
          
             if($file){
                $fail('File "' . $value->getClientOriginalName() . '" already exists.');
             }
            }

          
           ]
        ]);
    }
}
