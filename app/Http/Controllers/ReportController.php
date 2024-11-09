<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\BranchesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    private function getDateRange($dateFilter, $request)
    {
        switch ($dateFilter) {
            case 'today':
                return [Carbon::today(), Carbon::today()];
            case 'yesterday':
                return [Carbon::yesterday(), Carbon::yesterday()];
            case 'this_month':
                return [Carbon::now()->startOfMonth(), Carbon::now()];
            case 'last_3_months':
                return [Carbon::now()->subMonths(3)->startOfMonth(), Carbon::now()];
            case 'custom':
                $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : null;
                $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : null;
                return [$startDate, $endDate];
            default:
                return [null, null];
        }
    }

    public function index(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'today');
        [$startDate, $endDate] = $this->getDateRange($dateFilter, $request);

        $branches = Branch::with(['client', 'client.company'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('contract_date', [$startDate, $endDate]);
            })
            ->get()
            ->map(function ($branch) {
                $contractValue = $branch->generate_price ?? 0;
                $advancePayment = $contractValue * (($branch->first_payment_percent ?? 0) / 100);
                $monthlyPayment = 0;
                $totalPayment = 0;

                if ($branch->payment_type == '20/80') {
                    $installmentMonths = ($branch->installment_quarterly ?? 0) * 3;
                    $monthlyPayment = ($contractValue - $advancePayment) / max($installmentMonths, 1);
                    $totalPayment = $advancePayment + ($monthlyPayment * $installmentMonths);
                } elseif ($branch->payment_type == '100') {
                    $totalPayment = $contractValue;
                }

                $branch->contract_value = $contractValue;
                $branch->advance_payment = $advancePayment;
                $branch->monthly_payment = $monthlyPayment;
                $branch->total_payment = $totalPayment;
                $branch->remaining = $contractValue - $totalPayment;

                return $branch;
            });

        return view('reports.index', compact('branches', 'dateFilter', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'today');
        [$startDate, $endDate] = $this->getDateRange($dateFilter, $request);

        $branches = Branch::with(['client', 'client.company'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('contract_date', [$startDate, $endDate]);
            })
            ->get();

        return Excel::download(new BranchesExport($branches), 'branches_report.xlsx');
    }
}
