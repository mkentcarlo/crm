<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use PDF;
use \Carbon\Carbon;

class ReportController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
    }

    public function ajaxRequest(Request $request) {
       return app()->make('App\Services\DataTableService')->renderReportsDataTable($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $current = \Request::get('current') ?  \Request::get('current') : '';
        $year = \Request::get('year') ?  \Request::get('year') : '';
        $month = \Request::get('month') ?  \Request::get('month') : '';
        $week = \Request::get('week') ?  \Request::get('week') : '';

        if ($current == 'year') {
            $year = Carbon::now()->format('Y');
            $month = \Request::get('month') ?  \Request::get('month') : '';
            $week = \Request::get('week') ?  \Request::get('week') : '';
        }

        if($current == 'month') {
            $year = \Request::get('year') ?  \Request::get('year') : Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $week = \Request::get('week') ?  \Request::get('week') : '';
        }

        if($current == 'week') {
            $year = \Request::get('year') ? \Request::get('year') : Carbon::now()->format('Y');
            $month = \Request::get('month') ?  \Request::get('month') : Carbon::now()->format('m');
            $week = Carbon::now()->weekOfMonth;
        }

        if($current == '' && $year == '' && ($month || $week)) {
            return redirect('/reports');
        }

        return view('admin.reports.index', compact('week','month','year','current'));
    }  

    public function viewPdf($id)
    {
        $invoice = Invoice::where('id', $id)->first();
   
        if ($invoice == null) {
            return redirect('/reports');
        }

        if($invoice->invoice_type == 'sales') 
        {
            $pdf = PDF::loadView('admin.pdf.sales_invoice', $invoice);
      
            return $pdf->stream('sales_invoice.pdf');
        }

        else if($invoice->invoice_type == 'consign_in') 
        {
            $pdf = PDF::loadView('admin.pdf.consign_in_invoice',  $invoice);
      
            return $pdf->stream('consign_in_invoice.pdf');
        }

        else if($invoice->invoice_type == 'consign_out') 
        {
            $pdf = PDF::loadView('admin.pdf.consign_out_invoice',  $invoice);
      
            return $pdf->stream('consign_out_invoice.pdf');
        }

        else if($invoice->invoice_type == 'purchase') 
        {
            $pdf = PDF::loadView('admin.pdf.purchase_invoice',  $invoice);
      
            return $pdf->stream('purchase_invoice.pdf');
        }

        else if($invoice->invoice_type == 'repair') 
        {
            $pdf = PDF::loadView('admin.pdf.repair_invoice',  $invoice);
      
            return $pdf->stream('repair_invoice.pdf');
        } else {
            return redirect('/reports');
        }
    }
}
