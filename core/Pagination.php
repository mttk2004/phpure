<?php

namespace Core;

class Pagination
{
    private int $total;
    private int $perPage;
    private int $currentPage;
    private string $pageQueryParam;

    public function __construct(int $total, int $perPage = 10, int $currentPage = 1, string $pageQueryParam = 'page')
    {
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->pageQueryParam = $pageQueryParam;
    }

    public function totalPages(): int
    {
        return ceil($this->total / $this->perPage);
    }

    public function offset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public function links(int $displayedPages = 5): array
    {
        $links = [];
        $totalPages = $this->totalPages();

        // Trang đầu
        $links[] = [
            'page' => 1,
            'url' => $this->buildUrl(1),
            'active' => $this->currentPage === 1,
        ];

        // Các trang ở giữa
        $start = max(2, $this->currentPage - floor($displayedPages / 2));
        $end = min($totalPages - 1, $start + $displayedPages - 3);

        for ($i = $start; $i <= $end; $i++) {
            $links[] = [
                'page' => $i,
                'url' => $this->buildUrl($i),
                'active' => $this->currentPage === $i,
            ];
        }

        // Trang cuối
        if ($totalPages > 1) {
            $links[] = [
                'page' => $totalPages,
                'url' => $this->buildUrl($totalPages),
                'active' => $this->currentPage === $totalPages,
            ];
        }

        return $links;
    }

    private function buildUrl(int $page): string
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $query = $_GET;
        $query[$this->pageQueryParam] = $page;

        return $url . '?' . http_build_query($query);
    }
}
