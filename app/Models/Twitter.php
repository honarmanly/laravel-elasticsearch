<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Searchable;

class Twitter extends Model
{
    use HasFactory;
    use Searchable;

    public function toElasticsearchDocumentArray(): array
    {
        return [
            'posted_at' => $this->posted_at,
            'text' => $this->text,
            'link' => $this->link,
            'xer' => $this->xer,
        ];
    }
}
