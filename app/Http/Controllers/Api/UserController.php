<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|between:6,20|string'
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->error($validator->errors()->first());
        }

        $http = new Client();

        try {
            $res = $http->post(url('oauth/token'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '2',
                    'client_secret' => 'IK64G83Gpha5a5CD9gHK1LPypnWKwgbCFSJwhfrK',
                    'username' => $request->input('username'),
                    'password' => $request->input('password'),
                    'scope' => '',
                ]
            ]);
            return $this->setParams(json_decode((string)$res->getBody(), true))->success('token获取成功');
        } catch (\Exception $e) {
            if ($e->getCode() === 401) {
                return $this->error('账户或密码错误');
            } else {
                return $this->error('未知错误');
            }
        }

    }
}
