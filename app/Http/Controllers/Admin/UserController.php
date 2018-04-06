<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Admin\AdminRequest;
use Spatie\Permission\Models\Role;
use App\Models\Admin\User;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $model = null;

    public function __construct()
    {
        $this->model = new User();
    }

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

        $query = $this->model->query();
        if ($keywords) {
            $query = $query->where($field, 'like', '%'.$keywords.'%');
        }

        $data = $query->orderBy('id')->paginate(10);
        return $this->view([
            'data' => $data,
            'keywords' => $keywords,
            'field' => $field
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $role = Role::query()->where('guard_name', 'web')->get();
        return $this->view([
            'role' => $role
        ]);
    }

    /**
     * @param AdminRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdminRequest $request)
    {
        $input = $request->only($this->model->getFillable());
        $input['api_token'] = str_random(60);
        $user = $this->model->create($input);
        $res = $user->syncRoles($request->input('role'));
        return $res ? $this->setAutoClose()->success('注册成功') : $this->error('注册失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::query()->where('guard_name', 'web')->get();
        $data = $this->model->findOrFail($id);
        $roleName = $data->getRoleNames();
        if (count($roleName) > 0) {
            $data->role = $roleName[0];
        }
        return $this->view([
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
        $input = $request->only($this->model->getFillable());
        $user = $this->model->findOrFail($id);

        // 如果更新了信息 验证唯一性
        $validate = [];
        if ($user->username !== $input['username']) {
            $validate['username'] = 'unique:users,username';
        }
        if ($user->email !== $input['email']) {
            $validate['email'] = 'unique:users,email';
        }
        if ($user->phone !== $input['phone']) {
            $validate['phone'] = 'unique:users,phone';
        }
        if (count($validate) > 0) {
            $this->validate($request, $validate);
        }

        $user->update($input);
        $res = $user->syncRoles($request->input('role'));
        return $res ? $this->setAutoClose()->success('修改成功') : $this->error('修改失败');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $res = $this->model->findOrFail($id)->delete();
        return $res ? $this->setAutoClose()->success('删除成功') : $this->error('删除失败');
    }
}
