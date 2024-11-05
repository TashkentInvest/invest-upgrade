<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BranchesExport implements FromView
{
    protected $branches;

    public function __construct($branches)
    {
        $this->branches = $branches;
    }

    public function view(): View
    {
        return view('reports.export', [
            'branches' => $this->branches
        ]);
    }
}
