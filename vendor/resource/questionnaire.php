<?php

/**
 * Questionnaire data class
 */
class Questionnaire{
	private $questions = array(
		"Любишь смотреть на звезды?",
		"На тебя сейчас смотрит кто нибудь из твоих друзей?",
		"В детстве тебя дразнили \"Головастиком\"?",
		"Тебе нравится смотреть фильмы?",
		"В твоем присутствии часто лопаются электрические лампочки?",
		"Размер твоей ступни меньше среднего?",
		"Твой рост выше большинства твоих сверстников?",
		"Тебе часто говорят, что у тебя необычный взгляд?",
		"Ты творческая личность?",
		"Ты любишь болтать?",
		"Считаешь ли ты себя аккуратным человеком?",
		"Раны и переломы заживают быстрее, чем у других?",
		"Ты супер активный человек и мало спишь?",
		"Как считаешь, у тебя влюбчивая натура?",
		"Друзья часто замечают, что у тебя холодные руки?",
		"Считаешь ты себя домоседом?",
		"Желаешь стать богатым?",
		"Ты пунктуальный человек?",
		"Тебя любят домашние животные?",
		"Ты быстрее всех запоминаешь информацию?",
		"Сможешь сейчас рассказать о своем детстве?",
		"Знаешь сколько лет назад появились люди на земле?",
		"У тебя получается читать мысли других людей?",
		"Твой голос с низким тембром звучания?",
		"Тебе нравится читать художественную литературу?"
	);

	private $answers = array(0,1,1,0,1,1,1,1,1,0,1,1,1,0,1,0,0,1,0,1,0,1,1,1,0);

    /**
     * Getting question from array by number
     * @param  [int] $number - value from 0 to 24
     * @return mixed|null [String]  - question (text), or null - if number out of range
     */
	function getQuestion($number){
	    $number = $number - 1;
		if($number > (sizeof($this->questions) - 1)) return null;
		else return $this->questions[$number];
	}

    /**
     * Getting answers from array by number
     * @param  [int] $number - value from 0 to 24
     * @return int|mixed [int]  - answer, or '-1' - if number out of range
     */
	function getAnswer($number){
        $number = $number - 1;
		if($number > (sizeof($this->questions) - 1)) return -1;
		else return $this->answers[$number];
	}
}