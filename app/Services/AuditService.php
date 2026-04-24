<?php

namespace App\Services;

use App\Models\Audit_log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuditService
{
    /**
     * Log audit record
     */
    public function log(string $table, string $action, ?array $before, ?array $after): void
    {
        Audit_log::create([
            'user_id'        => Auth::id(),
            'table_name'     => $table,
            'action'         => $action,
            'old_data'       => $before,
            'new_data'       => $after,
            'created_at'     => now(),
            'ip'             => Request::ip(),
        ]);
    }

    /**
     * Get audit logs
     */
    public function get(array $filters = [], int $perPage = 30)
    {
        return Audit_log::with('user')
            ->when($filters['table'] ?? null, fn($q, $t) => $q->where('table_name', $t))
            ->when($filters['action'] ?? null, fn($q, $a) => $q->where('action', $a))
            ->when($filters['user_id'] ?? null, fn($q, $u) => $q->where('user_id', $u))
            ->when($filters['from'] ?? null, fn($q, $d) => $q->where('created_at', '>=', $d))
            ->when($filters['to'] ?? null, fn($q, $h) => $q->where('created_at', '<=', $h))
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }
}