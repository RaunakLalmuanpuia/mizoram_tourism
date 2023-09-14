<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CancelledBookingExport implements FromView
{
  private $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function view(): view
  {
    return view('export.cancelled-bookings', [
      'data' => $this->data,
      'total' => 0,
    ]);
  }
}
