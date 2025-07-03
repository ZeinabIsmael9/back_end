<?php

namespace Illuminates\Pagination;

use Illuminates\Database\Queires\Collection;
use IteratorAggregate;

class Paginator implements IteratorAggregate
{
    protected int $totalPages;

    public function __construct(protected ?Collection $data, protected int $total, protected int $currentpage, protected int $perPage)
    {
        $this->totalPages = (int) ceil($this->total / $this->perPage);
    }

    public function getIterator(): \Traversable
    {
        return $this->data ?? new Collection([]);
    }
    public function getData(): Collection
    {
        return $this->data ?? new Collection([]);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getCurrentPage(): int
    {
        return $this->currentpage;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function hasNextPage(): bool
    {
        return $this->currentpage < $this->totalPages;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentpage > 1;
    }

    public function previousPage()
    {
        return $this->currentpage - 1;
    }

    public function lastPage(): int
    {
        return $this->totalPages;
    }

    public function firstPage(): int
    {
        return 1;
    }

public function render(): string
    {
        $currentPage = $this->getCurrentPage();
        $totalPages = $this->totalPages;
        $paginateHtml = '<nav area-label="Page Naviagation">';
        $paginateHtml .= '<ul class="pagination">';
        if ($this->hasPreviousPage()) {
            $prev = $currentPage - 1;
            $first = url('?page=' . 1);
            $paginateHtml .= '<li class="page-item"><a href="' . $first . '" class="page-link">First</a></li>';
            $paginateHtml .= '<li class="page-item"><a href="' . url('?page=' . $prev) . '" class="page-link">Previous</a></li>';
        }

        for ($i = 1; $i <= $totalPages; $i++) {
            $url = url('?page=' . $i);
            $activeClass = $currentPage == $i ? 'active' : '';
            $paginateHtml .= '<li class="page-item"><a class="page-link ' . $activeClass . '" href="' . $url . '">' . $i . '</a></li>';
        }

        if ($this->hasNextPage()) {
            $next = $currentPage + 1;
            $last = url('?page=' . $totalPages);
            $paginateHtml .= '<li class="page-item"><a href="' . $last . '" class="page-link">Last</a></li>';
            $paginateHtml .= '<li class="page-item"><a href="' . url('?page=' . $next) . '" class="page-link">Next</a></li>';
        }

        $paginateHtml .= '</ul>';
        $paginateHtml .= '</nav>';
        return $paginateHtml;
    }
}
