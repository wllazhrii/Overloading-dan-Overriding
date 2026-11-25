<?php
declare(strict_types=1);
/** Variadic: HANYA satu deklarasi add(); bukan traditional method overloading. */
final class Calculator {
    public function add(int ...$numbers): int {
        return array_sum($numbers);
    }
}
