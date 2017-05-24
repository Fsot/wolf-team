<?php

namespace wolfteam\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use wolfteam\Models\Permission;
use wolfteam\Models\Role;

class UpdatePermissionRoleRequest extends FormRequest
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

        $permissions = Permission::pluck('name');

        foreach ($permissions as $permission) {
            $rules[$permission] = 'alpha_dash';
        }

       return $rules;
    }
}
