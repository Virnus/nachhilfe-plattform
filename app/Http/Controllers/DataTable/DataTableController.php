<?php

namespace App\Http\Controllers\DataTable;

use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;

abstract class DataTableController extends Controller
{
    protected $allowCreation = true;

    protected $allowDeletion = true;

    protected $builder;

    abstract public function builder();

    public function __construct() {
        $builder = $this->builder();

        if (!$builder instanceof Builder) {
            throw new Exception('Entity builder not instance of Builder');
        }
        $this->builder = $builder;

    }

    /**
     * Gibt die Resultate als Json Reponse zurück
     * @param  Request $request
     * @return Response json
     */
    public function index(Request $request) {
        return response()->json([
            'data' => [
                'table' => $this->builder->getModel()->getTable(),
                'displayable' => array_values($this->getDisplayableColumns()),
                'updatable' => array_values($this->getUpdatableColumns()),
                'records' => $this->getRecords($request),
                'custom_types' => $this->getCustomColumnTypes(),
                'custom_columns' => $this->getCustomColumnNames(),
                'allow' => [
                    'creation' => $this->allowCreation,
                    'deletion' => $this->allowDeletion,
                ]
            ]
        ]);
    }

    /**
     * Updated den gewünschten Datensatz, falls zugelassen
     * @param  Int  $id
     * @param  Request $request
     */
    public function update($id, Request $request) {
        if(!$this->allowedDeletion) {
            return;
        }

        $this->builder->find($id)->update($request->only($this->getUpdatableColumns()));
    }
    /**
     * Speichert einen gewünschten Datensatz, falls zugelassen
     * @param  Request $request
     */
    public function store(Request $request) {
        if(!$this->allowCreation) {
            return;
        }

        $this->builder->create($request->only($this->getUpdatableColumns()));
    }

    /**
     * Löscht den gewünschten Datensatz
     * @param  Int  $id
     * @param  Request $request
     */
    public function destroy($id, Request $request) {
        $this->builder->find($id)->delete();
    }

    /**
     * Gibt alle Splaten zurück die enagezeigt werden sollen
     * @return Array
     */
    public function getDisplayableColumns() {
        return array_diff($this->getDatabaseColumnNames(), $this->builder->getModel()->getHidden());
    }

    /**
     * Gibt alle benutzerdefinierten Spalten zurück
     * @return Array
     */
    public function getCustomColumnNames() {
        return [];
    }

    /**
     * Gibt alle benutzerdefinierten Spaltentypen zurück
     * @return Array
     */
    public function getCustomColumnTypes() {
        return [];
    }

    /**
     * Gibt alle Spalten zurück die bearbeitbar sind
     * @return Array
     */
    public function getUpdatableColumns() {
        return $this->getDisplayableColumns();
    }

    /**
     * Gibt alle Spalten zurück die in der Tabelle vorhanden sind
     * @return Array
     */
    protected function getDatabaseColumnNames() {
        return Schema::getColumnListing($this->builder->getModel()->getTable());
    }

    /**
     * Testet ob eine SearchQuery gegeben ist.
     * Gibt alle gefundenen Resultate zurück
     * @param  Request $request
     * @return Array
     */
    protected function getRecords(Request $request) {
        $builder = $this->builder;

        if($this->hasSearchQuery($request)) {
            $builder = $this->buildSearch($builder, $request);
        }
        try {
            return $this->builder->limit(request()->limit)->orderBy('id', 'asc')->get($this->getDisplayableColumns());
        } catch(QueryException $e) {
            return [];
        }


    }

    /**
     * Tested ob SearchQuery gegeben ist
     * @param  Request $request
     * @return boolean
     */
    protected function hasSearchQuery(Request $request) {
        return count(array_filter($request->only(['column', 'operator', 'value']))) === 3;
    }

    /**
     * Stellt die Suche zusammen
     * @param  Builder $builder
     * @param  Request $request
     * @return Builder
     */
    protected function buildSearch(Builder $builder, Request $request) {
        $queryParts = $this->resolveQueryParts($request->operator, $request->value);

        return $builder->where($request->column, $queryParts['operator'], $queryParts['value']);
    }

    /**
     * Gibt alle verfügbaren Suchoptionen zurück
     * @param  String $operator
     * @param  Value $value
     * @return Array 
     */
    protected function resolveQueryParts($operator, $value) {
        return array_get([
            'equals' => [
                'operator' => '=',
                'value' => $value
            ],
            'contains' => [
                'operator' => 'LIKE',
                'value' => "%{$value}%"
            ],
            'starts_with' => [
                'operator' => 'LIKE',
                'value' => "{$value}%"
            ],
            'ends_with' => [
                'operator' => 'LIKE',
                'value' => "%{$value}"
            ],
            'greater_than' => [
                'operator' => '>',
                'value' => $value
            ],
            'less_than' => [
                'operator' => '<',
                'value' => $value
            ],

        ], $operator);
    }
}
