<?php

namespace App\Http\Controllers\DataTable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Subject;

class SubjectController extends DataTableController
{
    public function builder() {
        return Subject::query();
    }

    public function getDisplayableColumns() {
        return [
            'id', 'name'
        ];
    }

    public function getCustomColumnNames() {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getUpdatableColumns() {
        return [
            'name'
        ];
    }
    public function update($id, Request $request) {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
}
