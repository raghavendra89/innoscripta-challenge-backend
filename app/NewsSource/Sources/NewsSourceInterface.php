<?php

namespace App\NewsSource\Sources;

interface NewsSourceInterface
{
    public function getArticles(): array;
}