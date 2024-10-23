<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Verification extends Model
{
    use HasFactory;

    protected $table = 'verification_code';

    protected $fillable = ['code', 'expired_at', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
