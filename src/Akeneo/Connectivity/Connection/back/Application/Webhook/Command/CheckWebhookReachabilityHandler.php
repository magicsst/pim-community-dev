<?php
declare(strict_types=1);

namespace Akeneo\Connectivity\Connection\Application\Webhook\Command;

use Akeneo\Connectivity\Connection\Application\Webhook\Service\WebhookReachabilityChecker;
use Akeneo\Connectivity\Connection\Domain\Webhook\DTO\UrlReachabilityStatus;

/**
 * @author    Thomas Galvaing <thomas.galvaing@akeneo.com>
 * @copyright 2020 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
final class CheckWebhookReachabilityHandler
{
    /** @var WebhookReachabilityChecker */
    private $reachabilityChecker;

    public function __construct(WebhookReachabilityChecker $reachabilityChecker)
    {
        $this->reachabilityChecker = $reachabilityChecker;
    }

    /**
     * @param CheckWebhookReachabilityCommand $command
     * @return UrlReachabilityStatus
     */
    public function handle(CheckWebhookReachabilityCommand $command): UrlReachabilityStatus
    {
        return $this->reachabilityChecker->check($command->webhookUrl());
    }
}
