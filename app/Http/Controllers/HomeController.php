<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inquiry;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
    }

    public function ajaxRequest() {
       return app()->make('App\Services\DataTableService')->renderTransactionsDataTable();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $brands = app()->make('App\Services\BrandService')->getBrands();
        $watches = app()->make('App\Services\ProductService')->getProducts();
        $customers = app()->make('App\Services\CustomerService')->getCustomers();
        $sales = app()->make('App\Services\InvoiceService')->getInvoiceByInvoiceTypes(['sales']);
        $consign_in = app()->make('App\Services\InvoiceService')->getInvoiceByInvoiceTypes(['consign_in']);
        $consign_out = app()->make('App\Services\InvoiceService')->getInvoiceByInvoiceTypes(['consign_out']);
        $purchase = app()->make('App\Services\InvoiceService')->getInvoiceByInvoiceTypes(['purchase']);
        $repair = app()->make('App\Services\InvoiceService')->getInvoiceByInvoiceTypes(['repair']);
        $inquiries = Inquiry::all();
        return view('admin.dashboard', compact('brands', 'watches', 'customers', 'sales', 'consignments', 'purchase', 'repair', 'inquiries'));
    }  
}
