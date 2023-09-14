<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\Report;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Lodge;
use App\Models\User;
use App\Models\DistrictTopDestination;
use App\Models\Occupancy;
use App\Models\Pledge;
use PDF;
use App\Models\DistrictMetaData;

class ReportControllerApi extends Controller
{

  private ReportRepositoryInterface $reportRepository;
  public function __construct(ReportRepositoryInterface $reportRepository)
  {
    $this->reportRepository = $reportRepository;
  }

  public function storeReport(Request $request)
  {



    return [
      'data' => $this->reportRepository->storeReport($request->all())
    ];
  }

  public function showReports($id)
  {
    return [
      'data' => $this->reportRepository->showReports($id)
    ];
  }

  public function findReportById($id)
  {

    return [
      'data' => $this->reportRepository->findReportById($id)
    ];
  }

  public function getReportByMonth($date)
  {
    //GET THE MONTH OF THE SELECTED DATE
    $month = date("m", strtotime($date));
    $year = date("Y", strtotime($date));



    //Log::debug(("My selected month ". $month));

  }

  public function getReportInBetween($from, $to)
  {
    $reports = Report::with(['reportDetails', 'user'])->whereBetween('report_month', [$from, $to])->orderBy('created_at', 'desc')->paginate(10);

    return [
      'data' => $reports
    ];
  }

