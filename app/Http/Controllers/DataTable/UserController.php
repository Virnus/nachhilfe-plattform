<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends DataTableController
{
    public function builder() {
      return User::query();
    }

    public function getDisplayableColumns() {
      return [
        'id', 'name', 'email', 'ausbildung_id', 'role_id'
      ];
    }
    public function getUpdatableColumns() {
      return [
        'name', 'email', 'ausbildung_id', 'role_id'
      ];
    }
    public function update($id, Request $request) {
      $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email'

      ]);

      $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
}
