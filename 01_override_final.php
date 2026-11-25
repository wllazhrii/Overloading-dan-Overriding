<?php
declare(strict_types=1);
require __DIR__.'/../src/bootstrap.php';
// T10: getId() pada Student bersifat final -> Fatal error
class Coba extends Student {
    public function getType(): string { return 'coba'; }
    public function calculateFee(): float { return 0.0; }
    public function getId(): string { return 'X'; }
}
echo "tidak sampai sini\n";
