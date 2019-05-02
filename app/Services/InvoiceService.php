<?php

namespace App\Services;

use App\Invoice;
use Carbon\Carbon;

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
			if ($request->current != '') {
				//$query->where('invoice_type', $request->invoice_type);
				if($request->current == 'week') {
					$dates = $this->getDates('', '', '', 'week');
					$query->whereBetween('created_at', [$dates[0], end($dates)]);
				} 
				if($request->current == 'month') {
					$year = $request->year ? $request->year : Carbon::now()->format('Y');
					$month = Carbon::now()->format('m');
					$week = $request->week ? $request->week : '';
					if ($week == '') {
						$query->whereYear('created_at', $year);
						$query->whereMonth('created_at', $month);
					} else {
						$dates = $this->getDates($year, $month, $week, '');
						$query->whereBetween('created_at', [$dates[0], end($dates)]);
					}
					
				} 
				if($request->current == 'year') {
					$year = Carbon::now()->format('Y');
					$month = $request->month ? $request->month : '';
					$week = $request->week ? $request->week : '';
					if ($week == '' && $month == '') {
						$query->whereYear('created_at', $year);
					} else {
						$dates = $this->getDates($year, $month, $week, '');
						$query->whereBetween('created_at', [$dates[0], end($dates)]);
					}
					
				}
			}
		});
	}

	public function getTransactions() 
	{
		return Invoice::get();
	}

	public function getTransactionsByCustomerId($id) 
	{
		return Invoice::where('customer_id', $id)->get();
	}

	public function getInvoiceByInvoiceTypes($types) 
	{
		return Invoice::whereIn('invoice_type', $types)->get();
	}

	public function getDates($year, $month, $week, $current='') 
    {
        if ($current == 'week') {
            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $week = Carbon::now()->weekOfMonth;
        }

        $dt = \Carbon\Carbon::createFromDate($year, $month);

        $weeks = [];
        $current = 1;
        for($x=1; $x<= $dt->daysInMonth;$x++) {
            //$c = new \Carbon\Carbon('2019-05-'.$x);   
            if($x < 10) {
                $x = '0'.$x;
            }
            $weeks[$current][] = $year.'-'.$month.'-'.$x; 
            if($x%7 == 0) {
                $current++;
            }   
        }

        return $weeks[$week];
    }
}	