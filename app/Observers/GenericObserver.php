<?php

namespace App\Observers;

use App\Models\Audit_log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class GenericObserver
{
    public function created($model)
    {
        $this->log('create', $model, null, $model->toArray());
    }

    public function updated($model)
    {
        $this->log('update', $model, $model->getOriginal(), $model->getChanges());
    }

    public function deleted($model)
    {
        $this->log('delete', $model, $model->toArray(), null);
    }

    private function log($action, $model, $oldData, $newData)
    {
        Audit_log::create([
            'id_usuario' => Auth::id() ?? null,
            'table_name' => $model->getTable(),
            'action' => $action,
            'old_data' => $oldData ? json_encode($oldData) : null,
            'new_data' => $newData ? json_encode($newData) : null,
            'ip' => Request::ip(),
        ]);
    }
}

