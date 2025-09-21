<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadImport extends Model
{
    use HasFactory;
    protected $fillable = [
        'original_name',
        'stored_path',
        'total_rows',
        'processed_rows',
        'status',
        'error'
    ];
    protected $casts = [
        'total_rows' => 'integer',
        'processed_rows' => 'integer',
    ];
}
