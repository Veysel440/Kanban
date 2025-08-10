<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mongo\{Board,BoardList,Card};

class KanbanSeeder extends Seeder {
    public function run(): void {
        $u = User::first() ?? User::factory()->create(['email'=>'test@example.com']);
        $b = Board::create(['name'=>'Demo','members'=>[$u->id],'created_at'=>now()]);
        $todo = BoardList::create(['board_id'=>$b->_id,'title'=>'Todo','order'=>1]);
        $doing= BoardList::create(['board_id'=>$b->_id,'title'=>'Doing','order'=>2]);
        Card::create(['list_id'=>$todo->_id,'title'=>'İlk kart','order'=>1]);
        Card::create(['list_id'=>$todo->_id,'title'=>'İkinci','order'=>2]);
        Card::create(['list_id'=>$doing->_id,'title'=>'Üçüncü','order'=>1]);
    }
}
