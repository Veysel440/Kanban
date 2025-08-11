<?php

namespace App\Http\Controllers\Api\Lists;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListStoreRequest;
use App\Http\Resources\BoardListResource;
use App\Models\Mongo\{Board,BoardList};

class BoardListController extends Controller {
    public function index(string $board){
        $b = Board::findOrFail($board);
        $this->authorize('member',$b);
        $lists = BoardList::where('board_id',$b->_id)->orderBy('order')->get();
        return BoardListResource::collection($lists);
    }

    public function store(ListStoreRequest $r){
        $b = Board::findOrFail($r->string('board_id'));
        $this->authorize('member',$b);
        $list = BoardList::create($r->validated());
        return new BoardListResource($list);
    }

    public function update(ListStoreRequest $r, string $list){
        $doc = BoardList::findOrFail($list);
        $b = Board::findOrFail($doc->board_id);
        $this->authorize('member',$b);
        $doc->fill($r->validated()); $doc->save();
        return new BoardListResource($doc);
    }

    public function destroy(string $list){
        $doc = BoardList::findOrFail($list);
        $b = Board::findOrFail($doc->board_id);
        $this->authorize('member',$b);
        $doc->delete();
        return response()->noContent();
    }
}
