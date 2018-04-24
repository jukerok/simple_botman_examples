<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('hello', 'App\Http\Controllers\ExampleCommandsController@handleSayHello');

        $botman->hears('hey', 'App\Http\Controllers\ExampleCommandsController@handleSayHello');

        $botman->hears('im {name}', 'App\Http\Controllers\ExampleCommandsController@handleHelloWithName');

        $botman->hears('session', 'App\Http\Controllers\ExampleCommandsController@getSession');

        $botman->hears('what is my name', 'App\Http\Controllers\ExampleCommandsController@tellName');



        $botman->fallback(function ($bot) {
            $bot->reply("Sorry, I did not understand these commands.");
        });



        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
}
