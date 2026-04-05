<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
  
    public function authorize(): bool
    {
       
        return true; 
    }

   
    public function rules(): array
    {
        return [
            
            'title' => 'required|min:3|unique:posts,title,' . $this->post,
            
        
            'description' => 'required|min:10',
            
         
            'user_id' => 'required|exists:users,id',
        ];
    }

  
 public function messages(): array
{
    return [
        'title.required' => 'The post title is required.',
        'title.min' => 'The title must be at least 3 characters.',
        'description.min' => 'The description must be at least 10 characters.',
        'user_id.required' => 'Please select a post creator.', 
    ];
}
}