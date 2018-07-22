<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Invoice, Report as Reports};
use Carbon\Carbon;
use Auth;


class Report extends Controller
{
    public function index() 
    {
        return view('report', ['reports' => Reports::get()]);
    }

    public function store(Request $request) 
    {
        Reports::create($this->setReportData($this->getFilteredInvoices($request)));
        return redirect('/report');
    }

    public function show($id)
    {
        $report = Reports::find($id);
        if ($report) {
            return view('invoices_by_report', ['report' => $report,'invoices' => $this->getFilteredInvoices($report)]);
        }
        return redirect('/report')->withErrors([ 'error' => 'The report does not exist!']);
    }

    private function getFilteredInvoices($request) 
    {
        $tolist = [];
        foreach(Invoice::get() as $key => $invoice) {
            if ($this->checkDates($invoice, $request)) {
                array_push($tolist, $invoice);
            }
        }
        return $tolist;
    }

    /**
     *filter invoices using dates
     */
    private function checkDates($invoice, $request) 
    {
        return (Carbon::parse($invoice->toArray()['created_at']) <= Carbon::parse($request->report_end) && Carbon::parse($invoice->toArray()['created_at']) >= Carbon::parse($request->report_start));

    }

    /**
     *filter invoices using dates
     */
    private function setReportData($data) 
    {
        $sales = 0;
        $profit = 0;

        foreach ($data as $invoice) {
            $sales = $sales + $invoice->amount_due;
            $profit = $profit + $invoice->profit;
        }

        return [
            'report_start' => $data[0]->created_at,
            'report_end'   => $data[count($data)-1]->created_at,
            'user_id'      => Auth::user()->id,
            'total_amount' => $sales,
            'total_earned' => $profit
        ];
    }
}
