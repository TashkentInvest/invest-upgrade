<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\CompanyHistory;

class CompanyObserver
{
    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        $this->recordHistory($company, 'created');
    }

    /**
     * Handle the Company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updated(Company $company)
    {
        $this->recordHistory($company, 'updated');
    }

    /**
     * Handle the Company "deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleted(Company $company)
    {
        $this->recordHistory($company, 'deleted');
    }

    /**
     * Handle the Company "restored" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the Company "force deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }

    protected function recordHistory(Company $company, $event)
    {
        CompanyHistory::create([
            'client_id' => $company->id,
            'user_id' => auth()->user()->id,
            'event' => $event,
            'company_name' => $company->company_name,
            'raxbar' => $company->raxbar,
            'bank_code' => $company->bank_code,
            'bank_service' => $company->bank_service,
            'bank_account' => $company->bank_account,
            'stir' => $company->stir,
            'oked' => $company->oked,
            'minimum_wage' => $company->minimum_wage,
        ]);
    }
}
