<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Exports\BranchesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Fetch filter parameters
        $dateFilter = $request->input('date_filter', 'today');
        $startDate = null;
        $endDate = null;

        // Determine date range based on filter
        switch ($dateFilter) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now();
                break;
            case 'last_3_months':
                $startDate = Carbon::now()->subMonths(3);
                $endDate = Carbon::now();
                break;
            case 'custom':
                $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : null;
                $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : null;
                break;
        }

        // Query branches with related client and company data
        $branches = Branch::with(['client', 'client.company'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('contract_date', [$startDate, $endDate]);
            })
            ->get()
            ->map(function ($branch) {
                // Perform calculations
                $contractValue = $branch->generate_price ?? 0;
                $advancePayment = $contractValue * (($branch->first_payment_percent ?? 0) / 100);
                $monthlyPayment = 0;
                $totalPayment = 0;
                $remaining = 0;

                if ($branch->payment_type == '20/80') {
                    $installmentMonths = ($branch->installment_quarterly ?? 0) * 3;
                    $monthlyPayment = ($contractValue - $advancePayment) / max($installmentMonths, 1);
                    $totalPayment = $advancePayment + ($monthlyPayment * $installmentMonths);
                } elseif ($branch->payment_type == '100') {
                    $totalPayment = $contractValue;
                    $advancePayment = $contractValue;
                }

                $remaining = $contractValue - $totalPayment;

                // Add calculated fields to the branch object
                $branch->contract_value = $contractValue;
                $branch->advance_payment = $advancePayment;
                $branch->monthly_payment = $monthlyPayment;
                $branch->total_payment = $totalPayment;
                $branch->remaining = $remaining;

                return $branch;
            });

        return view('reports.index', compact('branches', 'dateFilter', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'today');
        $startDate = null;
        $endDate = null;

        // Determine date range based on filter
        switch ($dateFilter) {
            case 'today':
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now();
                break;
            case 'last_3_months':
                $startDate = Carbon::now()->subMonths(3);
                $endDate = Carbon::now();
                break;
            case 'custom':
                $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date')) : null;
                $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date')) : null;
                break;
        }

        // Query branches with related client and company data
        $branches = Branch::with(['client', 'client.company'])
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('contract_date', [$startDate, $endDate]);
            })
            ->get()
            ->map(function ($branch) {
                // Perform calculations (same as in index)
                $contractValue = $branch->generate_price ?? 0;
                $advancePayment = $contractValue * (($branch->first_payment_percent ?? 0) / 100);
                $monthlyPayment = 0;
                $totalPayment = 0;
                $remaining = 0;

                if ($branch->payment_type == '20/80') {
                    $installmentMonths = ($branch->installment_quarterly ?? 0) * 3;
                    $monthlyPayment = ($contractValue - $advancePayment) / max($installmentMonths, 1);
                    $totalPayment = $advancePayment + ($monthlyPayment * $installmentMonths);
                } elseif ($branch->payment_type == '100') {
                    $totalPayment = $contractValue;
                    $advancePayment = $contractValue;
                }

                $remaining = $contractValue - $totalPayment;

                // Add calculated fields to the branch object
                $branch->contract_value = $contractValue;
                $branch->advance_payment = $advancePayment;
                $branch->monthly_payment = $monthlyPayment;
                $branch->total_payment = $totalPayment;
                $branch->remaining = $remaining;

                return $branch;
            });

        return Excel::download(new BranchesExport($branches), 'branches_report.xlsx');
    }
}
