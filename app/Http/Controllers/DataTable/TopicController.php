<?php

namespace App\Http\Controllers\Datatable;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Topic;

class TopicController extends DataTableController
{
    public function builder() {
      return Topic::query();
    }

    public function getDisplayableColumns() {
      return [
        'id', 'name', 'subject_id', 'created_at'
      ];
    }
    public function getUpdatableColumns() {
      return [
        'name', 'subject_id'
      ];
    }
    public function update($id, Request $request) {
      $this->validate($request, [
        'name' => 'required',
        'subject_id' => 'required|numeric'
      ]);

      $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
}