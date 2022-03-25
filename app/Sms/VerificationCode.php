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
namespace App\Sms;

use HyperfExt\Contract\ShouldQueue;
use HyperfExt\Sms\Contracts\SenderInterface;
use HyperfExt\Sms\Smsable;

class VerificationCode extends Smsable implements ShouldQueue
{
    /**
     * Create a new SMS message instance.
     */
    public function __construct()
    {
    }

    /**
     * Build the SMS message.
     */
    public function build(SenderInterface $sender): void
    {
        $this->content('');
    }
}
