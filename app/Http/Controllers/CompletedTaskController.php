<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Task as TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CompletedTask as CompletedTaskModel;
use App\Http\Controllers\CompletedTaskController;

class CompletedTaskController extends Controller
{
     /**
     * タスク一覧ページを 表示する
     * 
     * @return \Illuminate\View\View
     */
    public function list()
    {
        //1ページ辺りの表示アイテム数を設定
        $per_page = 1;
        
        //一覧の取得
       $list = CompletedTaskModel::where('user_id', Auth::id())
                         ->orderBy('priority', 'DESC')
                         ->orderBy('period')
                         ->orderBy('created_at')
                         ->paginate($per_page);
                        // ->get();
        return view('task.completed_list', ['list' => $list]);
    }
}