<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2017/9/27
 * Time: 15:29
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

trait ResJson
{

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var string
     */
    protected $status = 'success';

    /**
     * @var string
     */
    protected $message = '操作成功';

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $jumpUrl = '';

    /**
     * @var bool
     */
    protected $autoClose = false;

    /**
     * @var bool
     */
    protected $reload = true;

    /**
     * @param string $message
     * @param string $jumpUrl
     * @return JsonResponse
     */
    public function success($message = '操作成功', $jumpUrl = '')
    {
        return $this->setStatusCode(200)
                    ->setStatus('success')
                    ->setMessage($message)
                    ->setJumpUrl($jumpUrl)
                    ->respond();
    }

    /**
     * @param string $message
     * @param string $jumpUrl
     * @return JsonResponse
     */
    public function error($message = '操作失败', $jumpUrl = '')
    {
        return $this->setStatus('error')
                    ->setMessage($message)
                    ->setJumpUrl($jumpUrl)
                    ->respond();
    }

    /**
     * 设置响应代码
     *
     * @param int $code
     * @return $this
     */
    public function setStatusCode($code = 200)
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * 设置响应状态
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * 设置消息提示内容
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * 设置参数
     *
     * @param $data
     * @return $this
     */
    public function setParams($data)
    {
//        $this->params = (is_array($data) || is_object($data)) ? $data : func_get_args();
        $this->params = $data;
        return $this;
    }

    /**
     * 设置提示完成后的跳转链接
     *
     * @param $url
     * @return $this
     */
    public function setJumpUrl($url)
    {
        $this->jumpUrl = $url;
        return $this;
    }

    /**
     * 设置自动关闭
     * @param bool $reload
     * @return $this
     */
    public function setAutoClose($reload = true)
    {
        $this->reload = $reload;
        $this->autoClose = true;
        return $this;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    private function respond()
    {
        if (Request::ajax()) {
            return new JsonResponse([
                'message' => $this->message,
                'status' => $this->status,
                'jumpUrl' => $this->jumpUrl,
                'data' => $this->params
            ], $this->statusCode);
        } else {
            return redirect()->route($this->status)->with([
                'message' => $this->message,
                'jumpUrl' => $this->jumpUrl,
                'autoClose' => $this->autoClose,
                'reload' => $this->reload,
                'data' => $this->params
            ])->withInput();
        }
    }
}