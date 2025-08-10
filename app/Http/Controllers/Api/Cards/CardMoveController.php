<?php

namespace App\Http\Controllers\Api\Cards;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardMoveRequest;
use App\Application\CardService;
use App\Models\Mongo\Board;
use App\Models\Mongo\BoardList;
use App\Models\Mongo\Card;

class CardMoveController extends Controller {
    public function __construct(private CardService $service){}

    public function __invoke(CardMoveRequest $r, string $card) {
        $cardDoc = Card::findOrFail($card);
        $toList = BoardList::findOrFail($r->string('to_list_id'));
        $board = Board::findOrFail($toList->board_id);
        $this->authorize('member', $board);

        $updated = $this->service->move(
            $card,
            (string)$toList->_id,
            $r->input('before_order'),
            $r->input('after_order'),
            auth()->id()
        );
        return response()->json(['data'=>$updated]);
    }
}