  public function dashboard(Request $request)
  {
    /*

        1. Total Lodge
        2. Total private register
        3. Total Destination enter
        4. Total Pledge
        5. Citizen register

        OLD QUERY
        // $reportSubmitForGivenMonth = Report::with('reportDetails')
        // ->whereYear('report_month',$GivenYear)->whereMonth('report_month',$GivenMonthIndex)->get();

        */

    // abort(500, 'A awm ang lo lulai emai');

    $totalLodge = Lodge::count(); //FRONT A THAWN TUR
    $totalPrivateRegister = User::where('role', 'hotel')->count(); //FRONT A THAWN TUR
    $totalDestination = DistrictTopDestination::count(); //FRONT A THAWN TUR
    $totalPledge = Pledge::count(); //FRONT A THAWN TUR
    $totalCitizenRegister = User::where('role', 'citizen')->count(); //FRONT A THAWN TUR

    //VISITOR DATA
    $GivenMonthIndex = $request->mMonthIndex;
    $GivenMonth = $request->mMonth;
    $GivenYear = $request->mYear;

    //CHECK IF REFRESH OR SEARCH
    if ($request->search != null) {
      //IF FACILITY IS LODGE

      //1. search the lodge ID using the search keyword
      //2. LodgeID mil user zong pivot ah
      //3. User id mil lak report ah

      $lodgeID = Lodge::with('users')->where('name', "like", '%' . $request->facility_name . '%')->first();

      if ($lodgeID) {
        $mUserID = $lodgeID->users[0]->id;

        $reportSubmitForGivenMonth = Report::with('reportDetails')
          ->whereYear('report_month', $GivenYear)->whereMonth('report_month', $GivenMonthIndex)
          ->where('user_id', $mUserID)->get();
      } else {
        //check the user
        $hotelName = User::where('role', 'hotel')->where('name', "like", '%' . $request->facility_name . '%')->first();

        if ($hotelName) {
          //HOTEL FOUND
          $reportSubmitForGivenMonth = Report::with('reportDetails')
            ->whereYear('report_month', $GivenYear)->whereMonth('report_month', $GivenMonthIndex)
            ->where('user_id', $hotelName->id)->get();
        } else {
          //NOT FOUND

        }
      }
      $userId = $lodgeID->users[0]->id;

       $reportSubmitForGivenMonth = Report::with('reportDetails')
       ->whereYear('report_month',$GivenYear)->whereMonth('report_month',$GivenMonthIndex)->get();


    } else {
      $reportSubmitForGivenMonth = Report::with('reportDetails')
        ->whereYear('report_month', $GivenYear)->whereMonth('report_month', $GivenMonthIndex)->get();
    }

    foreach ($reportSubmitForGivenMonth as $mReport) {
      $user = User::with('lodges')->find($mReport->user_id);
      $role = $user->role;
      if ($role == 'lodge') {
        $lodgeName = $user->lodges()?->first()?->name ?? '--';
        $mReport->facility_name = $lodgeName;
      } else {
        $mReport->facility_name = $user->name;
      }
    }

    $reportSubmitForGivenMonthCount = $reportSubmitForGivenMonth->count(); //FRONT A THAWN TUR

    $totalHotelLodgeCount = $totalLodge + $totalPrivateRegister;
    $reportNotSubmitForGivenMonthCount = $totalHotelLodgeCount - $reportSubmitForGivenMonthCount; //FRONT A THAWN TUR


    //CHECK IF REFRESH OR SEARCH
    //OCCUPANCY
    $occupancySubmitForGivenMonth = Occupancy::with(['user', 'occupancyDetails'])
      ->where('year', $GivenYear)->where('month', $GivenMonth)->get();

    foreach ($occupancySubmitForGivenMonth as $mOccupancy) {
      $user = User::with('lodges')->find($mOccupancy->users_id);
      $role = $user->role;
      if ($role == 'lodge') {
        $lodgeName = $user->lodges()?->first()?->name ?? '--';
        $mOccupancy->facility_name = $lodgeName;
      } else {
        $mOccupancy->facility_name = $user->name;
      }
    }
    $occupancySubmitForGivenMonthCount = $occupancySubmitForGivenMonth->count();
    $occupancyNotSubmitForGivenMonthCount = $totalHotelLodgeCount - $occupancySubmitForGivenMonthCount;


    $M_REPORTS = [];
    $M_REPORT;

    $M_REPORT = $this->report($reportSubmitForGivenMonth);
    array_push($M_REPORTS, $M_REPORT);
    $M_OCCUPANCIES = [];
    $M_OCCUPANCY;
    //TESTING


    //OCCUPANCY
    foreach ($occupancySubmitForGivenMonth as $occupancyReport) {
      //Log::debug("HEAD");

      $totalSuite = 0;
      $totalDeluxe = 0;
      $totalDouble = 0;
      $totalSingle = 0;
      $totalDormitory = 0;
      $totalCottage = 0;
      $totalConferenceHall = 0;
      $totalConventionHall = 0;

      foreach ($occupancyReport->occupancyDetails as $details) {


        //CALCULATE THE TOTAL
        if (is_int((int)$details->suite))
          $totalSuite = (int)$details->suite + $totalSuite;
        if (is_int((int)$details->deluxe))
          $totalDeluxe = (int)$details->deluxe + $totalDeluxe;
        if (is_int((int)$details->double))
          $totalDouble = (int)$details->double_room + $totalDouble;
        if (is_int((int)$details->single))
          $totalSingle = (int)$details->single_room + $totalSingle;
        if (is_int((int)$details->dormitory))
          $totalDormitory = (int)$details->dormitory + $totalDormitory;
        if (is_int((int)$details->param1))
          $totalCottage = (int)$details->param1 + $totalCottage;
        if (is_int((int)$details->conference_hall))
          $totalConferenceHall = (int)$details->conference_hall + $totalConferenceHall;
        if (is_int((int)$details->convention_hall))
          $totalConventionHall = (int)$details->convention_hall + $totalConventionHall;
      }

      $M_OCCUPANCY = [
        'totalSuite'    => $totalSuite,
        'totalDelux'    => $totalDeluxe,
        'totalDouble'   => $totalDouble,
        'totalSingle'   => $totalSingle,
        'totalDormitory'        => $totalDormitory,
        'totalCottage'        => $totalCottage, //PARAM1 IS USED FOR COTTAGE

        'totalConferenceHall'   => $totalConferenceHall,
        'totalConventionHall'   => $totalConventionHall,
        'id' => $occupancyReport->id,
        'facility_name'       => $occupancyReport->facility_name,
        'location'      => $occupancyReport->location,

        'district'      => $occupancyReport->district,
        'month'         => $occupancyReport->month,
        'year'          => $occupancyReport->year,
        'total_rooms'   => $occupancyReport->total_rooms,
        'total_beds'    => $occupancyReport->total_beds,
        'total_beds_dormitory'   => $occupancyReport->total_beds_dormitory,
        'any_other_lodging'      => $occupancyReport->any_other_lodging,
      ];

      array_push($M_OCCUPANCIES, $M_OCCUPANCY);
      $M_OCCUPANCY = array();
    }

    $GRAND_TOTAL;
    $GRAND_TOTAL_Suite = 0;
    $GRAND_TOTAL_Deluxe = 0;
    $GRAND_TOTAL_Double = 0;
    $GRAND_TOTAL_Single = 0;
    $GRAND_TOTAL_Dormitory = 0;
    $GRAND_TOTAL_Cottage = 0;

    $GRAND_TOTAL_ConferenceHall = 0;
    $GRAND_TOTAL_ConventionHall = 0;

    foreach ($M_OCCUPANCIES as $m) {
      $GRAND_TOTAL_Suite = $GRAND_TOTAL_Suite + $m['totalSuite'];
      $GRAND_TOTAL_Deluxe = $GRAND_TOTAL_Deluxe + $m['totalDelux'];
      $GRAND_TOTAL_Double = $GRAND_TOTAL_Double + $m['totalDouble'];
      $GRAND_TOTAL_Single = $GRAND_TOTAL_Single + $m['totalSingle'];
      $GRAND_TOTAL_Dormitory = $GRAND_TOTAL_Dormitory + $m['totalDormitory'];
      $GRAND_TOTAL_Cottage = $GRAND_TOTAL_Cottage + $m['totalCottage'];

      $GRAND_TOTAL_ConferenceHall = $GRAND_TOTAL_ConferenceHall + $m['totalConferenceHall'];
      $GRAND_TOTAL_ConventionHall = $GRAND_TOTAL_ConventionHall + $m['totalConventionHall'];
    }
    $GRAND_TOTAL = [
      'GRAND_TOTAL_Suite' => $GRAND_TOTAL_Suite,
      'GRAND_TOTAL_Deluxe' => $GRAND_TOTAL_Deluxe,
      'GRAND_TOTAL_Double' => $GRAND_TOTAL_Double,
      'GRAND_TOTAL_Single' => $GRAND_TOTAL_Single,
      'GRAND_TOTAL_Dormitory' => $GRAND_TOTAL_Dormitory,
      'GRAND_TOTAL_Cottage' => $GRAND_TOTAL_Cottage,

      'GRAND_TOTAL_ConferenceHall' => $GRAND_TOTAL_ConferenceHall,
      'GRAND_TOTAL_ConventionHall' => $GRAND_TOTAL_ConventionHall,
    ];
    $GRAND_TOTALS = [];
    array_push($GRAND_TOTALS, $GRAND_TOTAL);
    //Log::debug($GRAND_TOTAL);


    //END TEST


    return [
      'totalLodge' => $totalLodge,
      'totalPrivateRegister' => $totalPrivateRegister,
      'totalDestination' => $totalDestination,
      'totalPledge' => $totalPledge,
      'totalCitizenRegister' => $totalCitizenRegister,

      'reportSubmitForGivenMonth' => $reportSubmitForGivenMonth,
      'reportSubmitForGivenMonthCount' => $reportSubmitForGivenMonthCount,
      'reportNotSubmitForGivenMonthCount' => $reportNotSubmitForGivenMonthCount,

      'occupancySubmitForGivenMonth' => $occupancySubmitForGivenMonth,
      'occupancySubmitForGivenMonthCount' => $occupancySubmitForGivenMonthCount,
      'occupancyNotSubmitForGivenMonthCount' => $occupancyNotSubmitForGivenMonthCount,
      'occupancyList' => $M_OCCUPANCIES,
      'visitorDataList' => $M_REPORTS,

      'grandTotal' => $GRAND_TOTALS,
    ];
  }




