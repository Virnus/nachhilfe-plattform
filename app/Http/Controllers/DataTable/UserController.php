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
        'id', 'name', 'email', 'created_at'
      ];
    }
}
