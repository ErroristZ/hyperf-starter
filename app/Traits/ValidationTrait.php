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
namespace App\Traits;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use Psr\Container\ContainerInterface;

trait ValidationTrait
{
    /**
     * @Inject
     */
    protected ContainerInterface $container;

    /**
     * @Inject
     */
    protected RequestInterface $request;

    /**
     * @Inject
     */
    protected ResponseInterface $response;

    /**
     * @Inject
     */
    protected ValidatorFactoryInterface $validationFactory;

    /**
     * 自定义控制器验证器.
     * @param mixed ...$arg
     */
    protected function validate(...$arg): void
    {
        $validator = $this->validationFactory->make(...$arg);
        if ($validator->fails()) {
            throw new BusinessException(ErrorCode::ERR_VALIDATION, $validator->errors()->first());
        }
    }
}
