<?php

declare(strict_types=1);
/**
 * This file is part of hyperf-ext/sms.
 *
 * @link     https://github.com/hyperf-ext/sms
 * @contact  eric@zhu.email
 * @license  https://github.com/hyperf-ext/sms/blob/master/LICENSE
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
        //
    }

    /**
     * Build the SMS message.
     */
    public function build(SenderInterface $sender): void
    {
        $this->content('');
    }
}
