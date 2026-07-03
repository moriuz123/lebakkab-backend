<?php

namespace App\Http\Controllers\Api\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

trait FiltersByOpd
{
    protected function applyOpdFilter(Builder $query, Request $request): Builder
    {
        $opd = $request->query('opd_id', $request->query('opd'));

        if (blank($opd)) {
            $table = $query->getModel()->getTable();

            if (Schema::hasColumn($table, 'tampil_di_portal')) {
                return $query->where('tampil_di_portal', true);
            }

            return $query;
        }

        if (is_numeric($opd)) {
            return $query->where('opd_id', $opd);
        }

        return $query->whereHas('opd', fn (Builder $opdQuery) => $opdQuery->where('slug', $opd));
    }
}
