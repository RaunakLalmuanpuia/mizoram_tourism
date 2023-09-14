<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\NoticeRepositoryInterface;
use App\Models\Category;
use App\Models\Notice;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class NoticeControllerApi extends Controller
{
  private NoticeRepositoryInterface $noticeRepository;
  public function __construct(NoticeRepositoryInterface $noticeRepository)
  {
    $this->noticeRepository = $noticeRepository;
  }

  public function index()
  {
    $categories = Category::select('id', 'name')->distinct()->get();
    $notices = Notice::with('category', 'images')->get();
    return [
      'categories' => $categories,
      'data' => $notices
    ];
  }

  public function create()
  {
  }

  public function store(Request $request)
  {
    return [
      'data' => $this->noticeRepository->createNotice($request->all())
    ];
  }

  public function show(Notice $notice)
  {
    return $this->noticeRepository->getNoticeById($notice->id);
  }

  public function edit(Notice $notice)
  {
  }

  public function update(Request $request, Notice $notice)
  {
    return $this->noticeRepository->updateNotice($notice->id, $request->all());
  }

  public function destroy(Notice $notice)
  {
    return $this->noticeRepository->deleteNotice($notice->id);
  }
  public function filterNotice(Request $request)
  {

    $cat = $request->category != null ? $request->category : [];
    $startDate = $request->from;
    $endDate = $request->to;

    $data = Notice::whereBetween('created_at', [$startDate, $endDate])->orWhereIn('categories_id', $cat)->with('category')->get();
    return $data;
  }
}
