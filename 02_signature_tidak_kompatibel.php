<?php
declare(strict_types=1);
require __DIR__.'/../src/bootstrap.php';
// calculateFee() parent: (): float. Child menambah parameter wajib -> Fatal error
class Coba extends Student {
    public function getType(): string { return 'coba'; }
    public function calculateFee(int $bonus): float { return 0.0; }
}
echo "tidak sampai sini\n";
