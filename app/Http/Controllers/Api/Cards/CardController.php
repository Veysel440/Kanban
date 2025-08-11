<?php

namespace App\Http\Controllers\Api\Cards;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\CardResource;
use App\Models\Mongo\{Card,BoardList,Board};

class CardController extends Controller {
    public function store(CardStoreRequest $r){
        $list = BoardList::findOrFail($r->string('list_id'));
        $board = Board::findOrFail($list->board_id);
        $this->authorize('member',$board);
        $card = Card::create($r->validated());
        return new CardResource($card);
    }

    public function update(CardStoreRequest $r, string $card){
        $doc = Card::findOrFail($card);
        $list = BoardList::findOrFail($doc->list_id);
        $board = Board::findOrFail($list->board_id);
        $this->authorize('member',$board);
        $doc->fill($r->validated()); $doc->save();
        return new CardResource($doc);
    }

    public function destroy(string $card){
        $doc = Card::findOrFail($card);
        $list = BoardList::findOrFail($doc->list_id);
        $board = Board::findOrFail($list->board_id);
        $this->authorize('member',$board);
        $doc->delete();
        return response()->noContent();
    }
}
