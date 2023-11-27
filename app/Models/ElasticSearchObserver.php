<?php

namespace App\Models;

use Elastic\Elasticsearch\Client;

class ElasticSearchObserver
{
   public function __construct(private Client $elasticSearchClient)
   {
   }

   public function saved($model)
   {
      $model->elasticSearchIndex($this->elasticSearchClient);
   }

   public function deleted($model)
   {
      $model->elasticSearchDelete($this->elasticSearchClient);
   }
}
