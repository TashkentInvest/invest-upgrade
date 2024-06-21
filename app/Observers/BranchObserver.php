<?php

namespace App\Observers;

use App\Models\Branch;
use App\Models\BranchHistory;

class BranchObserver
{
    /**
     * Handle the Branch "created" event.
     *
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    public function created(Branch $branch)
    {
        $this->recordHistory($branch, 'created');
    }

    /**
     * Handle the Branch "updated" event.
     *
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    public function updated(Branch $branch)
    {
        $this->recordHistory($branch, 'updated');
    }

    /**
     * Handle the Branch "deleted" event.
     *
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    public function deleted(Branch $branch)
    {
        $this->recordHistory($branch, 'deleted');
    }

    /**
     * Handle the Branch "restored" event.
     *
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    public function restored(Branch $branch)
    {
        //
    }

    /**
     * Handle the Branch "force deleted" event.
     *
     * @param  \App\Models\Branch  $branch
     * @return void
     */
    public function forceDeleted(Branch $branch)
    {
        //
    }

    protected function recordHistory(Branch $branch, $event)
    {
        BranchHistory::create([
            'client_id' => $branch->client_id,
            'user_id' => auth()->user()->id,
            'event' => $event,
            'contract_apt' => $branch->contract_apt,
            'contract_date' => $branch->contract_date,
            'apz_raqami' => $branch->apz_raqami,
            'apz_sanasi' => $branch->apz_sanasi,
            'kengash' => $branch->kengash,
            'generate_price' => $branch->generate_price,
            'payment_type' => $branch->payment_type,
            'percentage_input' => $branch->percentage_input,
            'installment_quarterly' => $branch->installment_quarterly,
            'branch_kubmetr' => $branch->branch_kubmetr,
            'branch_location' => $branch->branch_location,
            'branch_type' => $branch->branch_type,
            'branch_name' => $branch->branch_name,
            'notification_num' => $branch->notification_num,
            'notification_date' => $branch->notification_date,
            'insurance_policy' => $branch->insurance_policy,
            'bank_guarantee' => $branch->bank_guarantee,
            'application_number' => $branch->application_number,
            'payed_sum' => $branch->payed_sum,
            'payed_date' => $branch->payed_date,
            'first_payment_percent' => $branch->first_payment_percent,
        ]);
    }
}
