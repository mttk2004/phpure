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

    /**
     * Get the total number of pages
     */
    public function totalPages(): int
    {
        return ceil($this->total / $this->perPage);
    }

    /**
     * Get the offset
     */
    public function offset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    /**
     * Build the pagination links
     */
    public function links(int $displayedPages = 5): array
    {
        $links = [];
        $totalPages = $this->totalPages();

        // First page
        $links[] = [
          'page' => 1,
          'url' => $this->buildUrl(1),
          'active' => $this->currentPage === 1,
        ];

        // Middle pages
        $start = max(2, $this->currentPage - floor($displayedPages / 2));
        $end = min($totalPages - 1, $start + $displayedPages - 3);

        for ($i = $start; $i <= $end; $i++) {
            $links[] = [
              'page' => $i,
              'url' => $this->buildUrl($i),
              'active' => $this->currentPage === $i,
            ];
        }

        // Last page
        if ($totalPages > 1) {
            $links[] = [
              'page' => $totalPages,
              'url' => $this->buildUrl($totalPages),
              'active' => $this->currentPage === $totalPages,
            ];
        }

        return $links;
    }

    /**
     * Build the URL
     */
    private function buildUrl(int $page): string
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $query = $_GET;
        $query[$this->pageQueryParam] = $page;

        return $url . '?' . http_build_query($query);
    }
}
