<?php
declare(strict_types=1);

namespace spec\Akeneo\Connectivity\Connection\Domain\Audit\Model\Write;

use Akeneo\Connectivity\Connection\Domain\Common\HourlyInterval;
use Akeneo\Connectivity\Connection\Domain\ErrorManagement\ErrorTypes;
use Akeneo\Connectivity\Connection\Domain\ErrorManagement\Model\Write\HourlyErrorCount;
use PhpSpec\ObjectBehavior;

class HourlyErrorCountSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith(
            'magento',
            HourlyInterval::createFromDateTime(
                new \DateTimeImmutable('2020-01-01 10:00:00', new \DateTimeZone('UTC'))
            ),
            329,
            ErrorTypes::BUSINESS
        );
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(HourlyErrorCount::class);
    }

    public function it_returns_the_connection_code(): void
    {
        $this->connectionCode()->shouldBe('magento');
    }

    public function it_returns_the_hourly_interval(): void
    {
        $hourlyInterval = HourlyInterval::createFromDateTime(
            new \DateTimeImmutable('2020-01-01 10:00:00', new \DateTimeZone('UTC'))
        );
        $this->beConstructedWith(
            'magento',
            $hourlyInterval,
            329,
            ErrorTypes::BUSINESS
        );

        $this->hourlyInterval()->shouldBe($hourlyInterval);
    }

    public function it_returns_the_error_count(): void
    {
        $this->errorCount()->shouldBe(329);
    }

    public function it_returns_the_error_type(): void
    {
        $this->errorType()->shouldBe(ErrorTypes::BUSINESS);
    }
}
