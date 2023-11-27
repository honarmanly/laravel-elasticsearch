<?php

use App\Models\News;
use App\Models\SearchRepository;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticSearchRepository implements SearchRepository
{
   private $elasticSearch;

   public function __construct(Client $elasticSearch)
   {
      $this->elasticSearch = $elasticSearch;
   }

   public function search(string $body, DateTime $date, string $source): Collection
   {
      // TODO: implement search on elastics
      return collect([]);
   }

   private function searchOnElasticSearch(string $body, DateTime $date, string $source): array
   {
      // TODO: implement search on elastics
      // better to unify the models and use
      $model = new News;

      $items = $this->elasticSearch->search([
         'index' => $model->getSearchIndex(),
         'type' => $model->getSearchKey(),
         'body' => [
            'query' => []
         ]
      ]);

      return $items;
   }
}
