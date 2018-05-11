<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\DB;

class UserController extends DataTableController
{

    public function builder()
    {
        return User::query();
    }

    public function getDisplayableColumns()
    {
        return [
            'id', 'name', 'email', 'ausbildung', 'role', 'verified', 'active'
        ];
    }

    public function getCustomColumnNames() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'ausbildung' => 'Ausbildung',
            'role' => 'Rolle',
            'password' => 'Passwort',
            'verified' => 'Verifiziert',
            'active' => 'Aktiv'
        ];
    }

    public function getUpdatableColumns()
    {
        return [
            'name', 'email', 'ausbildung', 'password', 'role', 'verified', 'active'
        ];
    }

    public function getCustomColumnTypes()
    {
        return [
            'email' => 'email',
            'ausbildung' => 'select|GYM,WMS,IMS',
            'role' => 'select|schueler,lehrer,admin',
            'password' => 'password',
            'verified' => 'checkbox',
            'active' => 'checkbox',
        ];
    }

    public function update($id, Request $request)
    {
        $this->_validate($request, $id);

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }

    public function store(Request $request) {
        $this->_validate($request);

        if(!$this->allowCreation) {
            return;
        }

        $request->merge(['password' => bcrypt($request->password)]);

        $this->builder->create($request->only($this->getUpdatableColumns()));
    }

    private function _validate(Request $request, $id = 0) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'ausbildung' => 'string|in:GYM,WMS,IMS',
            'role' => 'required|string|in:schueler,lehrer,admin',
        ]);
    }
}
