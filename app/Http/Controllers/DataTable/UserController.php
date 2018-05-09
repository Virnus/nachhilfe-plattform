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
        'id', 'name', 'email', 'ausbildung', 'role', 'verified'
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
            'verified' => 'verifiziert',
        ];
    }

    public function getUpdatableColumns()
    {
        return [
        'name', 'email', 'ausbildung', 'role', 'password', 'verified'
      ];
    }
    public function update($id, Request $request)
    {
        $this->validate($request, [
        'name' => 'required',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id

      ]);

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,',
            'ausbildung' => 'string|in:GYM,WMS,IMS',
            'role' => 'required|string|in:schueler,lehrer,admin',
            'password' => 'required'
        ]);

        if(!$this->allowCreation) {
            return;
        }

        $this->builder->create($request->only($this->getUpdatableColumns()));
    }
}
