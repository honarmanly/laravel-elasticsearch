<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Collection;

interface SearchRepository
{
   public function search(string $body, DateTime $date, string $source): Collection;
}
