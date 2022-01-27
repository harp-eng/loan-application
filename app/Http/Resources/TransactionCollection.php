<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total_interest = $this->loan->amount * ($this->loan->interest_rate * $this->loan->loan_term / 100);
        $total_amount_with_interest = $this->loan->amount + $total_interest;
        $monthly_installment = $total_amount_with_interest / $this->loan->loan_term;

        return [
            'id' => (int)$this->id,
            'user' => $this->user->name,
            'total_amount_with_interest' => number_format($total_amount_with_interest, 2),
            'monthly_installment' => number_format($monthly_installment, 2),
            'payment_method' => $this->payment_method,
            'loan_term' => $this->loan->loan_term." weeks",
            'paid_installments_count' => $this->loan->transactions()->count(),
        ];
    }
}
