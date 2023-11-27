<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Searchable;

class Instagram extends Model
{
    use HasFactory;
    use Searchable;

    public function toElasticsearchDocumentArray(): array
    {
        return [
            'posted_at' => $this->posted_at,
            'type' => $this->type,
            'post_content' => $this->post_content,
            'link' => $this->link,
            'poster' => $this->xer,
        ];
    }
}
