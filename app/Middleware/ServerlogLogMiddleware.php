<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Middleware;

use App\Event\LogsAdd;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Contract\RequestInterface;
use Phper666\JWTAuth\Util\JWTUtil;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * @AutoController
 */
class ServerlogLogMiddleware implements MiddlewareInterface
{
    protected ContainerInterface $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     */
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = $container->get(RequestInterface::class);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $data = [
            'user_id' => JWTUtil::getParserData($this->request)['uid'] ?? 0,
            'user_name' => JWTUtil::getParserData($this->request)['name'] ?? '',
            'url' => $this->request->getRequestUri(),
            'ip' => $this->request->server('remote_addr'),
            'content' => json_encode($this->request->all(), JSON_THROW_ON_ERROR),
        ];

        $this->eventDispatcher->dispatch(new LogsAdd($data));

        return $handler->handle($request);
    }
}
