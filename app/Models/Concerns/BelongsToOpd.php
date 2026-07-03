<?php

namespace App\Models\Concerns;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToOpd
{
    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function scopeForOpd(Builder $query, string|int|null $opd): Builder
    {
        if (blank($opd)) {
            return $query;
        }

        if (is_numeric($opd)) {
            return $query->where('opd_id', $opd);
        }

        return $query->whereHas('opd', fn (Builder $opdQuery) => $opdQuery->where('slug', $opd));
    }

    public function scopePortal(Builder $query): Builder
    {
        return $query->where(function (Builder $portalQuery) {
            $portalQuery
                ->whereNull('tampil_di_portal')
                ->orWhere('tampil_di_portal', true);
        });
    }
}
