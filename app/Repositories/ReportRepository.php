<?php

namespace App\Repositories;

use App\Interfaces\ReportRepositoryInterface;
use App\Models\ReportDetail;

use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Report;

class ReportRepository implements ReportRepositoryInterface
{
    public function storeReport($reports){

        //Log::info($reports['detailedReports'][0]['category']);

        $report = new Report();

        $report->user_id= $reports['visitorData']['user_id'];
        //$report->lodges_id= $reports['visitorData']['lodges_id'];

        $report->check_in_local = $reports['visitorData']['checkedInLocal'];
        $report->check_in_domestic = $reports['visitorData']['checkedInDomestic'];
        $report->check_in_nri = $reports['visitorData']['checkedInNri'];
        $report->check_in_foreign = $reports['visitorData']['checkedInForeign'];
        $report->night_spent_local = $reports['visitorData']['nightSpentLocal'];
        $report->night_spent_domestic = $reports['visitorData']['nightSpentDomestic'];
        $report->night_spent_nri = $reports['visitorData']['nightSpentNri'];
        $report->night_spent_foreign = $reports['visitorData']['nightSpentForeign'];
        $report->report_month = $reports['visitorData']['report_month'];

        $report->save();

        foreach($reports['detailedReports'] as $detailReport){
            $reportDetail = new ReportDetail();
            $reportDetail->category = $detailReport['category'];
            $reportDetail->residence = $detailReport['residence'];
            $reportDetail->number_of_guest = $detailReport['numberOfGuest'];
            $reportDetail->number_of_nights_spent = $detailReport['numberOfNightsSpent'];
            $reportDetail->leisure = $detailReport['mLeisures'];
            $reportDetail->non_leisure = $detailReport['mNonLeisures'];

            $reportDetail->reports_id = $report->id;
            $reportDetail->save();

        }
    }

    public function showReports($id){
        // $user = User::with('lodges')->find($id);
        $user = User::find($id);

         //IF ADMIN
         //GET ALL
        if($user['role']=='admin'){
            $reports = Report::with(['reportDetails','user'])->orderBy('created_at', 'desc')->paginate(10);
            // foreach($reports as $r){
                // $mUser = User::with('lodges')->find($r->user_id);
                // $mUser = User::find($r->user_id);
                // $r->facility_name = $mUser->name;
            // }

            return $reports;

        }elseif($user['role']=='lodge'){
        //IF LODGE OR HOTEL
            $reports = Report::with(['reportDetails','user'])->where('user_id',$user['id'])->orderBy('created_at', 'desc')->paginate(10);
            // foreach($reports as $r){
            //     $mUser = User::with('lodges')->find($r->user_id);
            //     $lodgeName = $mUser->lodges[0]->name;
            //     $r->facility_name = $lodgeName;
            // }

            return $reports;
        }elseif( $user['role']=='hotel' ){
            $reports = Report::with(['reportDetails','user'])->where('user_id',$user['id'])->orderBy('created_at', 'desc')->paginate(10);
            // foreach($reports as $r){
            //     $mUser = User::with('lodges')->find($r->user_id);
            //     $r->facility_name = $mUser->name;
            // }
            return $reports;
        }
    }

    public function findReportById($id){
        return Report::with(['reportDetails','user'])->findOrFail($id);
    }
}
        // $user = User::with('lodges')->find($mReport->user_id);
        // $role = $user->role;
        //     if($role=='lodge'){
        //         $lodgeName = $user->lodges[0]->name;
        //         $mReport->facility_name = $lodgeName;
        //     }else{
        //         $mReport->facility_name = $user->name;
        //     }
