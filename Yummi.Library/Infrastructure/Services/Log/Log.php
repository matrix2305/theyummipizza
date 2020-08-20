<?php
declare(strict_types=1);
namespace Yummi\Infrastructure\Services\Log;

use Illuminate\Support\Facades\Log as LaravelLog;
use Yummi\Application\Contracts\ILog;

class Log implements ILog
{
    public function AddLog(string $message): void
    {
        LaravelLog::log($message);
    }
}