<?php

namespace App\Http\Requests;

use App\Services\UtilService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'document'   =>['required','string','unique:clients,document'],
           'name'       =>['required'],
           'birthday'   =>['required'],
           'gender'     =>['required',Rule::in('M','F')],
           'address'    =>['required'],
           'city'       =>['required']
        ];
    }

     public function messages(){
        return [
            'document.required'   =>'Informe um documento válido',
            'document.string'     =>'Informe um documento no formato string',
            'document.unique'     =>'O documento informado já está cadastrado no banco de dados',
            'name.required'       =>'Informe um nome válido',
            'name.string'         =>'Informe um nome no formato string',
            'name.unique'         =>'O nome informado já está cadastrado no banco de dados',
            'birthday.required'   =>'Informe a data de nascimento',
            'gender.required'     =>'Informe o sexo',
            'gender.in'           =>'Informe o sexo (M = Masculino | F = Feminino)',
            'address.required'    =>'Informe o endereço',
            'city.required'       =>'Informe a cidade',
           
           
        ];
    }

     protected function prepareForValidation(){
        $this->merge([
           'document'=>isset($this->document)?UtilService::removEspecialCharacter($this->document):''
        ]);
    }
}
