<?php

namespace EnigmaMachine;

class EnigmaMachine
{

    private $rotors;

    private $reflector;

    private $plugBoard;

    public function __construct(RotorCollection $rotors, Reflector $reflector, PlugBoard $plugBoard)
    {
        $this->rotors = $rotors;
        $this->reflector = $reflector;
        $this->plugBoard = $plugBoard;
    }

    public function encode($value)
    {
        $value = $this->cleanInput($value);

        $chars = array_map([ $this, 'encodeChar' ], str_split($value));

        return join('', $chars);
    }

    private function cleanInput($value)
    {
        return preg_replace('~[^A-Z]~', '', strtoupper($value));
    }

    private function encodeChar($char)
    {
        $this->rotors->step();

        $char = $this->plugBoard->convert($char);

        $char = $this->rotors->in($char);

        $char = $this->reflector->reflect($char);

        $char = $this->rotors->out($char);

        $char = $this->plugBoard->convert($char);

        return $char;
    }
}
