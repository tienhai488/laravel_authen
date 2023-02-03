<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index(){
        $listUser = User::all();

        return view('admin.users.list',compact('listUser'));
    }
    
    public function add(){
        $groups = Group::all();
        return view('admin.users.add',compact('groups'));
    }

    public function postAdd(Request $request){
        $request->validate([
            'name'=>'required|min:6',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'group_id'=>function($attribute, $value, $fail){
                if($value==0){
                    $fail('Vui lòng chọn nhóm!');
                }
            },
        ],[
            'name.required'=>'Tên bắt buộc phải nhập!',
            'name.min'=>'Tên ít nhất :min kí tự!',
            'email.required'=>'Email bắt buộc phải nhập!',
            'email.email'=>'Email không hợp lệ!',
            'email.unique'=>'Email đã tồn tại!',
            'password.required'=>'Mật khẩu bắt buộc phải nhập!',
            'password.min'=>'Mật khẩu ít nhất :min kí tự!!',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->user_id = Auth::user()->id;
        $user->created_at = date('Y-m-d H:i:s');

        $user->save();
        
        return redirect()->route('admin.users.index')->with('msg','Thêm người dùng thành công!');
    }

    public function edit(User $user){
        $groups = Group::all();
        return view('admin.users.edit',compact('user','groups'));
    }

    public function postEdit(Request $request,User $user){
        $request->validate([
            'name'=>'required|min:6',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'password'=>function($attribute, $value, $fail){
                if(!empty($value)&&strlen($value)<8){
                    $fail('Mật khẩu ít nhất 8 kí tự!');
                }
            },
            'group_id'=>function($attribute, $value, $fail){
                if($value==0){
                    $fail('Vui lòng chọn nhóm!');
                }
            },
        ],[
            'name.required'=>'Tên bắt buộc phải nhập!',
            'name.min'=>'Tên ít nhất :min kí tự!',
            'email.required'=>'Email bắt buộc phải nhập!',
            'email.email'=>'Email không hợp lệ!',
            'email.unique'=>'Email đã tồn tại!',
        ]);

        $user = User::find($user->id);

        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->group_id = $request->group_id;
        // $user->user_id = Auth::user()->id;
        $user->updated_at = date('Y-m-d H:i:s');

        $user->save();
        
        return back()->with('msg','Cập nhập người dùng thành công!');
    }

    public function delete(User $user){
        if($user->id!== Auth::user()->id){
            User::destroy($user->id);
            return redirect()->route('admin.users.index')->with('msg','Xóa người dùng thành công!');
        }
        return redirect()->route('admin.users.index')->with('msg','Bạn không có quyền xóa người dùng này!');
    }

   
}