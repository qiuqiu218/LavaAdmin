<?php
/**
 * Created by PhpStorm.
 * User: 万鑫
 * Date: 2017/9/27
 * Time: 15:29
 */

namespace App\Http\Controllers\Traits;

use Illuminate\Http\JsonResponse;

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
     * @param string $message
     * @return JsonResponse
     */
    public function success($message = '操作成功')
    {
        return $this->setStatusCode(200)->setStatus('success')->setMessage($message)->respond();
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function error($message = '操作失败')
    {
        return $this->setStatus('error')->setMessage($message)->respond();
    }

    /**
     * @param int $code
     * @return $this
     */
    public function setStatusCode($code = 200)
    {
        $this->statusCode = $code;
        return $this;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
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
     * @param array $data
     * @return JsonResponse
     */
    private function respond()
    {
        return new JsonResponse([
            'message' => $this->message,
            'status' => $this->status,
            'data' => $this->params
        ], $this->statusCode);
    }
}