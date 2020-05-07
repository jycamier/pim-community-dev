<?php
declare(strict_types=1);

namespace Akeneo\Connectivity\Connection\Infrastructure\Persistence\Dbal\Repository;

use Akeneo\Connectivity\Connection\Domain\ErrorManagement\Model\Write\HourlyErrorCount;
use Akeneo\Connectivity\Connection\Domain\ErrorManagement\Persistence\Repository\ErrorCountRepository;
use Doctrine\DBAL\Connection as DbalConnection;
use Doctrine\DBAL\Types\Types;

/**
 * @author    Willy Mesnage <willy.mesnage@akeneo.com>
 * @copyright 2020 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DbalErrorCountRepository implements ErrorCountRepository
{
    /** @var DbalConnection */
    private $dbalConnection;

    public function __construct(DbalConnection $dbalConnection)
    {
        $this->dbalConnection = $dbalConnection;
    }

    public function upsert(HourlyErrorCount $hourlyEventCount): void
    {
        $upsertQuery = <<<SQL
INSERT INTO akeneo_connectivity_connection_audit_error (connection_code, error_datetime, error_count, error_type, updated)
VALUES(:connection_code, :error_datetime, :error_count, :error_type, UTC_TIMESTAMP())
ON DUPLICATE KEY UPDATE error_count = error_count + :error_count, updated = UTC_TIMESTAMP()
SQL;

        $this->dbalConnection->executeUpdate(
            $upsertQuery,
            [
                'connection_code' => (string) $hourlyEventCount->connectionCode(),
                'error_datetime' => $hourlyEventCount->hourlyInterval()->fromDateTime(),
                'error_count' => $hourlyEventCount->errorCount(),
                'error_type' => $hourlyEventCount->errorType(),
            ],
            [
                'error_datetime' => Types::DATETIME_IMMUTABLE,
                'error_count' => Types::INTEGER,
            ]
        );
    }
}
