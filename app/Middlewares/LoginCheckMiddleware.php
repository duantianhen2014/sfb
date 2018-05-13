<?php

namespace App\Middlewares;

use App\Foundations\Auth\AuthSign;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;
use Swoft\Bean\Annotation\Inject;
use Swoft\Log\Log;

/**
 * @Bean()
 */
class LoginCheckMiddleware implements MiddlewareInterface
{

    protected $white = [
        'login',
    ];

    /**
     * @Inject(name="auth.sign")
     * @var AuthSign
     */
    protected $authSign;

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \InvalidArgumentException|\Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $isNeedCheck = true;
        $uri = $request->getUri()->getPath();
        foreach ($this->white as $item) {
            if (preg_match('#' . $item . '#', $uri)) {
                $isNeedCheck = false;
                break;
            }
        }

        if ($isNeedCheck) {
            $token = $request->getHeaderLine('AccessToken');
            if (! $this->authSign->check($token)) {
                throw new \Exception('请登录', 401);
            }
        }

        return $handler->handle($request);
    }
}
