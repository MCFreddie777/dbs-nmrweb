<?php


namespace App\Helpers;


class Pagination
{
    public $current_page;
    public $total_pages;
    public $limit;
    public $sort;
    public $offset;

    /**
     * Pagination constructor.
     */
    public function __construct(array $data)
    {
        $this->current_page = $data['current_page'];
        $this->total_pages = $data['total_pages'];
        $this->limit = $data['limit'];
        $this->total_pages = $data['total_pages'];
        $this->sort = $data['sort'];
        $this->offset = $data['offset'];
    }

    public function setTotalPages(int $rows)
    {
        $this->total_pages = (int)($rows / $this->limit);
    }
}
