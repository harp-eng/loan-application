<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Loan;

class LoanCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $status = [
            Loan::LOAN_STATUS_PENDING => 'Pending',
            Loan::LOAN_STATUS_APPROVED => 'Approved',
            Loan::LOAN_STATUS_REJECTED => 'Rejected',
            Loan::LOAN_STATUS_FULL_PAID => 'Full-Paid'
        ];
        print_r($this->amount);die;
        $total_interest = $this->amount * ($this->interest_rate * $this->loan_term / 100);
        $total_amount_with_interest = $this->amount + $total_interest;
        $monthly_installment = $total_amount_with_interest / $this->loan_term;

        return [
            'id' => (int)$this->id,
            'user' => $this->user->full_name,
            'amount' => number_format($this->amount, 2),
            'loan_term' => $this->loan_term." weeks",
            'interest_rate' => $this->interest_rate." %",
            'total_interest' => number_format($total_interest, 2),
            'total_amount_with_interest' => number_format($total_amount_with_interest, 2),
            'monthly_installment' => number_format($monthly_installment, 2),
            'status' => $status[$this->status],
            'transactions' => RepaymentResource::collection($this->whenLoaded('transactions')),
        ];
    }
}
