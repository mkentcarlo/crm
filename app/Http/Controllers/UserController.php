<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Spatie\Permission\Models\Role;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
     public $userService;
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::withCount(array('users' => function($query)
        {
            $query->where('id', '!=', auth()->id());
        }))->get();

        $users = User::where('id', '!=', auth()->id())->get();
        
        return view('admin.users.index', compact('roles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create-user-form', compact('roles'));
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
            $generatePass   = str_random(8);
            $user = new User;
            $user->username = $request->input('username');
            $user->password = bcrypt($generatePass);
            $user->email = $request->input('email');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->name = $user->firstname." ".$user->lastname;
            $user->contact = $request->input('contact');
            $user->position = $request->input('position');
            $user->assignRole($request->input('role')); 
            if ($user->save()) {
                $data = ['name' => $request->name, 'email' => $request->email, 'password' => $generatePass];
                $this->userService->sendEmailUser($user, (object) $data, 'New Account Information');
                return redirect('users/create')->with('msg', "Successfully added user.");
            }
                
            return redirect('users');
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
        $roles = Role::all();
        $user = User::findOrFail($id);

        return view('admin.users.edit-user-form', compact('roles', 'user'));
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
            $user->email = $request->input('email');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->name = $user->firstname." ".$user->lastname;
            $user->contact = $request->input('contact');
            $user->position = $request->input('position');
            $user->roles()->sync($request->input('role'));  

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            } 
            
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
       ->editColumn('role', function($user){
            return isset($user->roles[0]->name) ? ucfirst($user->roles[0]->name) : '';
       })
       ->editColumn('status', function($user){
            return $user->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
       })
       ->rawColumns(['status','action', 'role'])
       ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.user-profile', compact('user'));
    }

    public function updateProfile(Request $request)
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
            $user->email = $request->input('email');
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->name = $user->firstname." ".$user->lastname;
            $user->contact = $request->input('contact');
            $user->position = $request->input('position');  
            $user->save();
            return redirect('users/profile/'.$id)->with('success', "Successfully updated information.")->withInput();
        }

        return redirect('users/profile/'.$id)
                        ->withErrors($validator)
                        ->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function changePassword($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.user-password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6|different:old_password',
            'password_confirm' => 'required|same:new_password'  
        ]);


        if(!$validator->fails())
        {
            $user = User::findOrFail($id);
            if (Hash::check($request->old_password, $user->password)) { 
               $user->fill([
                'password' => bcrypt($request->new_password)
                ])->save();

               return redirect('users/change-password/'.$id)->with('success', "Successfully updated password.")->withInput();

            } else {
                return redirect('users/change-password/'.$id)
                        ->withErrors(['Password does not match']);
            }
        }

        return redirect('users/change-password/'.$id)
                        ->withErrors($validator)
                        ->withInput();
    }
}
