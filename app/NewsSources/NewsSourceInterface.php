<?php

namespace App\NewsSources;

interface NewsSourceInterface
{
    public function getArticles(): array;
}