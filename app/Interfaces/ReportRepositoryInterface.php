<?php

namespace App\Interfaces;

interface ReportRepositoryInterface 
{
    public function storeReport($reports);
    public function showReports($role);
    public function findReportById($id);

}