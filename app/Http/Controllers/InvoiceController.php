<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\ProductService;
use App\Services\WoocommerceService;
use App\Invoice;
use App\InvoiceDetail;
use \Carbon\Carbon;
use PDF;
use DB;

class InvoiceController extends Controller
{
    protected $customerService;
    protected $productService;
    public $wooService;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerService $customerService, ProductService $productService, WoocommerceService $wooService)
    {   
        $this->customerService = $customerService;
        $this->productService = $productService;
        $this->wooService = $wooService;
    }

    public function ajaxRequest(Request $request) {
       return app()->make('App\Services\DataTableService')->renderInvoicesDataTable($request);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $type = ['sales', 'consign_in', 'consign_out', 'purchase', 'repair', 'others'];
        
        if ($request->invoice_type == null || !in_array($request->invoice_type, $type)) {
            return redirect('/dashboard');
        }

        $invoice = $request->invoice_type;

        $type = ['sales', 'consign_in', 'consign_out', 'purchase', 'repair', 'others'];

        $date_string = ""; // range or year month

        $current = \Request::get('current') ?  \Request::get('current') : '';
        $year = \Request::get('year') ?  \Request::get('year') : '';
        $month = \Request::get('month') ?  \Request::get('month') : '';
        $week = \Request::get('week') ?  \Request::get('week') : '';
        $start = \Request::get('date_start') ?  \Request::get('date_start') : '';
        $end = \Request::get('date_end') ?  \Request::get('date_end') : '';

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
            return redirect('/invoice?invoice_type='.$invoice);
        }
        
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


        return view('admin.invoice.index', compact('invoice', 'date_string', 'week','month','year','current', 'start', 'end'));
    }  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = ['sales', 'consign_in', 'consign_out', 'purchase', 'repair', 'others'];
        
        if ($request->invoice_type == null || !in_array($request->invoice_type, $type)) {
            return redirect('/dashboard');
        }

        $invoiceType = $request->invoice_type;
        $customers = $this->customerService->getCustomers();
        $products = $this->productService->getProducts();
        $productIds = InvoiceDetail::pluck('product_id')->toArray();

        if ($invoiceType == 'sales') {
            foreach ($products as $key => $value) {
                if (in_array($value['id'], $productIds)) {
                    unset($products[$key]);
                }
            }
        }      
        
        return view('admin.invoice.create', compact('customers', 'products', 'invoiceType'));
    } 

    public function store(Request $request)
    {
        $invoiceType = $request->invoice_type;
        $customerId = $request->customer_id;
        $totalAmt = ($request->total_amount) ? $request->total_amount : 0;
        $status = $request->status;

        $data = [];

        if ($invoiceType == 'sales') {

            if (!empty($request->payment_method)) {
                if (in_array('cash', $request->payment_method)) {
                    $data['cash_amount'] = $request->cash_amount;
                }

                if (in_array('bank_transfer', $request->payment_method)) {
                    $data['bank_transfer_amount'] = $request->bank_transfer_amount;
                }

                if (in_array('pay_now', $request->payment_method)) {
                    $data['pay_now_name'] = $request->pay_now_name;
                    $data['pay_now_amount'] = $request->pay_now_amount;
                }

                if (in_array('net', $request->payment_method)) {
                    $data['net_amount'] = $request->net_amount;
                }

                if (in_array('net', $request->payment_method)) {
                    $data['net_amount'] = $request->net_amount;
                }

                if (in_array('others', $request->payment_method)) {
                    $data['others_specify'] = $request->others_specify;
                    $data['others_amount'] = $request->others_amount;
                }

                if (in_array('installment', $request->payment_method)) {
                    $data['installment_amount'] = $request->installment_amount;
                    $data['installment_duration'] = $request->installment_duration;
                }

                if (in_array('credit_card', $request->payment_method)) {
                    $cardData = [];
                    foreach($request->card_type as $key => $value) {
                        $tmp['card_type'] = $request->card_type[$key];
                        $tmp['bank_name'] = $request->bank_name[$key];
                        $tmp['card_name'] = $request->card_name[$key];
                        $tmp['card_number'] = $request->card_number[$key];
                        $tmp['card_amount'] = $request->card_amount[$key];
                        $cardData[] = $tmp;
                    }
                    $data['card_info'] = $cardData;
                }
            }    

            $data['discount'] = $request->discount;
            $data['tax'] = $request->tax;
            $data['payment_method'] = $request->payment_method;
            $data['remarks'] = $request->remarks;

            $invoice = Invoice::create(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $productData = [];

            if(!empty($request->product_id)) {
                foreach($request->product_id as $key => $value) {
                    $tmpProd['invoice_id'] = $invoice->id;
                    $tmpProd['product_id'] = $request->product_id[$key];
                    $tmpProd['product_name'] = $request->product_name[$key];
                    $tmpProd['featured_src'] = $request->featured_src[$key];
                    $tmpProd['price'] = $request->product_price[$key];
                    $tmpProd['brand_name'] = $request->brand_name[$key];
                    $tmpProd['category_name'] = $request->category_name[$key];
                    $tmpProd['quantity'] = $request->quantity[$key];
                    $tmpProd['total_amount'] = $request->sub_total_amount[$key];
                    $productData[] = $tmpProd;
                    $prodData['in_stock'] = false;
                    $prodData['stock_quantity'] = 0;
                    $data = [
                        'product' => $prodData
                    ];  
                    $this->wooService->process()->put('products/'. $request->product_id[$key], $data);
                }   
                $insertProducts = InvoiceDetail::insert($productData);
            }

        } else if ($invoiceType == 'consign_in' || $invoiceType == 'consign_out') {

            if (!empty($request->included)) {
                if (in_array('box', $request->included)) {
                    $data['box'] = $request->box;
                }

                if (in_array('guarantee_card', $request->included)) {
                    $data['guarantee_card'] = $request->guarantee_card;
                }

                if (in_array('instructions', $request->included)) {
                    $data['instructions'] = $request->instructions;
                }

                if (in_array('others', $request->included)) {
                    $data['others'] = $request->others;
                }
            }
                
            $data['passport_no'] = $request->passport_no;
            $data['watch_condition'] = $request->watch_condition;
            $data['bracelet_condition'] = $request->bracelet_condition;
            $data['consignment_period'] = $request->consignment_period;
            $data['return_date'] = $request->return_date;
            $data['included'] = $request->included;
            $data['remarks'] = $request->remarks;

            $invoice = Invoice::create(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $productData = [];

            if(!empty($request->product_id)) {
                foreach($request->product_id as $key => $value) {
                    $tmpProd['invoice_id'] = $invoice->id;
                    $tmpProd['product_id'] = $request->product_id[$key];
                    $tmpProd['product_name'] = $request->product_name[$key];
                    $tmpProd['featured_src'] = $request->featured_src[$key];
                    $tmpProd['price'] = $request->product_price[$key];
                    $tmpProd['brand_name'] = $request->brand_name[$key];
                    $tmpProd['category_name'] = $request->category_name[$key];
                    $tmpProd['quantity'] = $request->quantity[$key];
                    $tmpProd['total_amount'] = $request->sub_total_amount[$key];
                    $productData[] = $tmpProd;
                    $prodData['in_stock'] = false;
                    $prodData['stock_quantity'] = 0;
                    $data = [
                        'product' => $prodData
                    ];  
                    $this->wooService->process()->put('products/'. $request->product_id[$key], $data);

                    if($invoiceType == 'consign_in') {
                        DB::insert("INSERT INTO wpla_postmeta (meta_key, meta_value,post_id) values (?, ?, ?)", ['returned', 'Yes', $request->product_id[$key]]);
                    }
                }   
                $insertProducts = InvoiceDetail::insert($productData);
            }
            
        } else if ($invoiceType == 'purchase') {

            if (!empty($request->included)) {
                if (in_array('box', $request->included)) {
                    $data['box'] = $request->box;
                }

                if (in_array('guarantee_card', $request->included)) {
                    $data['guarantee_card'] = $request->guarantee_card;
                }

                if (in_array('instructions', $request->included)) {
                    $data['instructions'] = $request->instructions;
                }

                if (in_array('others', $request->included)) {
                    $data['others'] = $request->others;
                }
            }

            if (!empty($request->payment_method)) {
                if (in_array('cash', $request->payment_method)) {
                    $data['cash_amount'] = $request->cash_amount;
                }

                if (in_array('cheque', $request->payment_method)) {
                    $data['cheque_amount'] = $request->cheque_amount;
                }

                if (in_array('bank_transfer', $request->payment_method)) {
                    $data['bank_transfer_amount'] = $request->bank_transfer_amount;
                }
            }

            $data['passport_no'] = $request->passport_no;
            $data['included'] = $request->included;
            $data['payment_method'] = $request->payment_method;
            $data['remarks'] = $request->remarks;

            $invoice = Invoice::create(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $productData = [];

            if(!empty($request->product_id)) {
                foreach($request->product_id as $key => $value) {
                    $tmpProd['invoice_id'] = $invoice->id;
                    $tmpProd['product_id'] = $request->product_id[$key];
                    $tmpProd['product_name'] = $request->product_name[$key];
                    $tmpProd['featured_src'] = $request->featured_src[$key];
                    $tmpProd['price'] = $request->product_price[$key];
                    $tmpProd['brand_name'] = $request->brand_name[$key];
                    $tmpProd['category_name'] = $request->category_name[$key];
                    $tmpProd['quantity'] = $request->quantity[$key];
                    $tmpProd['total_amount'] = $request->sub_total_amount[$key];
                    $productData[] = $tmpProd;
                    // $prodData['in_stock'] = false;
                    // $prodData['stock_quantity'] = 0;
                    // $data = [
                    //     'product' => $prodData
                    // ];  
                    // $this->wooService->process()->put('products/'. $request->product_id[$key], $data);
                }   
                $insertProducts = InvoiceDetail::insert($productData);
            }
            
        } else if ($invoiceType == 'repair') {
            $data = $request->all();

            unset($data['invoice_type']);
            unset($data['customer_id']);
            unset($data['total_amount']);
            unset($data['product_id']);
            unset($data['_token']);

            $invoice = Invoice::create(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $insert = InvoiceDetail::create(
                [
                    'invoice_id' => $invoice->id,
                    'product_id' => $request->product_id,
                    'product_name' => $request->product_name,
                    'featured_src' => $request->featured_src,
                    'price' => $request->price,
                    'brand_name' => $request->brand_name,
                    'category_name' => $request->category_name,
                    'quantity' => 1,
                    'total_amount' => $request->price,
                ]
            );
            $productData['in_stock'] = false;
            $productData['stock_quantity'] = 0;
            $data = [
                'product' => $productData
            ];  
            $this->wooService->process()->put('products/'. $request->product_id, $data);
        } else  if ($invoiceType == 'others') {

            $inoutData = [];
            foreach($request->payment_mode as $key => $value) {
                $tmp['description'] = $request->description[$key];
                $tmp['amount'] = $request->amount[$key];
                $tmp['payment_mode'] = $request->payment_mode[$key];
                $inoutData[] = $tmp;
            }
            $data['in_out_data'] = $inoutData;
            $data['in_out'] = $request->in_out;

            $invoice = Invoice::create(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => 0,
                    'total_amount' => $request->total,
                    'status' => 0,
                    'additional_fields' => json_encode($data)
                ]
            );
        }

        if($invoice) {
            return redirect('/invoice?invoice_type='.$request->invoice_type)->with('success', 'Invoice Successfully Created.');
        }

        return Redirect::back()->withErrors(['msg', 'There something error found.']);
    }

    public function edit($invoiceId, Request $request)
    {
        
        $type = ['sales', 'consign_in', 'consign_out', 'purchase', 'repair', 'others'];
        
        if ($request->invoice_type == null || !in_array($request->invoice_type, $type)) {
            return redirect('/dashboard');
        }

        $invoice = Invoice::where('id', $invoiceId)->where('invoice_type', $request->invoice_type)->first();

        if ($invoice === null) {
            return redirect('/dashboard');
        }

        $invoiceType = $invoice->invoice_type;
        $invoice->additional_fields = json_decode($invoice->additional_fields);
        $customers = $this->customerService->getCustomers();
        $products = $this->productService->getProducts();

        $productIds = InvoiceDetail::pluck('product_id')->toArray();

        if ($invoiceType == 'sales') {
            foreach ($products as $key => $value) {
                if (in_array($value['id'], $productIds)) {
                    unset($products[$key]);
                }
            }
        }
        
        return view('admin.invoice.edit', compact('customers', 'products', 'invoiceType', 'invoice'));
    } 

    public function update($invoiceId, Request $request)
    {
        $invoiceType = $request->invoice_type;
        $customerId = $request->customer_id;
        $totalAmt = ($request->total_amount) ? $request->total_amount : 0;
        $status = $request->status;

        $data = [];

        if ($invoiceType == 'sales') {

            if (!empty($request->payment_method)) {
                if (in_array('cash', $request->payment_method)) {
                    $data['cash_amount'] = $request->cash_amount;
                }

                if (in_array('bank_transfer', $request->payment_method)) {
                    $data['bank_transfer_amount'] = $request->bank_transfer_amount;
                }

                if (in_array('pay_now', $request->payment_method)) {
                    $data['pay_now_name'] = $request->pay_now_name;
                    $data['pay_now_amount'] = $request->pay_now_amount;
                }

                if (in_array('net', $request->payment_method)) {
                    $data['net_amount'] = $request->net_amount;
                }

                if (in_array('net', $request->payment_method)) {
                    $data['net_amount'] = $request->net_amount;
                }

                if (in_array('others', $request->payment_method)) {
                    $data['others_specify'] = $request->others_specify;
                    $data['others_amount'] = $request->others_amount;
                }

                if (in_array('installment', $request->payment_method)) {
                    $data['installment_amount'] = $request->installment_amount;
                    $data['installment_duration'] = $request->installment_duration;
                }

                if (in_array('credit_card', $request->payment_method)) {
                    $cardData = [];
                    foreach($request->card_type as $key => $value) {
                        $tmp['card_type'] = $request->card_type[$key];
                        $tmp['bank_name'] = $request->bank_name[$key];
                        $tmp['card_name'] = $request->card_name[$key];
                        $tmp['card_number'] = $request->card_number[$key];
                        $tmp['card_amount'] = $request->card_amount[$key];
                        $cardData[] = $tmp;
                    }
                    $data['card_info'] = $cardData;
                }
            }

            $data['discount'] = $request->discount;
            $data['tax'] = $request->tax;
            $data['payment_method'] = $request->payment_method;
            $data['remarks'] = $request->remarks;

            $invoice = Invoice::find($invoiceId);
            $invoice->update(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $productData = [];

            if(!empty($request->product_id)) {
                foreach($request->product_id as $key => $value) {
                    $tmpProd['invoice_id'] = $invoiceId;
                    $tmpProd['product_id'] = $request->product_id[$key];
                    $tmpProd['product_name'] = $request->product_name[$key];
                    $tmpProd['featured_src'] = $request->featured_src[$key];
                    $tmpProd['price'] = $request->product_price[$key];
                    $tmpProd['brand_name'] = $request->brand_name[$key];
                    $tmpProd['category_name'] = $request->category_name[$key];
                    $tmpProd['quantity'] = $request->quantity[$key];
                    $tmpProd['total_amount'] = $request->sub_total_amount[$key];
                    $productData[] = $tmpProd;
                    $prodData['in_stock'] = false;
                    $prodData['stock_quantity'] = 0;
                    $data = [
                        'product' => $prodData
                    ];  
                    $this->wooService->process()->put('products/'. $request->product_id[$key], $data);
                } 

                $insertProducts = InvoiceDetail::insert($productData);
            }
            if(!empty($request->in_detail_id)) {
                foreach($request->in_detail_id as $key => $value) {
                    $invoiceDetail = InvoiceDetail::find($value);
                    $invoiceDetail->update(['quantity' => $request->in_quantity[$key], 'price' => $request->in_product_price[$key], 'total_amount' => $request->in_sub_total_amount[$key]]);
                } 

            }

            $detailIds = [];
            if ($request->remove_ids) {
                $detailIds = explode(',', $request->remove_ids);
            }
            InvoiceDetail::whereIn('id', $detailIds)->delete();

        } else if ($invoiceType == 'consign_in' || $invoiceType == 'consign_out') {

            if (!empty($request->included)) {
                if (in_array('box', $request->included)) {
                    $data['box'] = $request->box;
                }

                if (in_array('guarantee_card', $request->included)) {
                    $data['guarantee_card'] = $request->guarantee_card;
                }

                if (in_array('instructions', $request->included)) {
                    $data['instructions'] = $request->instructions;
                }

                if (in_array('others', $request->included)) {
                    $data['others'] = $request->others;
                }
            }
                
            $data['passport_no'] = $request->passport_no;
            $data['watch_condition'] = $request->watch_condition;
            $data['bracelet_condition'] = $request->bracelet_condition;
            $data['consignment_period'] = $request->consignment_period;
            $data['return_date'] = $request->return_date;
            $data['included'] = $request->included;
            $data['remarks'] = $request->remarks;

            $invoice = Invoice::find($invoiceId);
            $invoice->update(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $productData = [];

            if(!empty($request->product_id)) {
                foreach($request->product_id as $key => $value) {
                    $tmpProd['invoice_id'] = $invoiceId;
                    $tmpProd['product_id'] = $request->product_id[$key];
                    $tmpProd['product_name'] = $request->product_name[$key];
                    $tmpProd['featured_src'] = $request->featured_src[$key];
                    $tmpProd['price'] = $request->product_price[$key];
                    $tmpProd['brand_name'] = $request->brand_name[$key];
                    $tmpProd['category_name'] = $request->category_name[$key];
                    $tmpProd['quantity'] = $request->quantity[$key];
                    $tmpProd['total_amount'] = $request->sub_total_amount[$key];
                    $productData[] = $tmpProd;
                    $prodData['in_stock'] = false;
                    $prodData['stock_quantity'] = 0;
                    $data = [
                        'product' => $prodData
                    ];  
                    $this->wooService->process()->put('products/'. $request->product_id[$key], $data);

                    if($invoiceType == 'consign_in') {
                        DB::insert("INSERT INTO wpla_postmeta (meta_key, meta_value,post_id) values (?, ?, ?)", ['returned', 'Yes', $request->product_id[$key]]);
                    }
                } 

                $insertProducts = InvoiceDetail::insert($productData);
            }
            if(!empty($request->in_detail_id)) {
                foreach($request->in_detail_id as $key => $value) {
                    $invoiceDetail = InvoiceDetail::find($value);
                    $invoiceDetail->update(['quantity' => $request->in_quantity[$key], 'price' => $request->in_product_price[$key], 'total_amount' => $request->in_sub_total_amount[$key]]);
                } 

            }
                
            $detailIds = [];
            if ($request->remove_ids) {
                $detailIds = explode(',', $request->remove_ids);
            }
            InvoiceDetail::whereIn('id', $detailIds)->delete();

            $insertProducts = InvoiceDetail::insert($productData);
        } else if ($invoiceType == 'purchase') {

            if (!empty($request->included)) {
                if (in_array('box', $request->included)) {
                    $data['box'] = $request->box;
                }

                if (in_array('guarantee_card', $request->included)) {
                    $data['guarantee_card'] = $request->guarantee_card;
                }

                if (in_array('instructions', $request->included)) {
                    $data['instructions'] = $request->instructions;
                }

                if (in_array('others', $request->included)) {
                    $data['others'] = $request->others;
                }
            }

            if (!empty($request->payment_method)) {
                if (in_array('cash', $request->payment_method)) {
                    $data['cash_amount'] = $request->cash_amount;
                }

                if (in_array('cheque', $request->payment_method)) {
                    $data['cheque_amount'] = $request->cheque_amount;
                }

                if (in_array('bank_transfer', $request->payment_method)) {
                    $data['bank_transfer_amount'] = $request->bank_transfer_amount;
                }
            }
                
            $data['passport_no'] = $request->passport_no;
            $data['included'] = $request->included;
            $data['payment_method'] = $request->payment_method;
            $data['remarks'] = $request->remarks;

            $invoice = Invoice::find($invoiceId);
            $invoice->update(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $productData = [];

            if(!empty($request->product_id)) {
                foreach($request->product_id as $key => $value) {
                    $tmpProd['invoice_id'] = $invoiceId;
                    $tmpProd['product_id'] = $request->product_id[$key];
                    $tmpProd['product_name'] = $request->product_name[$key];
                    $tmpProd['featured_src'] = $request->featured_src[$key];
                    $tmpProd['price'] = $request->product_price[$key];
                    $tmpProd['brand_name'] = $request->brand_name[$key];
                    $tmpProd['category_name'] = $request->category_name[$key];
                    $tmpProd['quantity'] = $request->quantity[$key];
                    $tmpProd['total_amount'] = $request->sub_total_amount[$key];
                    $productData[] = $tmpProd;
                    // $prodData['in_stock'] = false;
                    // $prodData['stock_quantity'] = 0;
                    // $data = [
                    //     'product' => $prodData
                    // ];  
                    // $this->wooService->process()->put('products/'. $request->product_id[$key], $data);
                } 

                $insertProducts = InvoiceDetail::insert($productData);
            }

            if(!empty($request->in_detail_id)) {
                foreach($request->in_detail_id as $key => $value) {
                    $invoiceDetail = InvoiceDetail::find($value);
                    $invoiceDetail->update(['quantity' => $request->in_quantity[$key], 'price' => $request->in_product_price[$key], 'total_amount' => $request->in_sub_total_amount[$key]]);
                } 

            } 

            $detailIds = [];
            if ($request->remove_ids) {
                $detailIds = explode(',', $request->remove_ids);
            }
            InvoiceDetail::whereIn('id', $detailIds)->delete();

            $insertProducts = InvoiceDetail::insert($productData);
        } else if ($invoiceType == 'repair') {
            $data = $request->all();

            unset($data['invoice_type']);
            unset($data['customer_id']);
            unset($data['total_amount']);
            unset($data['product_id']);
            unset($data['_token']);

            $invoice = Invoice::find($invoiceId);
            $invoice->update(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmt,
                    'status' => $status,
                    'additional_fields' => json_encode($data)
                ]
            );

            $insert = InvoiceDetail::create(
                [
                    'invoice_id' => $invoice->id,
                    'product_id' => $request->product_id,
                    'product_name' => $request->product_name,
                    'featured_src' => $request->featured_src,
                    'price' => $request->price,
                    'brand_name' => $request->brand_name,
                    'category_name' => $request->category_name,
                    'quantity' => 1,
                    'total_amount' => $request->price,
                ]
            );
            $prodData['in_stock'] = false;
            $prodData['stock_quantity'] = 0;
            $data = [
                'product' => $prodData
            ];  
            $this->wooService->process()->put('products/'. $request->product_id, $data);
        } else  if ($invoiceType == 'others') {

            $inoutData = [];
            foreach($request->payment_mode as $key => $value) {
                $tmp['description'] = $request->description[$key];
                $tmp['amount'] = $request->amount[$key];
                $tmp['payment_mode'] = $request->payment_mode[$key];
                $inoutData[] = $tmp;
            }
            $data['in_out_data'] = $inoutData;
            $data['in_out'] = $request->in_out;

            $invoice = Invoice::create(
                [
                    'invoice_type' => $invoiceType,
                    'customer_id' => 0,
                    'total_amount' => $request->total,
                    'status' => 0,
                    'additional_fields' => json_encode($data)
                ]
            );
        }

        if($invoice) {
            return redirect('/invoice?invoice_type='.$request->invoice_type)->with('success', 'Invoice Successfully Updated.');
        }

        return Redirect::back()->withErrors(['msg', 'There something error found.']);
    } 

    public function show($invoiceId)
    {
        $invoice = Invoice::where('id', $invoiceId)->first();
   
        if ($invoice == null) {
            return redirect('/dashboard');
        }

        $invoice->additional_fields = json_decode($invoice->additional_fields);

        if($invoice->invoice_type == 'sales') 
        {
            $pdf = PDF::loadView('admin.pdf.sales_invoice', compact('invoice'));
      
            return $pdf->stream('sales_invoice.pdf');
        }

        else if($invoice->invoice_type == 'consign_in') 
        {
            $pdf = PDF::loadView('admin.pdf.consign_in_invoice', compact('invoice'));
      
            return $pdf->stream('consign_in_invoice.pdf');
        }

        else if($invoice->invoice_type == 'consign_out') 
        {
            $pdf = PDF::loadView('admin.pdf.consign_out_invoice',  compact('invoice'));
      
            return $pdf->stream('consign_out_invoice.pdf');
        }

        else if($invoice->invoice_type == 'purchase') 
        {
            $pdf = PDF::loadView('admin.pdf.purchase_invoice', compact('invoice'));
      
            return $pdf->stream('purchase_invoice.pdf');
        }

        else if($invoice->invoice_type == 'repair') 
        {
            $pdf = PDF::loadView('admin.pdf.repair_invoice', compact('invoice'));
      
            return $pdf->stream('repair_invoice.pdf');
        } 
        else if($invoice->invoice_type == 'others') 
        {
            $pdf = PDF::loadView('admin.pdf.others_invoice', compact('invoice'));
      
            return $pdf->stream('others_invoice.pdf');
        }
        else {
            return redirect('/invoice?invoice_type='.$invoice->invoice_type);
        }
    }  

    public function destroy($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        if ($invoice->delete()) {
            $invoice->invoice_detail()->delete();
            return response()->json(
                [
                    'success' => true,
                    'title' => 'Deleted',
                    'msg' => 'Invoice has been deleted!',
                    'type' => 'success'
                ]
            );
        }

        return response()->json(
            [
                'success' => false,
                'title' => 'Deleted',
                'msg' => 'Failed to delete invoice!',
                'type' => 'error'
            ]
        );
    }    
}
