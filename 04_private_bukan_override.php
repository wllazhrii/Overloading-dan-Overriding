<?php
declare(strict_types=1);
class Induk {
    private function rahasia(): string { return 'induk'; }
    public function panggil(): string { return $this->rahasia(); }
}
class Anak extends Induk {
    // BUKAN override: method private induk tidak diwariskan, jadi signature bebas
    private function rahasia(int $x = 1): string { return 'anak'; }
}
echo (new Anak())->panggil() . PHP_EOL; // induk (bukan 'anak')
