<?php

namespace App\Http\Controllers\Api\Boards;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardStoreRequest;
use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\{BoardResource,CardResource};
use App\Models\Mongo\{Board,BoardList,Card};

class BoardController extends Controller {
    public function index(){
        $userId = auth()->id();
        $boards = Board::where('members',$userId)->get();
        return BoardResource::collection($boards);
    }

    public function store(BoardStoreRequest $r){
        $payload = $r->validated();
        $payload['members'] = array_values(array_unique(array_merge($payload['members'] ?? [], [auth()->id()])));
        $payload['created_at'] = now();
        $board = Board::create($payload);
        return new BoardResource($board);
    }

    public function storeCard(CardStoreRequest $r, string $board){
        $boardDoc = Board::findOrFail($board);
        $this->authorize('member',$boardDoc);

        $data = $r->validated();

        $list = BoardList::findOrFail($data['list_id']);
        abort_unless((string)$list->board_id === (string)$boardDoc->_id, 422, 'List not in board');

        $card = Card::create($data);
        return new CardResource($card);
    }

    public function show(string $board){
        $b = Board::findOrFail($board);
        $this->authorize('member',$b);
        return new BoardResource($b);
    }
}
