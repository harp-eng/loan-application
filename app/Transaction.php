<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->user_id = auth()->user()->id;
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
