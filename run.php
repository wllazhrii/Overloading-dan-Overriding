<?php
declare(strict_types=1);
require __DIR__.'/../src/bootstrap.php';
$pass=0;
function check(bool $ok, string $label): void { 
        global $pass; if(!$ok) throw new RuntimeException('FAIL: '.$label); $pass++; echo "PASS: $label\n";
        }
function fails(callable $fn, string $exception, string $label): void {
        try{$fn();}catch(Throwable $e){check($e instanceof $exception,$label);return;}throw new RuntimeException('FAIL: '.$label);
        }
$r=new StudentRepository();
$a=new RegularStudent('M01','Alya','Informatika',5000000);
$b=new ScholarshipStudent('M02','Bima','SI',5000000,40);

check($a instanceof Student,'Inheritance regular');
check($b instanceof Student,'Inheritance scholarship');
check($a->calculateFee()===5000000.0,'Overriding biaya reguler');
check($b->calculateFee()===3000000.0,'Overriding biaya beasiswa');
check(str_contains($b->summary(),'[Beasiswa]'),'Overriding + parent::');

$r->create($a);$r->create($b);
check(count($r->all())===2,'Create');
check($r->find('M02')===$b,'Read');
fails(fn()=>$r->create($a),InvalidArgumentException::class,'NIM duplikat ditolak');
$r->update('M01',new RegularStudent('M03','Cici','Informatika',4000000));
check($r->find('M01')===null && $r->find('M03')!==null,'Update NIM');
$r->delete('M03');
check(count($r->all())===1,'Delete');
$p=new StudentPresenter();
check($p->showData('Alya')==='Nama: Alya','__call satu argumen');
check(str_contains($p->showData('M01','Alya'),'NIM:'),'__call dua argumen');
check(str_contains($p->showData('M01','Alya','TI'),'Prodi:'),'__call tiga argumen');
fails(fn()=>$p->showData(),InvalidArgumentException::class,'__call argumen invalid');
fails(fn()=>$p->unknown(),BadMethodCallException::class,'__call method invalid');
fails(fn()=>new ScholarshipStudent('M04','Dina','TI',1000,101),InvalidArgumentException::class,'Diskon invalid');
check((new ReflectionMethod(Student::class,'getId'))->isFinal(),'Final method tidak boleh override');

// --- Tambahan Pertemuan 8 (T01, T08, Tugas 3) ---
$calc=new Calculator();
check($calc->add(10,20)===30,'T01 add(10,20)=30');
check($calc->add(10,20,30)===60,'T01 add(10,20,30)=60');
$c=new InternationalStudent('M05','Eka','TI',5000000);
check($c instanceof Student,'Inheritance international');
check($c->calculateFee()===6250000.0,'Tugas 3 biaya internasional');
$r->create($c);
check($r->find('M05')===$c,'Repository menyimpan InternationalStudent tanpa diubah');
fails(fn()=>new ScholarshipStudent('M06','Fani','TI',1000,-1),InvalidArgumentException::class,'T08 diskon -1 invalid');
echo "TOTAL: $pass tests passed\n";
