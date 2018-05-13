<?php
/**
 * File: AuthController.php
 * Author: 小滕<616896861@qq.com>
 * Date: 2018/5/13 10:17
 */

namespace App\Controllers\Backend;

use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Response;
use Exception;
use Swoft\Bean\Annotation\Value;
use Swoft\Bean\Annotation\Inject;

/**
 * @Controller(prefix="/backend/auth")
 */
class AuthController
{

    /**
     * 用户名
     *
     * @Value(name="${config.administrator.administrator.username}")
     * @var string
     */
    protected $username;

    /**
     * 密码
     *
     * @Value(name="${config.administrator.administrator.password}")
     * @var string
     */
    protected $password;

    /**
     * @Inject(name="auth.sign")
     * @var \App\Foundations\Auth\AuthSign
     */
    protected $authSign;

    /**
     * @RequestMapping(route="/backend/auth/login", method={RequestMethod::POST})
     */
    public function login(Request $request, Response $response)
    {
        $username = $request->input('username', '');
        $password = $request->input('password', '');
        if (! $username || ! $password) {
            throw new Exception('请输入用户名或密码');
        }

        if (
            $username !== $this->username ||
            $password !== $this->password
        ) {
            throw new Exception('用户名或密码不正确');
        }

        return $response->json([
            'msg' => '登录成功',
            'token' => $this->authSign->sign(),
            'code' => 200,
        ]);
    }

}