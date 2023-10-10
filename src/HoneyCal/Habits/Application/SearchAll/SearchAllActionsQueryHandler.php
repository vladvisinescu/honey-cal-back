<?php

namespace HoneyCal\Habits\Application\SearchAll;

use HoneyCal\Habits\Application\ActionsResponse;
use HoneyCal\Shared\Domain\Bus\Query\QueryHandler;

final class SearchAllActionsQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly SearchAllActionsRetriever $retriever
    ) {}

    public function __invoke(SearchAllActionsQuery $query): ActionsResponse
    {
        return $this->retriever->searchAll();
    }
}
