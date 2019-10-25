<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Response as ModelResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_list()
    {
        $list = Admin::paginate(20);
        return view('admin.user.list', ['list' => $list]);
    }

    public function add(Request $request){
        $data = $request->except(['repassword', '_token']);
        if ($request->isMethod('post')){
            $validator = Validator::make($data, [
                'name' => 'required|max:255',
                'password' => 'required|max:255',
            ]);
            if (!empty($message = $validator->getMessageBag()->first())){
                return ModelResponse::error($message);
            }
            $insert = Admin::create([
                'name' => $data['name'],
                'password' => Hash::make($data['password'])
            ]);
            if (!$insert){
                return ModelResponse::error('添加失败');
            }
            return ModelResponse::success();
        }
        return view('admin/user/add');
    }

    public function edit(Request $request){
        $data = $request->except(['repassword','_token']);
        $admin = DB::table('admins')->find($data['id']);
        unset($data['id']);
        if (empty($admin)) abort(404);
        if ($request->isMethod('post')){
            $validator = Validator::make($data, [
                'password' => 'required|max:255',
            ]);
            if (!empty($message = $validator->getMessageBag()->first())){
                return ModelResponse::error($message);
            }
            $insert = DB::table('admins')
                ->where(['id' => $data['id']])
                ->update(['password' => Hash::make($data['password'])]);
            if (!$insert){
                return ModelResponse::error('修改失败');
            }
            return ModelResponse::success();
        }
        return view('admin/user/edit', ['admin' => $admin]);
    }


}