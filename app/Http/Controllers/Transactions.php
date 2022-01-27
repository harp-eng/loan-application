<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transactions extends Controller
{
    //
    public function createInstallment()
    {
        $getData = $request->all();
        $response = $this->validateData($getData,[
            'amount' => ['required', 'regex:/^\d*(\.\d{2})?$/'],
            'payment_method' => 'required|string',
            'loan_id' => 'required|integer',
        ]);
        
        if ($response !== true) {
            return $this->respondJson('please provide valid data format.',$response,200,0);
        }
        
        $loan = Loan::select(['id', 'approved_amount', 'interest_rate', 'loan_tenor'])
                ->where('user_id', auth()->user()->id)
                ->where('id', auth()->user()->id)
                ->where('status', Loan::LOAN_STATUS_APPROVED)
                ->first();

        if ($loan) {
            
            $total_interest = $this->amount * ($this->interest_rate * $this->loan_term / 100);
            $total_amount_with_interest = $this->amount + $total_interest;
            $monthly_installment = number_format($total_amount_with_interest / $this->loan_term, 2, '.', '');
            $given_payment_amount = number_format($$getData['amount'], 2, '.', '');

            if ($monthly_installment === $given_payment_amount) {
                $payment = $loan->transactions()->create($getData);
                return $this->respondWithSuccess('Repayment created.', ['payment' => TransactionCollection::make($payment)]);
            }
            return $this->respondJson('installment amount should be '.$monthly_installment,$response,200,0);
        }
        return $this->respondJson('No loan found to make a payment of installment.',$response,200,0);
    }
}
