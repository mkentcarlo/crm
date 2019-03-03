<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create-user-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|max:15',
            'firstname' => 'required|max:15',
            'lastname' => 'required|max:15',  
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        if(!$validator->fails())
        {
            $user = new User;
            $user->username = $request->input('username');
            $user->password = $user->username;
            $user->email = $request->input('email');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->name = $user->firstname." ".$user->lastname;
            $user->contact = $request->input('contact');
            $user->position = $request->input('position');
            $user->save();
            return redirect('users/create')->with('msg', "Successfully added user.");
        }

        return redirect('users/create')
                        ->withErrors($validator)
                        ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit-user-form', ['user' => User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username,'.$id.'|max:15',
            'firstname' => 'required|max:15',
            'lastname' => 'required|max:15',  
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);


        if(!$validator->fails())
        {
            $user = User::findOrFail($id);
            $user->username = $request->input('username');
            $user->password = $user->username;
            $user->email = $request->input('email');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->name = $user->firstname." ".$user->lastname;
            $user->contact = $request->input('contact');
            $user->position = $request->input('position');
            $user->status = $request->input('status');
            $user->save();
            return redirect('users/edit/'.$id)->with('msg', "Successfully updated user.")->withInput();
        }

        return redirect('users/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);
        $response = array(
            'title' => 'Failed',
            'msg' => 'Failed to delete user!',
            'type' => 'error'
        );

        if($user->delete())
        {
            $response['title'] = 'Deleted';
            $response['msg'] = 'User has been deleted!';
            $response['type'] = 'success';
        }
        echo json_encode($response);

    }

    public function getUsers()
    {
       return DataTables::of(User::where('id', '!=', auth()->id())->get())
       ->addColumn('action', '<a href="#modalUserInfo" class="text-inverse pr-10 form-load" data-form-url="'.url('users/edit').'/{{$id}}" title="Edit" data-toggle="modal"><i class="zmdi zmdi-edit txt-warning"></i></a>
       <a href="'.url('users/delete').'/{{$id}}" class="text-inverse delete-user" title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>')
       ->editColumn('status', function($user){
            return $user->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
       })
       ->rawColumns(['status','action'])
       ->make(true);
    }
}
