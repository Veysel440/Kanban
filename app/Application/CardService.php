<?php

namespace App\Application;

use App\Domain\Cards\CardServiceInterface;
use App\Domain\Cards\CardRepositoryInterface;
use App\Events\CardMoved;
use App\Infra\Redis\ActivityFeed;
use App\Models\Mongo\Card;
use Carbon\Carbon;

class CardService implements CardServiceInterface {
    public function __construct(
        private CardRepositoryInterface $cards,
        private ActivityFeed $feed
    ) {}

    public function move(string $cardId, string $toListId, ?float $beforeOrder, ?float $afterOrder, int $actorId): Card {
        $card = $this->cards->find($cardId);
        $newOrder = $this->computeOrder($beforeOrder, $afterOrder);
        $updated = $this->cards->updateOrder($card, $toListId, $newOrder);

        $activity = [
            'actor_id'   => (string)$actorId,
            'verb'       => 'card.moved',
            'object_id'  => (string)$cardId,
            'to_list_id' => (string)$toListId,
            'order'      => (string)$newOrder,
            'ts'         => (string)Carbon::now()->getTimestampMs(),
        ];
        $this->feed->write((string)$this->resolveBoardId($toListId), $activity);

        CardMoved::dispatch($updated, $activity);
        return $updated;
    }

    private function computeOrder(?float $before, ?float $after): float {
        if ($before !== null && $after !== null) return ($before + $after)/2;
        if ($before !== null) return $before + 1;
        if ($after  !== null) return $after  - 1;
        return microtime(true); // fallback
    }

    private function resolveBoardId(string $listId): string {
        return (string)\App\Models\Mongo\BoardList::find($listId)?->board_id;
    }
}
