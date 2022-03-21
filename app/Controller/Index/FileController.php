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
namespace App\Controller\Index;

use App\Service\Index\FileService;
use Hyperf\Filesystem\FilesystemFactory;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Contract\RequestInterface;

/**
 * @Controller(prefix="index/file")
 */
class FileController
{
    protected FileService $service;

    protected RequestInterface $request;

    protected FilesystemFactory $factory;

    public function __construct(FileService $service, RequestInterface $request, FilesystemFactory $factory)
    {
        $this->service = $service;
        $this->request = $request;
        $this->factory = $factory;
    }

    /**
     * @PostMapping(path="upload")
     */
    public function upload(): array
    {
        return $this->service->upload($this->request, $this->factory);
    }
}
