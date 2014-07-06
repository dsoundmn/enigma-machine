<?php

namespace EnigmaMachine;

class Reflector
{

    private $mapping;

    public function __construct($mapping)
    {
        $this->mapping = str_split($mapping);
    }

    public function reflect($c)
    {
        return $this->mapping[toInt($c)];
    }

    public static function build($type)
    {
        switch ($type) {
            case 'A':
                return new static('EJMZALYXVBWFCRQUONTSPIKHGD');
            case 'B':
                return new static('YRUHQSLDPXNGOKMIEBFZCWVJAT');
            case 'C':
                return new static('FVPJIAOYEDRZXWGCTKUQSBNMHL');
        }

        throw new \InvalidArgumentException('Invalid Reflector Type');
    }
}
