<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;

class CountryRepository extends EloquentRepository
{
    public function model()
   {
       return \App\Country::class;
   }
}
