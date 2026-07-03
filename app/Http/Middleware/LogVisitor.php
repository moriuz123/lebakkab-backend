<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class LogVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $agent = substr($request->header('User-Agent'), 0, 255);
        $path = $request->path();

        $opdId = null;
        if ($request->has('opd_id')) {
            $opdId = $request->opd_id;
        } elseif ($request->has('opd')) {
            $opd = \App\Models\Opd::where('slug', $request->opd)->first();
            if ($opd) {
                $opdId = $opd->id;
            }
        }

        // Cek apakah sudah ada kunjungan dari IP + UserAgent + opd_id dalam 1 jam terakhir
        $exists = Visitor::where('ip_address', $ip)
            ->where('user_agent', $agent)
            ->where('opd_id', $opdId)
            ->where('visited_at', '>=', Carbon::now()->subHour())
            ->exists();

        // Hanya catat jika belum ada
        if (!$exists) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $agent,
                'page' => $path,
                'visited_at' => now(),
                'opd_id' => $opdId,
            ]);
        }

        return $next($request);
    }
}
