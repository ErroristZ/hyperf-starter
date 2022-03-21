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
namespace App\Tools;

use GuzzleHttp\RequestOptions;
use Hyperf\Guzzle\ClientFactory;
use Hyperf\Utils\ApplicationContext;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Throwable;

class ApiGuzzle
{
    /**
     * FunctionName：post
     * Description：
     * Author：zhangkang.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @return mixed
     */
    public static function post(array $data, string $url)
    {
        $factory = ApplicationContext::getContainer()->get(ClientFactory::class);
        $client = $factory->create(['base_uri' => env('GATEWAY'), 'timeout' => 20]);

        try {
            $response = $client->request('POST', $url, [
                RequestOptions::JSON => $data,
                RequestOptions::VERIFY => false,
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
        return '';
    }

    /**
     * FunctionName：get
     * Description：
     * Author：zhangkang.
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @return mixed|string
     */
    public static function get(array $data, string $url)
    {
        $factory = ApplicationContext::getContainer()->get(ClientFactory::class);
        $client = $factory->create(['base_uri' => env('GATEWAY'), 'timeout' => 20]);

        try {
            $response = $client->request('GET', $url, [
                RequestOptions::JSON => $data,
                RequestOptions::VERIFY => false,
                RequestOptions::HEADERS => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            echo $e->getMessage();
        }
        return '';
    }
}
