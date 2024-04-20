<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    protected $userService;

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
        $users = $this->userService->getAll();
        return view('users.users', compact('users'));
    }

    public function getUser($id)
    {
        $user = $this->userService->findById($id);

        return view('users.User', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(UserRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $this->userService->create($data);
        return redirect()->route('users')->with('success', 'Country created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        // dd($roles);
        $user = $this->userService->findById($id);
        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();        
        // Kiểm tra xem email đã thay đổi hay không
        $user = User::findOrFail($id);
        if ($user->email === $data['email']) {
            // Nếu email không thay đổi, loại bỏ trường email khỏi dữ liệu được cập nhật
            unset($data['email']);
        }

        //Đồng bộ hóa vai trò của người dùng với các role được chọn từ form.
        if ($request->has('roles')) {
        $user->role()->sync($request->roles); // Sync roles with the user
        }
        // Gọi phương thức update của service
        $this->userService->update($id, $data);   
        return redirect()->route('users')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->userService->delete($id);
        return redirect()->route('users')->with('success', 'Country deleted successfully.');
    }
}
