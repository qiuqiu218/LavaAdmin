<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = config('enum.Admin.search.data');
        $keywords = $request->input('keywords') ?? '';
        $field = $request->input('field') ?? array_search(config('enum.Admin.search.default'), $search);
        if (!isset($search[$field])) {
            return $this->error('您搜索的字段不存在');
        }

        $query = Admin::query();
        if ($keywords) {
            $query = $query->where($field, 'like', '%'.$keywords.'%');
        }

        $data = $query->orderBy('id')->paginate(10);
        return view('admin.admin.index', [
            'data' => $data,
            'keywords' => $keywords,
            'field' => $field
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::query()->where('guard_name', 'admin')->get();
        return view('admin.admin.create', [
            'role' => $role
        ]);
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdminRequest $request)
    {
        $input = $request->only('username', 'nickname', 'email', 'phone', 'password', 'role');
        $admin = Admin::query()->create($input);
        $res = $admin->syncRoles($input['role']);
        return $res ? $this->setAutoClose()->success('注册成功') : $this->error('注册失败');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::query()->where('guard_name', 'admin')->get();
        $data = Admin::query()->findOrFail($id);
        $roleName = $data->getRoleNames();
        if (count($roleName) > 0) {
            $data->role = $roleName[0];
        }
        return view('admin.admin.edit', [
            'data' => $data,
            'role' => $role
        ]);
    }

    /**
     * @param AdminRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdminRequest $request, $id)
    {
        $input = $request->only('username', 'nickname', 'email', 'phone', 'password', 'role');
        $admin = Admin::query()->findOrFail($id);

        // 如果更新了信息 验证唯一性
        $validate = [];
        if ($admin->username !== $input['username']) {
            $validate['username'] = 'unique:admins,username';
        }
        if ($admin->email !== $input['email']) {
            $validate['email'] = 'unique:admins,email';
        }
        if ($admin->phone !== $input['phone']) {
            $validate['phone'] = 'unique:admins,phone';
        }
        if (count($validate) > 0) {
            $this->validate($request, $validate);
        }

        $admin->update($input);
        $res = $admin->syncRoles($input['role']);
        return $res ? $this->setAutoClose()->success('修改成功') : $this->error('修改失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = Admin::query()->findOrFail($id)->delete();
        return $res ? $this->setAutoClose()->success('删除成功') : $this->error('删除失败');
    }
}
