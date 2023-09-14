<?php

namespace App\Http\Controllers\Api;

use App\Exports\CancelledBookingExport;
use App\Exports\LodgeStatement;
use App\Interfaces\UserBookingRepositoryInterface;

use App\Models\UserBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BookedDates;
use App\Models\Guest;
use App\Models\Lodge;
use App\Models\LodgeRoomData;
use App\Models\LodgeRoomType;
use App\Models\User;
use App\Models\Payment;
use App\Models\UserLodge;
use PDF;
use DateTime;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Log;
use Throwable;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;

class UserBookingControllerApi extends Controller
{

  private UserBookingRepositoryInterface $userBookingRepository;
  public function __construct(UserBookingRepositoryInterface $userBookingRepository)
  {
    $this->userBookingRepository = $userBookingRepository;
  }

  public function index()
  {
    return [
      'data' => $this->userBookingRepository->getAllUserBooking()
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    try {
      $orderId = 'MZTOUR' . now()->timestamp;
      $request->merge(['order_id' => $orderId]);
      $booking = $this->userBookingRepository->createUserBooking($request->all());

      $period = CarbonPeriod::create($booking->check_in, date('Y-m-d', strtotime('-1 day', strtotime($booking->check_out))));

      foreach ($period as $date) {
        $bookedDate = new BookedDates;
        $bookedDate->user_booking_id = $booking->id;
        $bookedDate->lodge_room_data_id = $booking->lodge_room_data_id;
        $bookedDate->booked = $date->format('Y-m-d');
        $bookedDate->save();
      }
      return [
        'data' => true
      ];
    } catch (Throwable $ex) {
      Log::info($ex);
      return [
        'data' => false
      ];
    }
  }

  public function show(UserBooking $booking)
  {
    return $this->userBookingRepository->getUserBookingById($booking->id);
  }

  public function edit(UserBooking $booking)
  {
  }

  public function update(Request $request, UserBooking $booking)
  {
    return $this->userBookingRepository->updateUserBooking($booking->id, $request->all());
  }

  public function destroy($booking)
  {
    return $this->userBookingRepository->deleteUserBooking($booking);
  }

  public function checkOut($id)
  {
    return $this->userBookingRepository->checkOut($id);
  }

  public function guestList($id)
  {
    $guests = Guest::where('booking_id', $id)->get();

    return [
      'data' => $guests
    ];
  }

  public function getBookingAccordingToRole($id)
  {
    $user = User::with('lodges')->find($id);

    if ($user['role'] == 'admin') {
      return [
        'data' => UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
          ->where('status', 'Confirmed')->orderBy('created_at', 'DESC')->paginate(10)
      ];
    } else {

      //1. GET THE LODGE ASSOCIATE WITH THE USER
      if (count($user->lodges) != 0) {
        $lodgeID = $user->lodges[0]->id;

        //2. GET THE ROOM_DATA ASSOCIATE WITH THE LODGE
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');

        //3. FILTER THOSE ROOM_DATA IN USER_BOOKING
        $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
          ->where('status', 'Confirmed')->whereIn('lodge_room_data_id', $mLodgeRoomData)->orderBy('created_at', 'DESC')->paginate(10);
      } else {
        return ['data' => false];
      }
      return [
        'data' => $userBooking
      ];
    }
  }


  public function getBookingAccordingToRoleAll($id)
  {
    $user = User::with('lodges')->find($id);

    if ($user['role'] == 'admin') {
      return [
        'data' => UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
          ->paginate(10)
      ];
    } else {

      //1. GET THE LODGE ASSOCIATE WITH THE USER
      if (count($user->lodges) != 0) {
        $lodgeID = $user->lodges[0]->id;

        //2. GET THE ROOM_DATA ASSOCIATE WITH THE LODGE
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');

        //3. FILTER THOSE ROOM_DATA IN USER_BOOKING
        $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
          ->whereIn('lodge_room_data_id', $mLodgeRoomData)->paginate(10);
      } else {
        return ['data' => false];
      }

      return [
        'data' => $userBooking
      ];
    }
  }
  public function bookingStatusCheck($value, $id)
  {

    if ($value == "In") {
      $user = User::find($id);
      if ($user['role'] == 'admin') {
        return [
          'data' => UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
            ->where('param1', 'In')->where('status', 'Confirmed')->paginate(10)
        ];
      } else {
        $lodgeID = $user->lodges[0]->id;
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');
        $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
          ->whereIn('lodge_room_data_id', $mLodgeRoomData)->where('param1', 'In')->where('status', 'Confirmed')->paginate(10);
        return [
          'data' => $userBooking
        ];
      }
    } elseif ($value == "Out") {
      $user = User::find($id);
      if ($user['role'] == 'admin') {
        return [
          'data' => UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
            ->where('param1', "Out")->where('status', 'Confirmed')->paginate(10) //"param1" IS USED FOR CHECKIN
        ];
      } else {
        $lodgeID = $user->lodges[0]->id;
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');
        $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
          ->whereIn('lodge_room_data_id', $mLodgeRoomData)->where('param1', "Out")->where('status', 'Confirmed')->paginate(10);
        return [
          'data' => $userBooking
        ];
      }
    } elseif ($value == "Booked") {
      $user = User::find($id);
      if ($user['role'] == 'admin') {
        return [
          'data' => UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
            ->where('param1', "Booked")->where('status', 'Confirmed')->paginate(10)
        ];
      } else {
        $lodgeID = $user->lodges[0]->id;
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');
        $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
          ->whereIn('lodge_room_data_id', $mLodgeRoomData)->where('param1', "Booked")->where('status', 'Confirmed')->paginate(10);
        return [
          'data' => $userBooking
        ];
      }
    }
  }

  public function testStatusCheck($value_one, $value_two, $id)
  {
    // value_one:
    // 1=all 2=checkin 3=checkout 4=null

    $mColumnOne = '';
    $mColumnTwo = '';

    switch ($value_one) {
      case 1:
        $mColumnOne   = true;
        break;  //CHECKIIN
      case 2:
        $mColumnOne   = false;
        break;  //CHECKOUT
      case 3:
        $mColumnOne   = null;
        break;  //NULL
      case 4:
        $mColumnOne   = "all";
        break;  //ALL
    }
    switch ($value_two) {
      case 1:
        $mColumnTwo  = "Confirmed";
        break; //SUCCESS = "Confirmed"
      case 2:
        $mColumnTwo   = "Payment Failed";
        break; //FAILURE = "Payment Failed"
      case 3:
        $mColumnTwo   = 1;
        break; //INIT = 1
      case 4:
        $mColumnTwo   = "all";
        break; //ALL
    }

    $relatedTableArr = ['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'];

    $user = User::find($id);

    if ($value_one == 'all') {
      if ($user['role'] == 'admin') {
        return [
          'data' => UserBooking::with($relatedTableArr)->get()
        ];
      } else {
        $lodgeID = $user->lodges[0]->id;
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');
        $userBooking = UserBooking::with($relatedTableArr)->whereIn('lodge_room_data_id', $mLodgeRoomData)->get();

        return [
          'data' => $userBooking
        ];
      }
    } else {

      if ($user['role'] == 'admin') {
        return [
          'data' => UserBooking::with($relatedTableArr)
            ->where('checked_in', $mColumnOne)->where('status', $mColumnTwo)->get()
        ];
      } else {
        $lodgeID = $user->lodges[0]->id;
        $mLodgeRoomData = LodgeRoomData::where('lodges_id', $lodgeID)->pluck('id');
        $userBooking = UserBooking::with($relatedTableArr)
          ->whereIn('lodge_room_data_id', $mLodgeRoomData)->where('checked_in', $mColumnOne)->where('status', $mColumnTwo)->get();

        return [
          'data' => $userBooking
        ];
      }
    }
  }

  public function testFilter($value1, $value2, $id)
  {
  }

  public function roomAssign($id, $roomNumber)
  {
    $myBooking =  UserBooking::find($id);
    $myBooking->param2 = $roomNumber;
    $myBooking->save();
    return $myBooking;
  }

  public function searchForBooking(Request $request)
  {
    $key = json_decode($request->key, true);
    $user = User::findOrFail($request->userId);
    switch ($user->role) {
      case 'admin':
        switch ($request->type) {
          case 'order_id':
          case 'check_in':
            $userBooking = UserBooking::where($request->type, 'LIKE', '%' . $request->key . '%')
              ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->where('status', 'Confirmed')->orderBy('created_at', 'DESC')
              ->paginate(10);
            break;

          case 'guest':
            $guests = Guest::where('first_name', 'LIKE', '%' . $request->key . '%')->orWhere('last_name', '%' . $request->key . '%')->pluck('booking_id');

            $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->where('status', 'Confirmed')
              ->whereIn('id', $guests)
              ->orderBy('created_at', 'DESC')
              ->paginate(10);
            break;

          case 'date_range':
            $period = CarbonPeriod::create($key['dateRangeFrom'], date('Y-m-d', strtotime('-1 day', strtotime($key['dateRangeTo']))));
            $dates = [];

            foreach ($period as $date) {
              array_push($dates, $date->format('Y-m-d'));
            }

            $bookedDates = BookedDates::whereIn('booked', $dates)
              ->get()
              ->pluck('user_booking_id');
            $userBooking = UserBooking::whereIn('id', $bookedDates->unique())
              ->where('status', 'Confirmed')
              ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->orderBy('created_at', 'DESC')->paginate(10);
            break;

          default:
            $user = User::where($request->type, 'LIKE', '%' . $request->key . '%')->get()->pluck('id');
            $userBooking = UserBooking::whereIn('users_id', $user)->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->where('status', 'Confirmed')->orderBy('created_at', 'DESC')->paginate(10);
            break;
        }
        break;
      default:
        $userLodges = UserLodge::where('users_id', $request->userId)->get()->pluck('lodges_id');
        $lodgeRooms = LodgeRoomData::whereIn('lodges_id', $userLodges)->get()->pluck('id');
        switch ($request->type) {
          case 'order_id':
          case 'check_in':
            $userBooking = UserBooking::where($request->type, 'LIKE', '%' . $request->key . '%')->whereIn('lodge_room_data_id', $lodgeRooms)->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->where('status', 'Confirmed')->orderBy('created_at', 'DESC')->paginate(10);
            break;

          case 'guest':
            $guests = Guest::where('first_name', 'LIKE', '%' . $request->key . '%')->orWhere('last_name', '%' . $request->key . '%')->pluck('booking_id');
            $userBooking = UserBooking::whereIn('lodge_room_data_id', $lodgeRooms)
              ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->whereIn('id', $guests)
              ->where('status', 'Confirmed')
              ->orderBy('created_at', 'DESC')->paginate(10);
            break;

          case 'date_range':
            $period = CarbonPeriod::create($key['dateRangeFrom'], date('Y-m-d', strtotime('-1 day', strtotime($key['dateRangeTo']))));
            $dates = [];

            foreach ($period as $date) {
              array_push($dates, $date->format('Y-m-d'));
            }

            $bookedDates = BookedDates::whereIn('booked', $dates)
              ->get()
              ->pluck('user_booking_id');
            $userBooking = UserBooking::whereIn('id', $bookedDates->unique())
              ->whereIn('lodge_room_data_id', $lodgeRooms)
              ->where('status', 'Confirmed')
              ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->orderBy('created_at', 'DESC')->paginate(10);
            break;

          default:
            $user = User::where($request->type, 'LIKE', '%' . $request->key . '%')->get()->pluck('id');
            $userBooking = UserBooking::whereIn('users_id', $user)->whereIn('lodge_room_data_id', $lodgeRooms)->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])
              ->where('status', 'Confirmed')->orderBy('created_at', 'DESC')->paginate(10);
            break;
        }
        break;
    }
    return $userBooking;
  }

  public function downloadReceiptPdf($bookingId)
  {
    $userBooking = UserBooking::with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes'])->find($bookingId);

    $date1 = new DateTime($userBooking->check_in);
    $date2 = new DateTime($userBooking->check_out);
    $interval = $date1->diff($date2);
    $days = $interval->format('%a');
    if ($userBooking->order_id == null) {

      $priceToPay = (int) $days * (int)$userBooking->lodgeRoomData->price *
        (int)$userBooking->number_of_room_require * ((int)$userBooking->param3 + 1); //PARAM3 REPRESENTS THE NUMBER OF GUEST
      $userBooking->price = $priceToPay;
      $userBooking->days = $days;
    } else {
      $mPayment = Payment::where('orderId', $userBooking->order_id)->first();
      $userBooking->price = $mPayment->amount;
      $userBooking->days = $days;
    }

    $pdf  = PDF::loadView('pdf.receipt_pdf', compact('userBooking'));
    return $pdf->download("cc");
  }

  public function paymentDetails($bookingId)
  {
    $mBooking = UserBooking::find($bookingId);
    $orderId = $mBooking->order_id;

    if ($mBooking->order_id == null) {
      $mPayment = null;
    } else {
      $mPayment = Payment::where('orderId', $orderId)->first();
    }

    return [
      'data' => $mPayment,
      'orderId' => $orderId,
    ];
  }

  public function searchForCancelledBookings(Request $request)
{
    $dateString = '1-' . $request->month . '-' . $request->year;
    $month = Date('m', strtotime($dateString));
    $year = Date('Y', strtotime($dateString));  

    $lodgeRooms = LodgeRoomData::where('lodges_id', $request->lodge_id)->get()->pluck('id');
    
    switch ($request->type) {
        case 'order_id':
        case 'check_in':
            $bookings = UserBooking::where($request->type, 'LIKE', '%' . $request->key . '%')
                ->whereMonth('cancelled_at', $month)
                ->whereYear('cancelled_at', $year)
                ->whereIn('lodge_room_data_id', $lodgeRooms)
                ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
                ->where('status', 'Cancelled')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            break;

        case 'guest':
            $guests = Guest::where('first_name', 'LIKE', '%' . $request->key . '%')->orWhere('last_name', '%' . $request->key . '%')->pluck('booking_id');
            $bookings = UserBooking::whereIn('lodge_room_data_id', $lodgeRooms)
                ->whereMonth('cancelled_at', $month)
                ->whereYear('cancelled_at', $year)
                ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
                ->whereIn('id', $guests)
                ->where('status', 'Cancelled')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            break;

        case 'name':
        case 'phone':
            $user = User::where($request->type, 'LIKE', '%' . $request->key . '%')->get()->pluck('id');
            $bookings = UserBooking::whereIn('users_id', $user)
                ->whereMonth('cancelled_at', $month)
                ->whereYear('cancelled_at', $year)
                ->whereIn('lodge_room_data_id', $lodgeRooms)
                ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
                ->where('status', 'Cancelled')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            break;

        case 'date':
            // Parse the date in 'dd/mm/yyyy' format and convert it to 'yyyy-mm-dd' for comparison
            $date = \Carbon\Carbon::createFromFormat('d/m/Y', $request->key)->format('Y-m-d');
            $bookings = UserBooking::whereDate('cancelled_at', $date)
                ->whereMonth('cancelled_at', $month)
                ->whereYear('cancelled_at', $year)
                ->whereIn('lodge_room_data_id', $lodgeRooms)
                ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
                ->where('status', 'Cancelled')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
            break;

        default:
            $lodgeRooms = LodgeRoomData::where('lodges_id', $request->lodge_id)->get()->pluck('id');
            $bookings = UserBooking::whereIn('lodge_room_data_id', $lodgeRooms)
                ->whereMonth('cancelled_at', $month)
                ->whereYear('cancelled_at', $year)
                ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
                ->where('status', 'Cancelled')
                ->with(['lodgeRoomData', 'users'])
                ->paginate(10);
            break;
    }

    return $bookings;
}


  public function getUserReceipt(Request $request)
  {
    //request changes

    $uri = $request->getUri();
    $temp = explode("?", $uri);
    $order_id = last($temp);
    $order_id = substr($order_id, 0, -1);
    $data = UserBooking::where('order_id', $order_id)->first()->toArray();

    $lodgeRoom = LodgeRoomData::where('id', $data['lodge_room_data_id'])->first()->toArray();
    $lodgeRoomType = LodgeRoomType::where('id', $lodgeRoom['lodge_room_types_id'])->first()->toArray();
    $lodge = Lodge::where('id', $lodgeRoom['lodges_id'])->with('districtMetaData')->first()->toArray();
    $guests = Guest::where('booking_id', $data['id'])->get();
    $date1 = new DateTime($data['check_in']);
    $date2 = new DateTime($data['check_out']);
    $interval = $date1->diff($date2);
    $noOfNights = (int) $interval->format('%a');
    $pdf = PDF::loadView('pdf.user-invoice', compact('data', 'lodgeRoom', 'lodge', 'lodgeRoomType', 'guests', 'noOfNights'));
    return $pdf->stream('pdf_file.pdf');
  }

  public function checkTransaction(Request $request)
  {
    $client = new Client();
    $response = $client->request('POST', 'https://paymentgw.mizoram.gov.in/api/status', [
      'form_params' => [
        'order_id' => $request->orderId,
      ]
    ]);
    $response = json_decode($response->getBody());
    return response()->json(['response' => $response]);
  }

  public function downloadStatement(Request $request)
  {
    $dateString = '1-' . $request->month . '-' . $request->year;
    $month = Date('m', strtotime($dateString));
    $year = Date('Y', strtotime($dateString));

    $lodgeRooms = LodgeRoomData::where('lodges_id', $request->lodge_id)->get()->pluck('id');
    $lodge = Lodge::findOrFail($request->lodge_id);
    $userBookings = UserBooking::whereIn('lodge_room_data_id', $lodgeRooms)->pluck('order_id');
    $payments = Payment::whereIn('orderId', $userBookings)->whereMonth('created_at', $month)->whereYear('created_at', $year)->with('userBooking')->get()->groupBy('orderId');
    return Excel::download(new LodgeStatement($payments), $dateString . $lodge->name . '.xlsx');
  }

  public function downloadCancelledBookings(Request $request)
  {
    $dateString = '1-' . $request->month . '-' . $request->year;
    $monthYear = $request->month . '-' . $request->year;
    $month = Date('m', strtotime($dateString));
    $year = Date('Y', strtotime($dateString));

    $lodgeRooms = LodgeRoomData::where('lodges_id', $request->lodge_id)->get()->pluck('id');
    $lodge = Lodge::findOrFail($request->lodge_id);
    $bookings = UserBooking::whereIn('lodge_room_data_id', $lodgeRooms)
      ->whereMonth('cancelled_at', $month)
      ->whereYear('cancelled_at', $year)
      ->with(['users', 'lodgeRoomData', 'lodgeRoomData.lodges', 'lodgeRoomData.districtMetaData', 'lodgeRoomData.lodgeRoomTypes', 'payment'])
      ->where('status', 'Cancelled')->with(['lodgeRoomData', 'users'])->get();
    return Excel::download(new CancelledBookingExport($bookings), $monthYear . $lodge->name . '_cancelled_bookings.xlsx');
  }

  public function restoreCancelledBooking($id)
  {
    $userBooking = UserBooking::findOrFail($id);
    $userBooking->status = 'Confirmed';
    $userBooking->save();
    return $userBooking;
  }
}
