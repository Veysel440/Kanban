<?php

namespace App\Domain\Activities;

interface ActivityFeedInterface {
    public function write(string $boardId, array $payload): string;
    public function range(string $boardId, string $after = '0-0', int $count = 100): array;
}
