<?php

namespace App\Interfaces;

interface QuoteRepositoryInterface 
{
    public function getAllQuote();
    public function getQuoteById($quoteId);
    public function deleteQuote($quoteId);
    public function createQuote(array $quoteDetails);
    public function updateQuote($quoteId, array $newDetails);

}