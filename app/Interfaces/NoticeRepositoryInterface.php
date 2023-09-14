<?php

namespace App\Interfaces;

interface NoticeRepositoryInterface 
{
    public function getAllNotice();
    public function getNoticeById($noticeId);
    public function deleteNotice($noticeId);
    public function createNotice(array $noticeDetails);
    public function updateNotice($noticeId, array $newDetails);

}