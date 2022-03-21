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
namespace App\Service\Index;

use App\Constants\CodeConstants;
use App\Controller\AbstractController;
use App\Model\Attachment;
use Hyperf\Filesystem\FilesystemFactory;

class FileService extends AbstractController
{
    public function upload($request, FilesystemFactory $factory): array
    {
        $params = $request->file('file');

        if (empty($request->hasFile('file'))) {
            return $this->buildFailed(CodeConstants::FILE_ERROR);
        }

        $filename = md5(file_get_contents($params->getRealPath())) . '.' . pathinfo($params->getClientFilename())['extension'];

        if (empty($factory->get('qiniu')->fileExists($filename))) {
            $factory->get('qiniu')->write($filename, file_get_contents($params->getRealPath()));
        }

        Attachment::query()->create([
            'type' => $request->input('type'),
            'link' => config('file.storage.qiniu.domain') . '/' . $filename,
        ]);

        return $this->buildSuccess([
            'key' => $filename,
            'url' => config('file.storage.qiniu.domain'),
        ]);
    }
}
