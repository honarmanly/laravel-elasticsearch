<?php

use Elastic\Elasticsearch\Client;

trait Searchable
{
   public static function bootSearchable(): void
   {
      if (config('services.search.enabled')) {
         static::observe(ElasticSearchObserver::class);
      }
   }

   public function elasticSearchIndex(Client $elasticSearchClient): void
   {
      $elasticSearchClient->index([
         'index' => $this->getSearchIndex(),
         'type' => '_doc',
         'id' => $this->getSearchId(),
         'body' => $this->toSearchArray(),
      ]);
   }

   public function elasticSearchDelete(Client $elasticSearchClient): void
   {
      $elasticSearchClient->delete([
         'index' => $this->getSearchIndex(),
         'type' => '_doc',
         'id' => $this->getSearchId(),
      ]);
   }

   public function getSearchIndex(): string
   {
      return $this->getTable();
   }

   public function getSearchId(): int
   {
      return $this->getKey();
   }

   public function toSearchArray(): array
   {
      return $this->toArray();
   }

   abstract public function toElasticsearchDocumentArray(): array;
}
