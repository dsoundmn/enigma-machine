<?php

namespace EnigmaMachine;

class PlugBoard
{

    private $plugs;

    public function __construct()
    {
        $this->plugs = [];
    }

    public function convert($char)
    {
        $position = toInt($char);

        return isset($this->plugs[$position])
            ? toChar($this->plugs[$position])
            : $char;
    }

    public function addCable($a, $b)
    {
        $aPosition = toInt($a);
        $bPosition = toInt($b);

        $this->plugs[$aPosition] = $bPosition;
        $this->plugs[$bPosition] = $aPosition;

        return $this;
    }
}
