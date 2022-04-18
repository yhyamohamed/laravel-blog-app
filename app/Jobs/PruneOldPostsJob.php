<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Post;
use Carbon\Carbon;

class PruneOldPostsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public function __construct()
    {
        //
    }


    public function handle()
    {
        //   User::create([
        //       'name'=>'yaya3',
        //       'email'=>'iti@itit.com',
        //       'password'=>'123456'
        // ]);
        Post::where('created_at', '<=', Carbon::now()->subYears(2)->toDateTimeString())->delete();
    }
}
