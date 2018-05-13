<?php
/**
 * File: Auth.php
 * Author: 小滕<616896861@qq.com>
 * Date: 2018/5/13 10:23
 */

namespace App\Foundations\Auth;

use Swoft\Bean\Annotation\Value;
use Swoft\Bean\Annotation\Bean;
use Swoft\Log\Log;

/**
 * @Bean(name="auth.sign")
 */
class AuthSign
{

    /**
     * 密钥
     *
     * @Value(name="${config.administrator.administrator.sign}")
     * @var string
     */
    protected $sign;

    /**
     * 密码
     *
     * @Value(name="${config.administrator.administrator.password}")
     * @var string
     */
    protected $password;

    /**
     * 加密字符串
     *
     * @return string
     */
    public function sign()
    {
        return base64_encode(password_hash($this->getKey(), PASSWORD_BCRYPT));
    }

    /**
     * 验证
     *
     * @param $hashed
     *
     * @return bool
     */
    public function check($hashed)
    {
        return password_verify($this->getKey(), base64_decode($hashed));
    }

    /**
     * @return string
     */
    protected function getKey()
    {
        return $this->sign . $this->password;
    }

}