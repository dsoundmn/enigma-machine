Enigma Machine
==============

_Implementation of the Enigma Machine_

## Example Usage

```php
$enigma = \EnigmaMachine\buildBasicEnigmaMachine(function (\EnigmaMachine\PlugBoard $plugBoard) {
    $plugBoard->addCable('H', 'F');
});

$enigma->encode('HELLOWORLD'); // ELBDAAMTAZ
```