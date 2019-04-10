<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use PDF;

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
        return view('admin.reports.index');
    }  

    public function viewPdf($id)
    {
        $invoice = Invoice::where('id', $id)->first();

        if ($invoice === null) {
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