  public function report($reportSubmitForGivenMonth)
  {
    //Log::debug($reportSubmitForGivenMonth);
    //OCCUPANCY

    $totalCheckInLocal = 0;
    $totalCheckInNRI = 0;
    $totalCheckInForeign = 0;
    $totalCheckInDomestic = 0;
    $totalNightSpentLocal = 0;
    $totalNightSpentNRI = 0;
    $totalNightSpentForeign = 0;
    $totalNightSpentDomestic = 0;
    $grandTotalVisitorReport = 0;

    foreach ($reportSubmitForGivenMonth as $visitorReport) {
      //Log::debug("HEAD");
      //CALCULATE THE TOTAL
      if (is_int((int)$visitorReport->check_in_local))
        $totalCheckInLocal = (int)$visitorReport->check_in_local + $totalCheckInLocal;
      if (is_int((int)$visitorReport->check_in_domestic))
        $totalCheckInDomestic = (int)$visitorReport->check_in_domestic + $totalCheckInDomestic;
      if (is_int((int)$visitorReport->check_in_nri))
        $totalCheckInNRI = (int)$visitorReport->check_in_nri + $totalCheckInNRI;
      if (is_int((int)$visitorReport->check_in_foreign))
        $totalCheckInForeign = (int)$visitorReport->check_in_foreign + $totalCheckInForeign;

      if (is_int((int)$visitorReport->night_spent_local))
        $totalNightSpentLocal = (int)$visitorReport->night_spent_local + $totalNightSpentLocal;
      if (is_int((int)$visitorReport->night_spent_domestic))
        $totalNightSpentDomestic = (int)$visitorReport->night_spent_domestic + $totalNightSpentDomestic;
      if (is_int((int)$visitorReport->night_spent_nri))
        $totalNightSpentNRI = (int)$visitorReport->night_spent_nri + $totalNightSpentNRI;
      if (is_int((int)$visitorReport->night_spent_foreign))
        $totalNightSpentForeign = (int)$visitorReport->night_spent_foreign + $totalNightSpentForeign;
    }
    $grandTotalVisitorReport = $totalCheckInLocal + $totalCheckInDomestic + $totalCheckInNRI + $totalCheckInForeign;
    $TOTAL_REPORT = [
      'totalCheckInLocal'    => $totalCheckInLocal,
      'totalCheckInDomestic'    => $totalCheckInDomestic,
      'totalCheckInNRI'   => $totalCheckInNRI,
      'totalCheckInForeign'   => $totalCheckInForeign,

      'totalNightSpentLocal'        => $totalNightSpentLocal,
      'totalNightSpentDomestic'   => $totalNightSpentDomestic,
      'totalNightSpentNRI' => $totalNightSpentNRI,
      'totalNightSpentForeign' => $totalNightSpentForeign,

      'grandTotalVisitorReport' => $grandTotalVisitorReport,

    ];

    return $TOTAL_REPORT;
  }

