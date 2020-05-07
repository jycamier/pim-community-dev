<?php
declare(strict_types=1);

namespace Akeneo\Connectivity\Connection\Application\ErrorManagement\Command;

use Akeneo\Connectivity\Connection\Domain\Common\HourlyInterval;

/**
 * @author    Willy Mesnage <willy.mesnage@akeneo.com>
 * @copyright 2020 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
final class UpdateConnectionErrorCountCommand
{
    /** @var string */
    private $connectionCode;

    /** @var HourlyInterval */
    private $hourlyInterval;

    /** @var int */
    private $errorCount;

    /** @var string */
    private $errorType;

    public function __construct(
        string $connectionCode,
        HourlyInterval $hourlyInterval,
        int $errorCount,
        string $errorType
    ) {
        $this->connectionCode = $connectionCode;
        $this->hourlyInterval = $hourlyInterval;
        $this->errorCount = $errorCount;
        $this->errorType = $errorType;
    }

    public function connectionCode(): string
    {
        return $this->connectionCode;
    }

    public function hourlyInterval(): HourlyInterval
    {
        return $this->hourlyInterval;
    }

    public function errorCount(): int
    {
        return $this->errorCount;
    }

    public function errorType(): string
    {
        return $this->errorType;
    }
}
