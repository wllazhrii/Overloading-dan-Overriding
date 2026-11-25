<?php
declare(strict_types=1);
require __DIR__.'/../src/bootstrap.php';
// summary() parent public. Child membuatnya protected -> Fatal error
class Coba extends Student {
    public function getType(): string { return 'coba'; }
    public function calculateFee(): float { return 0.0; }
    protected function summary(): string { return 'x'; }
}
echo "tidak sampai sini\n";
