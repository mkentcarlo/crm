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
    public function index(Request $request)
    {   
        $type = ['sales', 'consign_in', 'consign_out', 'purchase', 'repair', 'others'];

        $date_string = ""; // range or year month
        
        if ($request->invoice_type == null || !in_array($request->invoice_type, $type)) {
            return redirect('/reports?invoice_type=sales');
        }
        $invoiceType = $request->invoice_type;

        $current = \Request::get('current') ?  \Request::get('current') : '';
        $year = \Request::get('year') ?  \Request::get('year') : '';
        $month = \Request::get('month') ?  \Request::get('month') : '';
        $week = \Request::get('week') ?  \Request::get('week') : '';

        if ($current == 'year') {
            $year = Carbon::now()->format('Y');
            $month = \Request::get('month') ?  \Request::get('month') : '';
            $week = \Request::get('week') ?  \Request::get('week') : '';
            $date_string = $year;
        }

        if($current == 'month') {
            $year = \Request::get('year') ?  \Request::get('year') : Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $week = \Request::get('week') ?  \Request::get('week') : '';
            $date_string = $month.' '.$year;
        }

        if($current == 'week') {
            $year = \Request::get('year') ? \Request::get('year') : Carbon::now()->format('Y');
            $month = \Request::get('month') ?  \Request::get('month') : Carbon::now()->format('m');
            $week = Carbon::now()->weekOfMonth;
        }

        if($current == '' && $year == '' && ($month || $week)) {
            return redirect('/reports?invoice_type='.$invoiceType);
        }

        $total = app()->make('App\Services\InvoiceService')->getReports($request);
        
        

        $cash_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'cash_amount');
        $card_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'card_amount');
        $paynow_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'pay_now_amount');
        $bank_transfer_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'bank_transfer_amount');
        $net_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'net_amount');
        $installment_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'installment_amount');
        $others_total = app()->make('App\Services\InvoiceService')->getInvoiceAmountsByPaymentMode($total, 'others_amount');
        
        if(isset($request->end) && isset($request->start)){
            $date_string = date_format(date_create($request->start),"F d, Y"). ' - '.date_format(date_create($request->end),"F d, Y");
        }
        else{
            if($year){
                $date_string = $year;
            }
            if($month){
                $date_string =  date('F', mktime(0, 0, 0, $month, 10)). ' '.$date_string;
            }
            if($week){
                $date_string = 'Week '.$week. ' '.$date_string;
            }
            
        }


        if($invoiceType == 'others'){
            $purchases = app()->make('App\Services\InvoiceService')->getReports($request, 'purchase');
            $sales = app()->make('App\Services\InvoiceService')->getReports($request, 'sales');
            $others = app()->make('App\Services\InvoiceService')->getReports($request, 'others');
            $total_overall = $sales->sum("total_amount") - $purchases->sum("total_amount") - $others->sum("total_amount");
            $profit_or_loss = $total_overall < 0 ? 'Loss' : 'Profit';
            return view('admin.reports.index', compact('week','month','year','current', 'invoiceType', 'total', 'date_string', 'cash_total', 'card_total', 'paynow_total', 'bank_transfer_total', 'net_total', 'installment_total', 'others_total', 'purchases', 'sales', 'others', 'total_overall', 'profit_or_loss'));
        }


        return view('admin.reports.index', compact('week','month','year','current', 'invoiceType', 'total', 'cash_total', 'card_total', 'paynow_total', 'bank_transfer_total', 'net_total', 'installment_total', 'others_total', 'date_string'));
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
