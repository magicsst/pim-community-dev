<?php
declare(strict_types=1);

namespace Akeneo\Connectivity\Connection\Domain\Webhook\DTO;

/**
 * @author    Thomas Galvaing <thomas.galvaing@akeneo.com>
 * @copyright 2020 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class UrlReachabilityStatus
{
    /** @var bool */
    private $success;

    /** @var string */
    private $message;

    public function __construct(bool $success, string $message)
    {
        $this->success = $success;
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function success(): bool
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * @return array{success:bool, message:string}
     */
    public function normalize(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
        ];
    }
}