  public function destroy($id)
  {


    return Report::destroy($id);
  }

  public function getFacilityNameWithUserId($id)
  {
    $facility_name = '';

    $user = User::with('lodges')->find($id);
    $role = $user->role;
    if ($role == 'lodge') {
      $facility_name = $user->lodges[0]->name;
    } else {
      $facility_name = $user->name;
    }
    return $facility_name;
  }

  public function searchFacility(Request $request)
  {
    $request->facility_name;
    $request->month;
    $request->year;
  }

  public function downloadReportPDF($id)
  {

    $report = Report::with('user', 'reportDetails')->find($id);

    //FIND THE FACILITY NAME START
    $user = User::with('lodges')->find($report->user_id);
    $role = $user->role;
    if ($role == 'lodge') {
      $lodgeName = $user->lodges[0]->name;
      $report->facility_name = $lodgeName;
      $report->address = $user->lodges[0]->address;
    } else {
      $report->facility_name = $user->name;
      $report->address = $user->address;
    }
    //FIND THE FACILITY NAME END
    //Date
    $report->date = date('d-M-Y', strtotime($report->report_month));

    $name = $report->facility_name . "_" . $report->report_month . ".pdf";
    $pdf = PDF::loadView('pdf.pdf', compact('report'));
    return $pdf->download($name);
  }
  public function downloadOccupancyPDF($id)
  {

    $occupancy = Occupancy::with('user', 'occupancyDetails')->find($id);

    //FIND THE FACILITY NAME START
    $user = User::with('lodges')->find($occupancy->users_id);
    $role = $user->role;
    if ($role == 'lodge') {
      $lodgeName = $user->lodges[0]->name;
      $occupancy->facility_name = $lodgeName;
    } else {
      $occupancy->facility_name = $user->name;
    }

    //FIND THE FACILITY NAME END
    //FIND DISTRICT
    $mDistrict = DistrictMetaData::find($occupancy->district);
    $occupancy->district_name = $mDistrict->district_name;

    $name = $occupancy->facility_name . "_" . $occupancy->month . "_" . $occupancy->year . ".pdf";

    $pdf = PDF::loadView('pdf.pdf_occupancy', compact('occupancy'));
    return $pdf->download($name);
  }
}
