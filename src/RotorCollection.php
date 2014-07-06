<?php

namespace EnigmaMachine;

class RotorCollection
{

    private $rotors;

    public function __construct($roter1, $roter2, $roter3)
    {
        $this->rotors = $this->getRotorInstances(func_get_args());
    }

    public function in($char)
    {
        for ($i = count($this->rotors) - 1; $i >= 0; $i--) {
            $char = $this->rotors[$i]->in($char);
        }

        return $char;
    }

    public function out($char)
    {
        for ($i = 0; $i < count($this->rotors); $i++) {
            $char = $this->rotors[$i]->out($char);
        }

        return $char;
    }

    public function step()
    {
        $i = 2;

        if ($this->rotors[1]->inNotch()) {
            $i = 0;
        } else if ($this->rotors[2]->inNotch()) {
            $i = 1;
        }

        for (; $i < count($this->rotors); $i++) {
            $this->rotors[$i]->step();
        }
    }

    private function getRotorInstances(array $rotors)
    {
        return array_map(function ($rotor) {
            return is_string($rotor)
                ? Rotor::build($rotor)
                : $rotor;
        }, $rotors);
    }
}
