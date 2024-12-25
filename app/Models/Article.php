<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Article extends Model
{
    use HasFactory;

    public static function getDistinctValues($column): array
    {
        $values = Article::select($column)->distinct()->get()->toArray();
        $values = collect($values)->flatten()->toArray();

        $values = Arr::where($values, function ($value) {
            return ! empty($value);
        });

        return array_values($values);
    }
}
