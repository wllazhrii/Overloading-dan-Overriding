<?php
declare(strict_types=1);
/** Tugas 3: child baru, calculateFee() berbeda. StudentRepository TIDAK diubah. */
final class InternationalStudent extends Student {
    private const SURCHARGE_PERCENT = 25.0; // biaya layanan mahasiswa internasional
    public function getType(): string { return 'international'; }
    public function calculateFee(): float { return $this->baseFee * (1 + self::SURCHARGE_PERCENT / 100); }
    public function summary(): string { return parent::summary() . ' [Internasional]'; }
}
