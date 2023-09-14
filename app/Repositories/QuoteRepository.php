<?php

namespace App\Repositories;

use App\Interfaces\QuoteRepositoryInterface;
use App\Models\Quote;
use Illuminate\Support\Facades\Log;

class QuoteRepository implements QuoteRepositoryInterface
{
  public function getAllQuote()
  {
    return Quote::with('districtMetaData')->get();
  }


  public function createQuote(array $quoteDetails)
  {
    return Quote::create($quoteDetails);
  }

  public function getQuoteById($quoteId)
  {
    return Quote::findOrFail($quoteId);
  }

  public function updateQuote($quoteId, array $newDetails)
  {
    return Quote::whereId($quoteId)->update($newDetails);
  }

  public function deleteQuote($quoteId)
  {
    return Quote::destroy($quoteId);
  }
}
