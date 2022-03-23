<?php

declare(strict_types=1);

class Article
{
    public string $title;
    public ?string $description;
    public ?string $publishDate;
    public int $id;

    public function __construct(string $title, ?string $description, ?string $publishDate, int $id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->id = $id;
    }

    public function formatPublishDate($format = 'DD-MM-YYYY')
    {
        // return the date in the required format
        $actualDate = date('d-m-y', strtotime($this->publishDate));
        return $actualDate;
    }
}