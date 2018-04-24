<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use Session;
use App\Conversations\ExampleConversation;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;


class JukerokCommandsController extends Controller
{
    

	/**
	 * Handle when user says "hello"
	 * @param $bot
	*/
	public function handleSayHello($bot)
	{
		$bot->reply("Hello, I'm Jukerok!");
		$this->askName($bot);
	}

	public function handleHelloWithName($bot, $name)
	{

		#$bot->typesAndWaits(1);
		$bot->reply("Nice to meet you $name");

	}




	public function askName($bot)
	{
	
		$bot->ask('Whats your name?', function($answer, $bot) {
        	$this->name 	=	$answer->getText();
        	$this->say('Welcome '. $this->name);

        	#store name in session
    		$this->rawr =  session(['name' => $this->name]);
			
			JukerokCommandsController::tour($this);    		
    	});    		    		

	}


	public static function tour($bot)
	{

		$reply 	=	'';
		
		$bot->ask('Would you like me to take you on a tour on our website?', function($answer, $bot){

			$this->yesNo = $answer->getText();

			if($this->yesNo == 'yes' || $this->yesNo == 'yeah' || $this->yesNo == 'yes please' || $this->yesNo == 'sure' || $this->yesNo == 'why not')
			{
				
				$bot->say('My creator is a Web engineer that dljwka jkd wjk kj kjaj kjhdka jhwkjahkj wahkjwahkjwa ');
				
				
				JukerokCommandsController::showPages($this);
			}
			else
			{
				$bot->say('no tour :)');
				
			}


		});


	}


	public static function showPages($bot)
	{

		
		$bot->ask('would you like me to start showing you some cool stuff?',function($answer,$bot){

			$this->yesNo = $answer->getText();

			$bot->say('you answered ' . $answer->getText());


		});

	}


	public function tellName($bot)
	{
		$name 	= 	session('name');

		if(!empty($name))
		{
			$this->say('sure, you are '.$name);
			$bot->ask('am I correct?', function($answer,$bot){
				if($this->yesNo == 'yes' || $this->yesNo == 'yeah' || $this->yesNo == 'yes please' || $this->yesNo == 'sure' || $this->yesNo == 'why not')
				{

					$bot->say('all hail great '.$name);

				}
				else{

					$bot->say('ok then');
					$this->askName($bot);
				}
			
			});
		}

	}


	public function getSession()
	{

		$data = session('name');

		file_put_contents('dido.log', $data);
	}

	
}

