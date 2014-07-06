<?php

namespace EnigmaMachine;

class Rotor
{

    private $mapping;

    private $reversedMapping;

    private $mappingSize;

    private $notchPositions;

    private $rotorPosition;

    public function __construct($mapping, $notches, $startPosition = 0)
    {
        $this->mapping = $this->getProcessedMapping($mapping);
        $this->reversedMapping = $this->getProcessedReversedMapping($this->mapping);
        $this->mappingSize = count($this->mapping);
        $this->notchPositions = $this->getProcessedNotchPositions($notches);
        $this->rotorPosition = $startPosition;
    }

    public function in($char)
    {
        $position = $this->getCharPosition($char);

        $output = $this->mapping[$position];

        return $this->convertForNotchPosition($output);
    }

    public function out($char)
    {
        $position = $this->getCharPosition($char);

        $output = $this->reversedMapping[$position];

        return $this->convertForNotchPosition($output);
    }

    public function inNotch()
    {
        return in_array($this->rotorPosition, $this->notchPositions);
    }

    public function step()
    {
        $this->rotorPosition = ($this->rotorPosition + 1) % ($this->mappingSize - 1);
    }

    private function convertForNotchPosition($char)
    {
        $output = toInt($char) - $this->rotorPosition;

        if ($output < 0) {
            $output = $this->mappingSize + $output;
        }

        return toChar($output);
    }

    private function getCharPosition($char)
    {
        return (toInt($char) + $this->rotorPosition) % $this->mappingSize;
    }

    private function getProcessedMapping($mapping)
    {
        return str_split($mapping);
    }

    private function getProcessedReversedMapping($mapping)
    {
        $output = $mapping;

        for ($i = 0; $i < count($mapping); $i++) {
            $output[toInt($mapping[$i])] = toChar($i);
        }

        return $output;
    }

    private function getProcessedNotchPositions($notches)
    {
        return array_map('\EnigmaMachine\toInt', $this->getProcessedMapping($notches));
    }

    public static function build($type)
    {
        switch ($type) {
            case 'I':
                return new static('EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'Q');
            case 'II':
                return new static('AJDKSIRUXBLHWTMCQGZNPYFVOE', 'E');
            case 'III':
                return new static('BDFHJLCPRTXVZNYEIWGAKMUSQO', 'V');
            case 'IV':
                return new static('ESOVPZJAYQUIRHXLNFTGKDCMWB', 'J');
            case 'V':
                return new static('VZBRGITYUPSDNHLXAWMJQOFECK', 'Z');
        }

        throw new \InvalidArgumentException('Invalid Rotor Type');
    }
}
