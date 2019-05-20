<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inquiry;

class InquiryController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $inquireType = ['read', 'unread'];
        if ($request->inquiry && in_array($request->inquiry, $inquireType)) {
            $inquiries = Inquiry::where('status', $request->inquiry)->orderBy('created_at', 'desc')->paginate(20)->appends($request->all());
        } else {
            $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(20);
        }

        return view('admin.inquiries.index')->with('inquiries', $inquiries);
    }  

    public function show($inquiryId)
    {
        $inquiry = Inquiry::where('id', $inquiryId)->first();

        return view('admin.inquiries.detail', compact('inquiry'));
    }  

    public function marks(Request $request)
    {
        $ids = explode(',', $request->id);
        $action = $request->action;

        if ($action == 'delete') {
            return Inquiry::whereIn('id', $ids)->delete();
        } else {
            $actions = ['read', 'unread'];
            if (in_array($request->action, $actions)) {
                return Inquiry::whereIn('id', $ids)->update(['status' => $request->action]);
            }
        }

        return true;
    }  

    public function deleteInquiry($id) 
    {  
        return Inquiry::where('id', $id)->delete();
    }  

    public function inquiryStatus($id, Request $request) 
    {  
        $inquiry = Inquiry::find($id);
        if($inquiry->update(['status' => $request->status])) {
            return response()->json(
                [
                    'success' => true,
                    'msg' => 'Success'
                ]
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'msg' => 'Failed'
                ]
            );
        }
    }    
}
