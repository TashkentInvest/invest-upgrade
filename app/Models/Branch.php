<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'contract_apt',
        'contract_date',
        'apz_raqami',
        'apz_sanasi',
        'kengash',
        'generate_price',
        'payment_type',
        'percentage_input',
        'installment_quarterly',
        
        'branch_kubmetr',
        'branch_location',
        'branch_type',
        'branch_name',
        'notification_num',
        'notification_date',
        'insurance_policy',
        'bank_guarantee',
        'application_number',
        'payed_sum',
        'payed_date',
        'first_payment_percent',
        
        'shaxarsozlik_umumiy_xajmi',
        'qavatlar_soni_xajmi',
        'avtoturargoh_xajmi',
        'qavat_xona_xajmi',
        'umumiy_foydalanishdagi_xajmi',
        'qurilish_turi',
        'coefficient',
        'zona',
        'obyekt_joylashuvi',
        'branch_type_text',

        'kengash_raqami',
        'kengash_sanasi',

        'payment_deadline'
    
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function calculateInstallments()
    {
        $firstPaymentPercent = $this->first_payment_percent;
        $installmentQuarterly = $this->installment_quarterly;

        Log::info('Calculating installments', [
            'first_payment_percent' => $firstPaymentPercent,
            'installment_quarterly' => $installmentQuarterly
        ]);

        if ($firstPaymentPercent && $installmentQuarterly) {
            $payments = $this->payments()->orderBy('payment_date')->get();
            $totalPayments = $payments->sum('amount');

            Log::info('Total payments', ['total_payments' => $totalPayments]);

            $amountAfterFirstPayment = $totalPayments - ($totalPayments * ($firstPaymentPercent / 100));
            Log::info('Amount after first payment', ['amount_after_first_payment' => $amountAfterFirstPayment]);

            $quarterlyInstallment = $amountAfterFirstPayment / $installmentQuarterly;
            Log::info('Quarterly installment amount', ['quarterly_installment' => $quarterlyInstallment]);

            $installments = [];

            foreach ($payments as $payment) {
                $paymentDate = Carbon::parse($payment->payment_date);
                $year = $paymentDate->year;
                $quarter = $this->getQuarter($paymentDate);

                if (!isset($installments[$year])) {
                    $installments[$year] = [];
                }

                if (!isset($installments[$year][$quarter])) {
                    $installments[$year][$quarter] = 0;
                }

                $installments[$year][$quarter] += $payment->amount;
            }

            Log::info('Installments breakdown', ['installments' => $installments]);

            return $installments;
        }

        return null;
    }

    private function getQuarter(Carbon $date)
    {
        $quarter = ceil($date->month / 3);

        switch ($quarter) {
            case 1:
                return 'I - квартал';
            case 2:
                return 'II - квартал';
            case 3:
                return 'III - квартал';
            case 4:
                return 'IV - квартал';
        }
    }


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }

}