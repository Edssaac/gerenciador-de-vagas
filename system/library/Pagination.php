<?php

namespace Library;

class Pagination
{
    private int $current_page;
    private int $total_items;
    private int $visible_prev_pages = 7;
    private int $visible_next_pages = 1;
    private string $url_base;

    public function __construct(int $current_page, int $total_items, string $url_base)
    {
        $this->current_page = $current_page;
        $this->total_items = $total_items;
        $this->url_base = $this->prepareUrlBase($url_base);
    }

    private function prepareUrlBase(string $url_base): string
    {
        $url_parts = parse_url($url_base);
        $query_params = [];

        if (isset($url_parts['query'])) {
            parse_str($url_parts['query'], $query_params);
            unset($query_params['page']);
        }

        $query_string = http_build_query($query_params);

        $url_base =
            (isset($url_parts['scheme']) ? $url_parts['scheme'] . '://' : '') .
            (isset($url_parts['host']) ? $url_parts['host'] : '') .
            (isset($url_parts['path']) ? $url_parts['path'] : '') .
            ($query_string ? '?' . $query_string : '');

        return $url_base . (strpos($url_base, '?') !== false ? '&' : '?');
    }

    private function createLink(int $page, string $text): string
    {
        $url = $this->url_base . 'page=' . $page;

        return '<li class="page-item' . ($page == $this->current_page ? ' active' : '') . '">' .
            '<a class="page-link" href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '">' . $text . '</a>' .
            '</li>';
    }

    public function generate(): string
    {
        $links = '';

        if (($_ENV['PAGINATION_LIMIT'] * $this->current_page) >= $this->total_items) {
            $this->visible_next_pages = 0;

            if ($this->current_page == 1) {
                return $links;
            }
        }

        if ($this->current_page > 1) {
            $links .= $this->createLink(1, '&laquo;');
        } else {
            $links .= '<li class="page-item disabled"><span class="page-link">&laquo;</span></li>';
        }

        $start = max(1, $this->current_page - $this->visible_prev_pages);
        $end = $this->current_page + $this->visible_next_pages;

        for ($i = $start; $i <= $end; $i++) {
            $links .= $this->createLink($i, (string)$i);
        }

        return
            "<nav>
                <ul class=\"pagination justify-content-center mb-0\">
                    $links
                </ul>
            </nav>";
    }
}
