<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['amount','loan_term','interest_rate','status','user_id'];

    public const LOAN_STATUS_PENDING = 0;
    public const LOAN_STATUS_APPROVED = 1;
    public const LOAN_STATUS_REJECTED = 2;
    public const LOAN_STATUS_FULL_PAID = 3;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($loan) {
            $loan->user_id = auth()->user()->id;
            $loan->status = self::LOAN_STATUS_PENDING;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
