<?php

namespace App\Services;

use  App\Invoice;

class InvoiceService  
{
	public function getInvoices($request) 
	{
		return Invoice::where(function($query) use ($request) {
			if ($request->invoice_type) {
				$query->where('invoice_type', $request->invoice_type);
			}
		});
	}

	public function getReports($request) 
	{
		return Invoice::where(function($query) use ($request) {
			if ($request->invoice_type) {
				$query->where('invoice_type', $request->invoice_type);
			}
		});
	}

	public function getTransactions() 
	{
		return Invoice::get();
	}

	public function getInvoiceByInvoiceTypes($types) 
	{
		return Invoice::whereIn('invoice_type', $types)->get();
	}
}	