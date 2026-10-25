<?php
//Class Buku (Enkapsulasi)
class Buku {
    private $judul;
    private $penulis;
    private $status;

    public function __construct($judul, $penulis) {
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->status = "Tersedia";
    }

    //Getter
    public function getJudul() {
        return $this->judul;
    }

    public function getPenulis() {
        return $this->penulis;
    }

    public function getStatus() {
        return $this->status;
    }

    //Setter
    public function setStatus($status) {
        $this->status = $status;
    }

    public function tampilInfo() {
        return "Buku : {$this->judul} | Penulis : {$this->penulis} | Status : {$this->status}";
    }
}

//Class Inheritance
abstract class Orang {
    protected $nama;
    protected $id;

    public function __construct($nama, $id) {
        $this->nama = $nama;
        $this->id = $id;
    }

    abstract public function tampilInfo();
}

//Class Anggota
class Anggota extends Orang {

    public function tampilInfo() {
        return "Anggota : {$this->nama} | ID : {$this->id}";
    }
}

//Class Peminjam
class Peminjam extends Anggota {

    private $bukuDipinjam = [];

    public function pinjamBuku(Buku $buku) {
        if ($buku->getStatus() == "Tersedia") {
            $this->bukuDipinjam[] = $buku;
            $buku->setStatus("Dipinjam");
        } else {
            echo "Buku '{$buku->getJudul()}' sedang tidak tersedia.<br>";
        }
    }

    //Polimorfisme
    public function tampilInfo() {
        $jumlah = count($this->bukuDipinjam);
        return "Peminjam : {$this->nama} | ID : {$this->id} | Jumlah Buku Dipinjam : {$jumlah}";
    }

    public function tampilDaftarBuku() {
        echo "<b>Daftar Buku Dipinjam:</b><br>";

        if (empty($this->bukuDipinjam)) {
            echo "- Belum ada buku dipinjam.<br>";
            return;
        }

        foreach ($this->bukuDipinjam as $buku) {
            echo "- " . $buku->getJudul() . "<br>";
        }
    }
}
//Program Utama
$buku1 = new Buku("Laskar Pelangi", "Andrea Hirata");
$buku2 = new Buku("Bumi", "Tere Liye");

$peminjam = new Peminjam("Nanow", "UG25");

//Meminjam buku
$peminjam->pinjamBuku($buku1);

//Output
echo $buku1->tampilInfo() . "<br>";
echo $buku2->tampilInfo() . "<br><br>";

echo $peminjam->tampilInfo() . "<br>";
$peminjam->tampilDaftarBuku();

?>