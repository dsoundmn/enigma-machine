<?php

namespace EnigmaMachine;

const ASCII_OFFSET = 65;

function toInt($c)
{
    return ord($c) - ASCII_OFFSET;
}

function toChar($i)
{
    return chr($i + ASCII_OFFSET);
}

function buildBasicEnigmaMachine($configurePlugBoard = null)
{
    $plugBoard = new \EnigmaMachine\PlugBoard();

    if (is_callable($configurePlugBoard)) {
        call_user_func($configurePlugBoard, $plugBoard);
    }

    $reflector = \EnigmaMachine\Reflector::build('B');

    $rotors = new \EnigmaMachine\RotorCollection('I', 'II', 'III');

    return new \EnigmaMachine\EnigmaMachine($rotors, $reflector, $plugBoard);
}
