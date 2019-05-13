<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\ProductService;
use App\Invoice;
use App\InvoiceDetail;

class InvoiceController extends Controller
{
    protected $customerService;
    protected $productService;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerService $customerService, ProductService $productService)
    {   
        $this->customerService = $customerService;
        $this->productService = $productService;
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

        return view('admin.invoice.index', compact('invoice'));
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
                } 

                $insertProducts = InvoiceDetail::insert($productData);
            }
            if(!empty($request->in_detail_id)) {
                foreach($request->in_detail_id as $key => $value) {
                    $invoiceDetail = InvoiceDetail::find($value);
                    $invoiceDetail->update(['quantity' => $request->in_quantity[$key], 'total_amount' => $request->in_sub_total_amount[$key]]);
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
                } 

                $insertProducts = InvoiceDetail::insert($productData);
            }
            if(!empty($request->in_detail_id)) {
                foreach($request->in_detail_id as $key => $value) {
                    $invoiceDetail = InvoiceDetail::find($value);
                    $invoiceDetail->update(['quantity' => $request->in_quantity[$key], 'total_amount' => $request->in_sub_total_amount[$key]]);
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
                } 

                $insertProducts = InvoiceDetail::insert($productData);
            }

            if(!empty($request->in_detail_id)) {
                foreach($request->in_detail_id as $key => $value) {
                    $invoiceDetail = InvoiceDetail::find($value);
                    $invoiceDetail->update(['quantity' => $request->in_quantity[$key], 'total_amount' => $request->in_sub_total_amount[$key]]);
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
        }

        if($invoice) {
            return redirect('/invoice?invoice_type='.$request->invoice_type)->with('success', 'Invoice Successfully Updated.');
        }

        return Redirect::back()->withErrors(['msg', 'There something error found.']);
    } 

    public function show($invoiceId)
    {
        $invoice = Invoice::where('id', $invoiceId)->first();

        if ($invoice === null) {
            return redirect('/invoice');
        }

        $invoice->additional_fields = json_decode($invoice->additional_fields);

        if ($invoice->invoice_type == 'sales') {
            return view('admin.invoice.sales_invoice_detail', compact('invoice'));
        } else if ($invoice->invoice_type == 'consign_in' || $invoice->invoice_type == 'consign_out') {
            return view('admin.invoice.consignment_invoice_detail', compact('invoice'));
        } else if ($invoice->invoice_type == 'repair') {
            return view('admin.invoice.repair_invoice_detail', compact('invoice'));
        } else if ($invoice->invoice_type == 'purchase') {
            return view('admin.invoice.purchase_invoice_detail', compact('invoice'));
        } else {
            return redirect('/invoice');
        }
    }    
}
