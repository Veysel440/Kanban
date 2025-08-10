<?php

namespace App\Http\Controllers\Api\Activities;

use App\Http\Controllers\Controller;
use App\Infra\Redis\ActivityFeed;
use App\Models\Mongo\Board;
use Illuminate\Http\Request;

class ActivityController extends Controller {
    public function __construct(private ActivityFeed $feed){}
    public function index(Request $r, string $board){
        $doc = Board::findOrFail($board);
        $this->authorize('member',$doc);
        $after = $r->query('after','0-0');
        return response()->json(['stream'=>$this->feed->range($board,$after,100)]);
    }
}
