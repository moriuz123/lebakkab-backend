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
        // Mendukung multiple OPD yang dipisah koma (contoh: 'diskominfo,utama')
        $opds = explode(',', $opd);
        
        return $query->where(function ($q) use ($opds) {
            foreach ($opds as $singleOpd) {
                $singleOpd = trim($singleOpd);
                
                // Jika keyword 'utama', cari yang opd_id nya NULL (Berita Utama/Pemkab)
                if ($singleOpd === 'utama' || $singleOpd === 'null') {
                    $q->orWhereNull('opd_id');
                } 
                // Jika berupa ID angka
                elseif (is_numeric($singleOpd)) {
                    $q->orWhere('opd_id', $singleOpd);
                } 
                // Jika berupa slug
                else {
                    $q->orWhereHas('opd', fn (Builder $opdQuery) => $opdQuery->where('slug', $singleOpd));
                }
            }
        });
    }
}
