<?php

  namespace App\Http\Requests;

  use Auth;
  use App\User;
  use App\Http\Requests\Request;

  class PostFormRequest extends Request
  {
    
    /**
    * Is user authorized to do this?
    * @return bool
    */
    public function authorize() {    
      if ($this->user()->can_post()) {
        return true;
      }
      return false;
    }

    /**
    * Get the validation rules that apply to the request.
    * @return array
    */
    public function rules() {
      return [
        'title' => 'required|unique:posts|max:100',
        'title' => array('Regex:/^[A-Za-z0-9 ]+$/'),
        'content' => 'required',
      ];
    }

  }
