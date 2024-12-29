<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_name',
        'recipient_count',
        'province',
        'district',
        'subdistrict',
        'distribution_date',
        'proof',
        'notes',
        'status',
        'rejection_reason'
    ];
}
