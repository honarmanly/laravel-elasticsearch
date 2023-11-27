<?php

use App\Models\Instagram;
use App\Models\News;
use App\Models\SearchRepository;
use App\Models\Twitter;
use Illuminate\Database\Eloquent\Collection;

class EloquentSearchRepository implements SearchRepository
{
   public function search(string $body, DateTime $date, string $source): Collection
   {
      $news = News::query()->where(fn ($query) => (
         $query->where('body', 'LIKE', "%{$body}%")
         ->orWhere('title', 'LIKE', "%{$body}%")
         ->orWhere('date', '=', $date)
         ->orWhere('source', '=', $source)
      ))->get();

      $tweets = Twitter::query()->where(fn ($query) => (
         $query->where('xer', 'LIKE', "%{$source}%")
         ->orWhere('text', 'LIKE', $body)
         ->orWhere('posted_at', '=', $date)
      ))->get();

      $instagram = Instagram::query()->where(fn ($query) => (
         $query->where('post_content', 'LIKE', "%{$body}%")
         ->orWhere('poster', '=', $source)
         ->orWhere('posted_at', '=', $date)
      ))->get();

      $searchResult = collect([]);
      $news->map(function (News $news) use ($searchResult) {
         $searchResult->push([
            'creator' => $news->source,
            'date' => $news->date,
            'link' => $news->link,
            'body' => $news->body,
            'title' => $news->title
         ]);
      });

      $instagram->map(function (Instagram $instagram) use ($searchResult) {
         $searchResult->push([
            'creator' => $instagram->poster,
            'date' => $instagram->posted_at,
            'link' => $instagram->link,
            'body' => $instagram->post_content,
            'title' => null
         ]);
      });

      $tweets->map(function (Twitter $tweet) use ($searchResult) {
         $searchResult->push([
            'creator' => $tweet->poster,
            'date' => $tweet->posted_at,
            'link' => $tweet->link,
            'body' => $tweet->post_content,
            'title' => null
         ]);
      });

      return $searchResult;
   }
}
