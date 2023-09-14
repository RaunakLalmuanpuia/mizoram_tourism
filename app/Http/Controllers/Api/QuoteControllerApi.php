<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\QuoteRepositoryInterface;

use App\Models\Quote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuoteControllerApi extends Controller
{
    private QuoteRepositoryInterface $quoteRepository;
    public function __construct(QuoteRepositoryInterface $quoteRepository)
    {
        $this->quoteRepository = $quoteRepository;
    }

    public function index()
    {
        return [
            'data'=> $this->quoteRepository->getAllQuote()
        ];   
    }

    public function create()   {  }

    public function store(Request $request)
    {
       return [
        'data' => $this->quoteRepository->createQuote($request->all())
    ];
    }

    public function show(Quote $quote)
    {
        return $this->quoteRepository->getQuoteById($quote->id);
    }

    public function edit(Quote $quote){}

    public function update(Request $request, Quote $quote)
    {
        return $this->quoteRepository->updateQuote($quote->id, $request->all());
    }

    public function destroy(Quote $quote)
    {
        return $this->quoteRepository->deleteQuote($quote->id);
    }
}
