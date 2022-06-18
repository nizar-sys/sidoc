<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'status',
        'remark',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function details()
    {
        return $this->hasMany(DocumentDetail::class, 'document_id', 'id');
    }

    // boot function
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = now();
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_at = now();
            $model->updated_by = Auth::id();
        });
        
    }
}
