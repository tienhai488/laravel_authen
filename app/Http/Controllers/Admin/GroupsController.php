<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Module;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    public function index(){
        $listGroup = Group::all();
        return view('admin.groups.list',compact('listGroup'));
    }

    public function add(){
        return view('admin.groups.add');
    }

    public function postAdd(Request $request){
        $request->validate([
            'name'=>'required|min:5|unique:groups,name',
        ],[
            'name.required'=>'Tên nhóm bắt buộc phải nhập!',
            'name.min'=>'Tên nhóm ít nhất :min kí tự!',
            'name.unique'=>'Tên nhóm đã tồn tại!',
        ]);

        $group = new Group();

        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->created_at = date('Y-m-d H:i:s');

        $group->save();
        
        return redirect()->route('admin.groups.index')->with('msg','Thêm nhóm người dùng thành công!');
    }

    public function edit(Group $group){
        return view('admin.groups.edit',compact('group'));
    }

    public function postEdit(Request $request,Group $group){
        $request->validate([
            'name'=>'required|min:5|unique:groups,name,'.$group->id,
        ],[
            'name.required'=>'Tên nhóm bắt buộc phải nhập!',
            'name.min'=>'Tên nhóm ít nhất :min kí tự!',
            'name.unique'=>'Tên nhóm đã tồn tại!',
        ]);

        $group = Group::find($group->id);

        $group->name = $request->name;
        $group->updated_at = date('Y-m-d H:i:s');

        $group->save();
        
        return back()->with('msg','Cập nhập nhóm người dùng thành công!');
    }

    public function delete(Group $group){
        if(Group::find($group->id)->users->count()==0){
            Group::destroy($group->id);
            return redirect()->route('admin.groups.index')->with('msg','Xóa nhóm người dùng thành công!');
        }
        return redirect()->route('admin.groups.index')->with('msg','Bạn không có quyền xóa nhóm người dùng này!');
    }

    public function permission(Group $group){
        $modules = Module::all();
        $roleList = [
            'view'=>'Xem',
            'add'=>'Thêm',
            'edit'=>'Sửa',
            'delete'=>'Xóa',
        ];
        
        if(!empty($group->permission)){
            $roleCheckeds = json_decode($group->permission,true);
        }else{
            $roleCheckeds = [];
        }
        
        return view('admin.groups.permission',compact('group','modules','roleList','roleCheckeds'));
    }
    
    public function postPermission(Request $request,Group $group){
        if(!empty($request->role)){
            $roleArr = $request->role;
        }else{
            $roleArr = [];
        }

        $roleJson = json_encode($roleArr);

        $group->permission = $roleJson;
        $group->save();

        return back()->with('msg','Phân quyền thành công!');
    }
}