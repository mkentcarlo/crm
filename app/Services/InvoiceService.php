<?php

namespace App\Services;

use App\Invoice;
use Carbon\Carbon;

class InvoiceService  
{
	public function getInvoices($request, $invoice_type = '') 
	{
		return Invoice::where(function($query) use ($request) {
			if ($request->current != '') {
				//$query->where('invoice_type', $request->invoice_type);
				if($request->current == 'week') {
					$year = $request->year ? $request->year : Carbon::now()->format('Y');
					$month = $request->month ? $request->month : Carbon::now()->format('m');
					$dates = $this->getDates($year, $month, '', 'week');
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
			} else {
				$year = $request->year ? $request->year : '';
				$month = $request->month ? $request->month : '';
				$week = $request->week ? $request->week : '';
				$start = $request->date_start ? $request->date_start : '';
				$end = $request->date_end ? $request->date_end : '';
				// echo $start;
				// echo $end;
				if ($week != '' && $month != '' && $year != '') {
					$dates = $this->getDates($year, $month, $week, '');
					$query->whereBetween('created_at', [$dates[0], end($dates)]);
				} else {
					if ($month != '') {
						$query->whereMonth('created_at', $month);
					}

					if ($year != '') {
						$query->whereYear('created_at', $year);
					}

				}
				if($start != '' && $end != ''){
					$query->whereBetween('created_at', [$start, $end]);
				}
			}
		})->where('invoice_type', $request->invoice_type);
	}


	public function getReports($request, $invoice_type = '') 
	{
		return Invoice::where(function($query) use ($request) {
			if ($request->current != '') {
				//$query->where('invoice_type', $request->invoice_type);
				if($request->current == 'week') {
					$year = $request->year ? $request->year : Carbon::now()->format('Y');
					$month = $request->month ? $request->month : Carbon::now()->format('m');
					$dates = $this->getDates($year, $month, '', 'week');
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
			} else {
				$year = $request->year ? $request->year : '';
				$month = $request->month ? $request->month : '';
				$week = $request->week ? $request->week : '';
				$start = $request->date_start ? $request->date_start : '';
				$end = $request->date_end ? $request->date_end : '';
				if ($week != '' && $month != '' && $year != '') {
					$dates = $this->getDates($year, $month, $week, '');
					$query->whereBetween('created_at', [$dates[0], end($dates)]);
				} else {
					if ($month != '') {
						$query->whereMonth('created_at', $month);
					}

					if ($year != '') {
						$query->whereYear('created_at', $year);
					}

				}
				if($start != '' && $end != ''){
					$query->whereBetween('created_at', [$start, $end]);
				}
			}
		})->where('invoice_type', $invoice_type ? $invoice_type  : $request->invoice_type);
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
            $year = ($year) ? $year : Carbon::now()->format('Y');
            $month = ($month) ? $month : Carbon::now()->format('m');
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
	
	public function getInvoiceAmountsByPaymentMode($invoices, $field)
	{
		$total = 0;		
		foreach($invoices->get() as $invoice) {
			$additional_fields = json_decode($invoice->additional_fields);
			if($field == 'card_amount' && isset($additional_fields->card_info)){
				foreach($additional_fields->card_info as $c_info){
					$total += isset($c_info->card_amount) ? $c_info->card_amount : 0;
				}
			}		
			else{
				if(isset($additional_fields->$field)){
					$total += $additional_fields->$field;
				}
			}
		}
		return $total;
	}

	public function calculateProfitorLoss()
	{

	}
}	