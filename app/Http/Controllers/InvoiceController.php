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
    public function index()
    {   
        return view('admin.invoice.index');
    }  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $invoiceType = ($request->invoice_type) ? $request->invoice_type : 'sales';
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

                if (in_array('credit_card', $request->payment_method)) {
                    $cardData = [];
                    foreach($request->card_name as $key => $value) {
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
            unset($data['status']);
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
                    'quantity' => 1,
                    'total_amount' => 0
                ]
            );
        }
    }

    public function edit($invoiceId, Request $request)
    {
        $invoice = Invoice::where('id', $invoiceId)->first();

        if ($invoice === null) {
            return redirect('/invoice');
        }

        $invoiceType = ($request->invoice_type) ? $request->invoice_type : $invoice->invoice_type;
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

                if (in_array('credit_card', $request->payment_method)) {
                    $cardData = [];
                    foreach($request->card_name as $key => $value) {
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
            unset($data['status']);
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
                    'quantity' => 1,
                    'total_amount' => 0
                ]
            );
        }
    } 
}
