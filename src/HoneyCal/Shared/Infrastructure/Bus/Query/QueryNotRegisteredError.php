<?php

namespace HoneyCal\Shared\Infrastructure\Bus\Query;

use HoneyCal\Shared\Domain\Bus\Query\Query;
use RuntimeException;

final class QueryNotRegisteredError extends RuntimeException
{
    public function __construct(Query $query)
    {
        $queryClass = $query::class;

        parent::__construct("The query <$queryClass> hasn't a query handler associated");
    }
}
