<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait UserstampsTrait
{
    public static function bootUserstampsTrait()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = Auth::id();
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = Auth::id();
            }
        });

        static::deleting(function ($model) {
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                if (!$model->isDirty('deleted_by')) {
                    $model->deleted_by = Auth::id();
                    $model->save();
                }
            }
        });
    }
}