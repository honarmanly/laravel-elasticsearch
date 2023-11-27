<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Searchable;

class News extends Model
{
    use HasFactory;
    use Searchable;

    public function toElasticsearchDocumentArray(): array
    {
        return [
            'date' => $this->date,
            'title' => $this->title,
            'source' => $this->source,
            'body' => $this->body,
            'link' => $this->link,
        ];
    }
}
