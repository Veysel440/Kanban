<?php

namespace App\Infra\Redis;

use App\Domain\Activities\ActivityFeedInterface;
use Illuminate\Support\Facades\Redis;

class ActivityFeed implements ActivityFeedInterface {
    public function write(string $boardId, array $payload): string {
        return Redis::xadd("board:$boardId:activities", '*', $payload);
    }
    public function range(string $boardId, string $after = '0-0', int $count = 100): array {
        return Redis::xrange("board:$boardId:activities", $after, '+', $count) ?? [];
    }
}
