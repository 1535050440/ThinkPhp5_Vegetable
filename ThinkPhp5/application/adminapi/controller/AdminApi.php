<?php
/**
 * 基类-控制器
 * Created by PhpStorm.
 * User: 14155
 * Date: 2019/6/27
 * Time: 23:22
 */

namespace app\adminapi\controller;


class AdminApi
{
    /**
     * AdminApi constructor.
     */
    public function __construct()
    {
        // 公共响应头
        header('Content-Type: Application/json');

        // 如果需要跨域，写在这里
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: x-token,user-type,Origin, Access-Control-Request-Headers, SERVER_NAME, Access-Control-Allow-Headers, cache-control, token, X-Requested-With, Content-Type, Accept, Connection, User-Agent, Cookie');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');

        if (request()->method() == 'OPTIONS') {
            exit();
        }
    }

    /**
     * 自定义成功返回
     * @param array $data
     * @param int $code
     * @param string $message
     */
    public function success($data=[], $code=200, $message='请求成功！')
    {
        // 构造响应内容
        $result = [
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];

        echo json_encode($result);
        exit;
    }

}
