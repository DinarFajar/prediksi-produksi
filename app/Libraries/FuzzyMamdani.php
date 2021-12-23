<?php 

namespace App\Libraries;

class FuzzyMamdani
{
	// BATAS VARIABEL INPUT
	private $_batasPermintaanSedikit = 80;
	private $_batasPermintaanSedang = 120;
	private $_batasPermintaanBanyak = 200;

	private $_batasSisaSedikit = 0;
	private $_batasSisaSedang = 45;
	private $_batasSisaBanyak = 75;

	private $_batasKekuranganSedikit = 0;
	private $_batasKekuranganSedang = 29;
	private $_batasKekuranganBanyak = 50;

	private $_batasProduksiSedikit = 93;
	private $_batasProduksiSedang = 120;
	private $_batasProduksiBanyak = 200;

	// NILAI VARIABEL INPUT
	public $jumlahPermintaan;
	public $jumlahSisa = 0;
	public $jumlahKekurangan = 0;
	public $jumlahProduksi = 0;

	// HASIL FUZZIFIKASI MASING-MASING HIMPUNAN
	public $hasilFuzzyPermintaanSedikit;
	public $hasilFuzzyPermintaanSedang;
	public $hasilFuzzyPermintaanBanyak;

	public $hasilFuzzySisaSedikit;
	public $hasilFuzzySisaSedang;
	public $hasilFuzzySisaBanyak;

	public $hasilFuzzyKekuranganSedikit;
	public $hasilFuzzyKekuranganSedang;
	public $hasilFuzzyKekuranganBanyak;

	public $hasilFuzzyProduksiSedikit;
	public $hasilFuzzyProduksiSedang;
	public $hasilFuzzyProduksiBanyak;

	// HASIL IMPLIKASI
	public $hasilImplikasiR1;
	public $hasilImplikasiR2;
	public $hasilImplikasiR3;
	public $hasilImplikasiR4;
	public $hasilImplikasiR5;
	public $hasilImplikasiR6;
	public $hasilImplikasiR7;
	public $hasilImplikasiR8;
	public $hasilImplikasiR9;
	public $hasilImplikasiR10;
	public $hasilImplikasiR11;
	public $hasilImplikasiR12;
	public $hasilImplikasiR13;
	public $hasilImplikasiR14;
	public $hasilImplikasiR15;
	public $hasilImplikasiR16;
	public $hasilImplikasiR17;
	public $hasilImplikasiR18;

	// RULE PRODUKSI
	public $ruleProduksiSedikit = [];
	public $ruleProduksiSedang = [];
	public $ruleProduksiBanyak = [];

	public $ruleProduksiSedikitWithKey = [];
	public $ruleProduksiSedangWithKey = [];
	public $ruleProduksiBanyakWithKey = [];

	// HASIL KOMPOSISI
	public $hasilKomposisiSedikit;
	public $hasilKomposisiSedang;
	public $hasilKomposisiBanyak;

	// TITIK
	public $titikA1;
	public $titikA2;
	public $titikA3;
	public $titikA4;
	public $titikA5;
	public $titikA6;

	// LUAS BANGUNAN
	public $luasBangunanL1;
	public $luasBangunanL2;
	public $luasBangunanL3;
	public $luasBangunanL4;
	public $luasBangunanL5;
	public $luasBangunanL6;
	public $luasBangunanL7;
	public $luasBangunanTotal;

	// LUAS MOMEN
	public $luasMomenM1;
	public $luasMomenM2;
	public $luasMomenM3;
	public $luasMomenM4;
	public $luasMomenM5;
	public $luasMomenM6;
	public $luasMomenM7;
	public $luasMomenTotal;

	// HASIL PREDIKSI
	public $prediksi;
	public $prediksiFix;

	public function __construct($jumlahPermintaan, $jumlahSisa = 0, $jumlahKekurangan = 0) 
	{
		$this->jumlahPermintaan = $jumlahPermintaan;
		$this->jumlahSisa = $jumlahSisa;
		$this->jumlahKekurangan = $jumlahKekurangan;

		$this->fuzzifikasi();
		$this->implikasi();
		$this->komposisi();
		$this->defuzzifikasi();
		$this->prediksi();
	}

	// FUZIFIKASI

	public function fuzzifikasi() 
	{
		$this->fuzzifikasiPermintaanSedikit();
		$this->fuzzifikasiPermintaanSedang();
		$this->fuzzifikasiPermintaanBanyak();

		$this->fuzzifikasiSisaSedikit();
		$this->fuzzifikasiSisaSedang();
		$this->fuzzifikasiSisaBanyak();

		$this->fuzzifikasiKekuranganSedikit();
		$this->fuzzifikasiKekuranganSedang();
		$this->fuzzifikasiKekuranganBanyak();

		$this->fuzzifikasiProduksiSedikit();
		$this->fuzzifikasiProduksiSedang();
		$this->fuzzifikasiProduksiBanyak();		
	}

	public function fuzzifikasiPermintaanSedikit() 
	{
		if($this->jumlahPermintaan <= $this->_batasPermintaanSedikit) {
			$this->hasilFuzzyPermintaanSedikit = 1;
		} 

		elseif(($this->jumlahPermintaan >= $this->_batasPermintaanSedikit) && ($this->jumlahPermintaan <= $this->_batasPermintaanSedang)) {
			$this->hasilFuzzyPermintaanSedikit = ($this->_batasPermintaanSedang - $this->jumlahPermintaan) / ($this->_batasPermintaanSedang - $this->_batasPermintaanSedikit);
		}

		else {
			$this->hasilFuzzyPermintaanSedikit = 0;
		}
	}

	public function fuzzifikasiPermintaanSedang() 
	{
		if($this->jumlahPermintaan === $this->_batasPermintaanSedang) {
			$this->hasilFuzzyPermintaanSedang = 1;
		} 

		elseif(($this->jumlahPermintaan >= $this->_batasPermintaanSedikit) && ($this->jumlahPermintaan <= $this->_batasPermintaanSedang)) {
			$this->hasilFuzzyPermintaanSedang = ($this->jumlahPermintaan - $this->_batasPermintaanSedikit) / ($this->_batasPermintaanSedang - $this->_batasPermintaanSedikit);
		}

		elseif(($this->jumlahPermintaan >= $this->_batasPermintaanSedang) && ($this->jumlahPermintaan <= $this->_batasPermintaanBanyak)) {
			$this->hasilFuzzyPermintaanSedang = ($this->_batasPermintaanBanyak - $this->jumlahPermintaan) / ($this->_batasPermintaanBanyak - $this->_batasPermintaanSedang);
		}

		else {
			$this->hasilFuzzyPermintaanSedang = 0;
		}
	}

	public function fuzzifikasiPermintaanBanyak() 
	{
		if($this->jumlahPermintaan >= $this->_batasPermintaanBanyak) {
			$this->hasilFuzzyPermintaanBanyak = 1;
		} 

		elseif(($this->jumlahPermintaan >= $this->_batasPermintaanSedang) && ($this->jumlahPermintaan <= $this->_batasPermintaanBanyak)) {
			$this->hasilFuzzyPermintaanBanyak = ($this->jumlahPermintaan - $this->_batasPermintaanSedang) / ($this->_batasPermintaanBanyak - $this->_batasPermintaanSedang);
		}

		else {
			$this->hasilFuzzyPermintaanBanyak = 0;
		}
	}

	public function fuzzifikasiSisaSedikit() 
	{
		if($this->jumlahSisa === 0) {
			$this->hasilFuzzySisaSedikit = 0;
		}

		elseif($this->jumlahSisa <= $this->_batasSisaSedikit) {
			$this->hasilFuzzySisaSedikit = 1;
		} 

		elseif(($this->jumlahSisa >= $this->_batasSisaSedikit) && ($this->jumlahSisa <= $this->_batasSisaSedang)) {
			$this->hasilFuzzySisaSedikit = ($this->_batasSisaSedang - $this->jumlahSisa) / ($this->_batasSisaSedang - $this->_batasSisaSedikit);
		}

		else {
			$this->hasilFuzzySisaSedikit = 0;
		}
	}

	public function fuzzifikasiSisaSedang() 
	{
		if($this->jumlahSisa === $this->_batasSisaSedang) {
			$this->hasilFuzzySisaSedang = 1;
		} 

		elseif(($this->jumlahSisa >= $this->_batasSisaSedikit) && ($this->jumlahSisa <= $this->_batasSisaSedang)) {
			$this->hasilFuzzySisaSedang = ($this->jumlahSisa - $this->_batasSisaSedikit) / ($this->_batasSisaSedang - $this->_batasSisaSedikit);
		}

		elseif(($this->jumlahSisa >= $this->_batasSisaSedang) && ($this->jumlahSisa <= $this->_batasSisaBanyak)) {
			$this->hasilFuzzySisaSedang = ($this->_batasSisaBanyak - $this->jumlahSisa) / ($this->_batasSisaBanyak - $this->_batasSisaSedang);
		}

		else {
			$this->hasilFuzzySisaSedang = 0;
		}
	}

	public function fuzzifikasiSisaBanyak() 
	{
		if($this->jumlahSisa >= $this->_batasSisaBanyak) {
			$this->hasilFuzzySisaBanyak = 1;
		} 

		elseif(($this->jumlahSisa >= $this->_batasSisaSedang) && ($this->jumlahSisa <= $this->_batasSisaBanyak)) {
			$this->hasilFuzzySisaBanyak = ($this->jumlahSisa - $this->_batasSisaSedang) / ($this->_batasSisaBanyak - $this->_batasSisaSedang);
		}

		else {
			$this->hasilFuzzySisaBanyak = 0;
		}
	}

	public function fuzzifikasiKekuranganSedikit() 
	{
		if($this->jumlahKekurangan === 0) {
			$this->hasilFuzzyKekuranganSedikit = 0;
		}

		elseif($this->jumlahKekurangan <= $this->_batasKekuranganSedikit) {
			$this->hasilFuzzyKekuranganSedikit = 1;
		} 

		elseif(($this->jumlahKekurangan >= $this->_batasKekuranganSedikit) && ($this->jumlahKekurangan <= $this->_batasKekuranganSedang)) {
			$this->hasilFuzzyKekuranganSedikit = ($this->_batasKekuranganSedang - $this->jumlahKekurangan) / ($this->_batasKekuranganSedang - $this->_batasKekuranganSedikit);
		}

		else {
			$this->hasilFuzzyKekuranganSedikit = 0;
		}
	}

	public function fuzzifikasiKekuranganSedang() 
	{
		if($this->jumlahKekurangan === $this->_batasKekuranganSedang) {
			$this->hasilFuzzyKekuranganSedang = 1;
		} 

		elseif(($this->jumlahKekurangan >= $this->_batasKekuranganSedikit) && ($this->jumlahKekurangan <= $this->_batasKekuranganSedang)) {
			$this->hasilFuzzyKekuranganSedang = ($this->jumlahKekurangan - $this->_batasKekuranganSedikit) / ($this->_batasKekuranganSedang - $this->_batasKekuranganSedikit);
		}

		elseif(($this->jumlahKekurangan >= $this->_batasKekuranganSedang) && ($this->jumlahKekurangan <= $this->_batasKekuranganBanyak)) {
			$this->hasilFuzzyKekuranganSedang = ($this->_batasKekuranganBanyak - $this->jumlahKekurangan) / ($this->_batasKekuranganBanyak - $this->_batasKekuranganSedang);
		}

		else {
			$this->hasilFuzzyKekuranganSedang = 0;
		}
	}

	public function fuzzifikasiKekuranganBanyak() 
	{
		if($this->jumlahKekurangan >= $this->_batasKekuranganBanyak) {
			$this->hasilFuzzyKekuranganBanyak = 1;
		} 

		elseif(($this->jumlahKekurangan >= $this->_batasKekuranganSedang) && ($this->jumlahKekurangan <= $this->_batasKekuranganBanyak)) {
			$this->hasilFuzzyKekuranganBanyak = ($this->jumlahKekurangan - $this->_batasKekuranganSedang) / ($this->_batasKekuranganBanyak - $this->_batasKekuranganSedang);
		}

		else {
			$this->hasilFuzzyKekuranganBanyak = 0;
		}
	}

	public function fuzzifikasiProduksiSedikit() 
	{
		if($this->jumlahProduksi <= $this->_batasProduksiSedikit) {
			$this->hasilFuzzyProduksiSedikit = 1;
		} 

		elseif(($this->jumlahProduksi >= $this->_batasProduksiSedikit) && ($this->jumlahProduksi <= $this->_batasProduksiSedang)) {
			$this->hasilFuzzyProduksiSedikit = ($this->_batasProduksiSedang - $this->jumlahProduksi) / ($this->_batasProduksiSedang - $this->_batasProduksiSedikit);
		}

		else {
			$this->hasilFuzzyProduksiSedikit = 0;
		}
	}

	public function fuzzifikasiProduksiSedang() 
	{
		if($this->jumlahProduksi === $this->_batasProduksiSedang) {
			$this->hasilFuzzyProduksiSedang = 1;
		} 

		elseif(($this->jumlahProduksi >= $this->_batasProduksiSedikit) && ($this->jumlahProduksi <= $this->_batasProduksiSedang)) {
			$this->hasilFuzzyProduksiSedang = ($this->jumlahProduksi - $this->_batasProduksiSedikit) / ($this->_batasProduksiSedang - $this->_batasProduksiSedikit);
		}

		elseif(($this->jumlahProduksi >= $this->_batasProduksiSedang) && ($this->jumlahProduksi <= $this->_batasProduksiBanyak)) {
			$this->hasilFuzzyProduksiSedang = ($this->_batasProduksiBanyak - $this->jumlahProduksi) / ($this->_batasProduksiBanyak - $this->_batasProduksiSedang);
		}

		else {
			$this->hasilFuzzyProduksiSedang = 0;
		}
	}

	public function fuzzifikasiProduksiBanyak() 
	{
		if($this->jumlahProduksi >= $this->_batasProduksiBanyak) {
			$this->hasilFuzzyProduksiBanyak = 1;
		} 

		elseif(($this->jumlahProduksi >= $this->_batasProduksiSedang) && ($this->jumlahProduksi <= $this->_batasProduksiBanyak)) {
			$this->hasilFuzzyProduksiBanyak = ($this->jumlahProduksi - $this->_batasProduksiSedang) / ($this->_batasProduksiBanyak - $this->_batasProduksiSedang);
		}

		else {
			$this->hasilFuzzyProduksiBanyak = 0;
		}
	}


	// IMPLIKASI

	public function implikasi() 
	{
		$this->implikasiR1();
		$this->implikasiR2();
		$this->implikasiR3();
		$this->implikasiR4();
		$this->implikasiR5();
		$this->implikasiR6();
		$this->implikasiR7();
		$this->implikasiR8();
		$this->implikasiR9();
		$this->implikasiR10();
		$this->implikasiR11();
		$this->implikasiR12();
		$this->implikasiR13();
		$this->implikasiR14();
		$this->implikasiR15();
		$this->implikasiR16();
		$this->implikasiR17();
		$this->implikasiR18();
	}

	// Produksi Sedang
	public function implikasiR1() 
	{
		$this->hasilImplikasiR1 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzySisaSedikit);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR1);
		$this->ruleProduksiSedangWithKey["R1"] = $this->hasilImplikasiR1;
	}

	// Produksi Sedikit
	public function implikasiR2() 
	{
		$this->hasilImplikasiR2 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzySisaSedang);
		array_push($this->ruleProduksiSedikit, $this->hasilImplikasiR2);
		$this->ruleProduksiSedikitWithKey["R2"] = $this->hasilImplikasiR2;
	}

	// Produksi Sedikit
	public function implikasiR3() 
	{
		$this->hasilImplikasiR3 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzySisaBanyak);
		array_push($this->ruleProduksiSedikit, $this->hasilImplikasiR3);
		$this->ruleProduksiSedikitWithKey["R3"] = $this->hasilImplikasiR3;
	}

	// Produksi Sedang
	public function implikasiR4() 
	{
		$this->hasilImplikasiR4 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzySisaSedikit);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR4);
		$this->ruleProduksiSedangWithKey["R4"] = $this->hasilImplikasiR4;
	}

	// Produksi Sedang
	public function implikasiR5() 
	{
		$this->hasilImplikasiR5 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzySisaSedang);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR5);
		$this->ruleProduksiSedangWithKey["R5"] = $this->hasilImplikasiR5;
	}

	// Produksi Sedikit
	public function implikasiR6() 
	{
		$this->hasilImplikasiR6 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzySisaBanyak);
		array_push($this->ruleProduksiSedikit, $this->hasilImplikasiR6);
		$this->ruleProduksiSedikitWithKey["R6"] = $this->hasilImplikasiR6;
	}

	// Produksi Banyak
	public function implikasiR7() 
	{
		$this->hasilImplikasiR7 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzySisaSedikit);
		array_push($this->ruleProduksiBanyak, $this->hasilImplikasiR7);
		$this->ruleProduksiBanyakWithKey["R7"] = $this->hasilImplikasiR7;
	}

	// Produksi Sedang
	public function implikasiR8() 
	{
		$this->hasilImplikasiR8 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzySisaSedang);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR8);
		$this->ruleProduksiSedangWithKey["R8"] = $this->hasilImplikasiR8;
	}

	// Produksi Sedang
	public function implikasiR9() 
	{
		$this->hasilImplikasiR9 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzySisaBanyak);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR9);
		$this->ruleProduksiSedangWithKey["R9"] = $this->hasilImplikasiR9;
	}

	// Produksi Sedang
	public function implikasiR10() 
	{
		$this->hasilImplikasiR10 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzyKekuranganSedikit);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR10);
		$this->ruleProduksiSedangWithKey["R10"] = $this->hasilImplikasiR10;
	}

	// Produksi Sedang
	public function implikasiR11() 
	{
		$this->hasilImplikasiR11 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzyKekuranganSedang);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR11);
		$this->ruleProduksiSedangWithKey["R11"] = $this->hasilImplikasiR11;
	}

	// Produksi Banyak
	public function implikasiR12() 
	{
		$this->hasilImplikasiR12 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzyKekuranganBanyak);
		array_push($this->ruleProduksiBanyak, $this->hasilImplikasiR12);
		$this->ruleProduksiBanyakWithKey["R12"] = $this->hasilImplikasiR12;
	}

	// Produksi Sedang
	public function implikasiR13() 
	{
		$this->hasilImplikasiR13 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzyKekuranganSedikit);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR13);
		$this->ruleProduksiSedangWithKey["R13"] = $this->hasilImplikasiR13;
	}

	// Produksi Sedang
	public function implikasiR14() 
	{
		$this->hasilImplikasiR14 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzyKekuranganSedang);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR14);
		$this->ruleProduksiSedangWithKey["R14"] = $this->hasilImplikasiR14;
	}

	// Produksi Banyak
	public function implikasiR15() 
	{
		$this->hasilImplikasiR15 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzyKekuranganBanyak);
		array_push($this->ruleProduksiBanyak, $this->hasilImplikasiR15);
		$this->ruleProduksiBanyakWithKey["R15"] = $this->hasilImplikasiR15;
	}

	// Produksi Sedang
	public function implikasiR16() 
	{
		$this->hasilImplikasiR16 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzyKekuranganSedikit);
		array_push($this->ruleProduksiSedang, $this->hasilImplikasiR16);
		$this->ruleProduksiSedangWithKey["R16"] = $this->hasilImplikasiR16;
	}

	// Produksi Banyak
	public function implikasiR17() 
	{
		$this->hasilImplikasiR17 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzyKekuranganSedang);
		array_push($this->ruleProduksiBanyak, $this->hasilImplikasiR17);
		$this->ruleProduksiBanyakWithKey["R17"] = $this->hasilImplikasiR17;
	}

	// Produksi Banyak
	public function implikasiR18() 
	{
		$this->hasilImplikasiR18 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzyKekuranganBanyak);
		array_push($this->ruleProduksiBanyak, $this->hasilImplikasiR18);
		$this->ruleProduksiBanyakWithKey["R18"] = $this->hasilImplikasiR18;
	}


	// KOMPOSISI

	public function komposisi() 
	{
		$this->komposisiSedikit();
		$this->komposisiSedang();
		$this->komposisiBanyak();
	}

	public function komposisiSedikit() 
	{
		$this->hasilKomposisiSedikit = max($this->ruleProduksiSedikit);
	}

	public function komposisiSedang() 
	{
		$this->hasilKomposisiSedang = max($this->ruleProduksiSedang);
	}	

	public function komposisiBanyak() 
	{
		$this->hasilKomposisiBanyak = max($this->ruleProduksiBanyak);
	}


	// DEFUZZIFIKASI

	public function defuzzifikasi() 
	{
		$this->titik();
		$this->luasBangunan();
		$this->luasMomen();
	}

	public function titik() 
	{
		$this->titikA1 = $this->_batasProduksiSedikit;
		$this->titikA6 = $this->_batasProduksiBanyak;

		$this->titikA2();
		$this->titikA3();
		$this->titikA4();
		$this->titikA5();
	}

	public function titikA2() 
	{
		if($this->hasilKomposisiSedikit <= $this->hasilKomposisiSedang) {
			$this->titikA2 = $this->_batasProduksiSedikit + (27 * $this->hasilKomposisiSedikit);
		} else {
			$this->titikA2 = $this->_batasProduksiSedang - (27 * $this->hasilKomposisiSedikit);
		}
	}

	public function titikA3() 
	{
		if($this->hasilKomposisiSedikit <= $this->hasilKomposisiSedang) {
			$this->titikA3 = $this->_batasProduksiSedikit + (27 * $this->hasilKomposisiSedang);
		} else {
			$this->titikA3 = $this->_batasProduksiSedang - (27 * $this->hasilKomposisiSedang);
		}
	}

	public function titikA4() 
	{
		if($this->hasilKomposisiSedang <= $this->hasilKomposisiBanyak) {
			$this->titikA4 = $this->_batasProduksiSedang + (80 * $this->hasilKomposisiSedang);
		} else {
			$this->titikA4 = $this->_batasProduksiBanyak - (80 * $this->hasilKomposisiSedang);
		}
	}

	public function titikA5() 
	{
		if($this->hasilKomposisiSedang <= $this->hasilKomposisiBanyak) {
			$this->titikA5 = $this->_batasProduksiSedang + (80 * $this->hasilKomposisiBanyak);
		} else {
			$this->titikA5 = $this->_batasProduksiBanyak - (80 * $this->hasilKomposisiBanyak);
		}
	}

	public function luasBangunan() 
	{
		$this->luasBangunanL1();
		$this->luasBangunanL2();
		$this->luasBangunanL3();
		$this->luasBangunanL4();
		$this->luasBangunanL5();
		$this->luasBangunanL6();
		$this->luasBangunanL7();
		$this->luasBangunanTotal();
	}

	public function luasBangunanL1() 
	{
		$this->luasBangunanL1 = ($this->titikA2 * $this->hasilKomposisiSedikit) - ($this->titikA1 * $this->hasilKomposisiSedikit);
	}

	public function luasBangunanL2() 
	{
		if($this->hasilKomposisiSedikit <= $this->hasilKomposisiSedang) {
			$this->luasBangunanL2 = 0;
		} else {
			$this->luasBangunanL2 = (((($this->_batasProduksiSedang / 27) * $this->titikA3)) - (((1 / 27) / 2) * $this->titikA3 * $this->titikA3)) - (((($this->_batasProduksiSedang / 27) * $this->titikA2)) - (((1 / 27) / 2) * $this->titikA2 * $this->titikA2));
		}
	}

	public function luasBangunanL3() 
	{
		if($this->hasilKomposisiSedikit >= $this->hasilKomposisiSedang) {
			$this->luasBangunanL3 = 0;
		} else {
			$this->luasBangunanL3 = ((((1 / 27) / 2) * $this->titikA3 * $this->titikA3) - ((($this->_batasProduksiSedikit / 27) * $this->titikA3))) - ((((1 / 27) / 2) * $this->titikA2 * $this->titikA2) - ((($this->_batasProduksiSedikit / 27) * $this->titikA2)));
		}
	}

	public function luasBangunanL4() 
	{
		$this->luasBangunanL4 = ($this->titikA4 * $this->hasilKomposisiSedang) - ($this->titikA3 * $this->hasilKomposisiSedang);
	}

	public function luasBangunanL5() 
	{
		if($this->hasilKomposisiSedang <= $this->hasilKomposisiBanyak) {
			$this->luasBangunanL5 = 0;
		} else {
			$this->luasBangunanL5 = (((($this->_batasProduksiBanyak / 80) * $this->titikA5)) - (((1 / 80) / 2) * $this->titikA5 * $this->titikA5)) - (((($this->_batasProduksiBanyak / 80) * $this->titikA4)) - (((1 / 80) / 2) * $this->titikA4 * $this->titikA4));
		}
	}

	public function luasBangunanL6() 
	{
		if($this->hasilKomposisiSedang >= $this->hasilKomposisiBanyak) {
			$this->luasBangunanL6 = 0;
		} else {
			$this->luasBangunanL6 = ((((1 / 80) / 2) * $this->titikA5 * $this->titikA5) - ((($this->_batasProduksiSedang / 80) * $this->titikA5))) - ((((1 / 80) / 2) * $this->titikA4 * $this->titikA4) - ((($this->_batasProduksiSedang / 80) * $this->titikA4)));
		}
	}

	public function luasBangunanL7() 
	{
		$this->luasBangunanL7 = ($this->titikA6 * $this->hasilKomposisiBanyak) - ($this->titikA5 * $this->hasilKomposisiBanyak);
	}

	public function luasBangunanTotal() 
	{
		$this->luasBangunanTotal = 
			$this->luasBangunanL1 +
			$this->luasBangunanL2 +
			$this->luasBangunanL3 +
			$this->luasBangunanL4 +
			$this->luasBangunanL5 +
			$this->luasBangunanL6 +
			$this->luasBangunanL7;
	}

	public function luasMomen() 
	{
		$this->luasMomenM1();
		$this->luasMomenM2();
		$this->luasMomenM3();
		$this->luasMomenM4();
		$this->luasMomenM5();
		$this->luasMomenM6();
		$this->luasMomenM7();
		$this->luasMomenTotal();
	}

	public function luasMomenM1()
	{
		$this->luasMomenM1 = ($this->titikA2 * $this->titikA2 * ($this->hasilKomposisiSedikit / 2)) - ($this->titikA1 * $this->titikA1 * ($this->hasilKomposisiSedikit / 2));
	}

	public function luasMomenM2()
	{
		if($this->hasilKomposisiSedikit <= $this->hasilKomposisiSedang) {
			$this->luasMomenM2 = 0;
		} else {
			$this->luasMomenM2 = ((((($this->_batasProduksiSedang / 27) / 2) * $this->titikA3 * $this->titikA3)) - (((1 / 27) /3) * $this->titikA3 * $this->titikA3 * $this->titikA3)) - ((((($this->_batasProduksiSedang / 27) / 2) * $this->titikA2 * $this->titikA2)) - (((1 / 27) / 3) * $this->titikA2 * $this->titikA2 * $this->titikA2));
		}
	}

	public function luasMomenM3() 
	{
		if($this->hasilKomposisiSedikit >= $this->hasilKomposisiSedang) {
			$this->luasMomenM3 = 0;
		} else {
			$this->luasMomenM3 = ((((1 / 27) / 3) * $this->titikA3 * $this->titikA3 * $this->titikA3) - (((($this->_batasProduksiSedikit / 27) / 2) * $this->titikA3 * $this->titikA3))) - ((((1 / 27) / 3) * $this->titikA2 * $this->titikA2 * $this->titikA2) - (((($this->_batasProduksiSedikit / 27) / 2) * $this->titikA2 * $this->titikA2)));
		}
	}

	public function luasMomenM4() 
	{
		$this->luasMomenM4 = ($this->titikA4 * $this->titikA4 * ($this->hasilKomposisiSedang / 2)) - ($this->titikA3 * $this->titikA3 * ($this->hasilKomposisiSedang / 2));
	}

	public function luasMomenM5()
	{
		if($this->hasilKomposisiSedang <= $this->hasilKomposisiBanyak) {
			$this->luasMomenM5 = 0;
		} else {
			$this->luasMomenM5 = ((((($this->_batasProduksiBanyak / 80) / 2) * $this->titikA5 * $this->titikA5)) - (((1 / 80) / 3) * $this->titikA5 * $this->titikA5 * $this->titikA5)) - ((((($this->_batasProduksiBanyak / 80) / 2) * $this->titikA4 * $this->titikA4)) - (((1 / 80) / 3) * $this->titikA4 * $this->titikA4 * $this->titikA4));
		}
	}

	public function luasMomenM6()
	{
		if($this->hasilKomposisiSedang >= $this->hasilKomposisiBanyak) {
			$this->luasMomenM6 = 0;
		} else {
			$this->luasMomenM6 = ((((1 / 80 ) / 3 ) * $this->titikA5 * $this->titikA5 * $this->titikA5) - (((($this->_batasProduksiSedang / 80) / 2) * $this->titikA5 * $this->titikA5))) - ((((1 / 80) / 3) * $this->titikA4 * $this->titikA4 * $this->titikA4) - (((($this->_batasProduksiSedang / 80) / 2) * $this->titikA4 * $this->titikA4)));
		}
	}

	public function luasMomenM7() 
	{
		$this->luasMomenM7 = ($this->titikA6 * $this->titikA6 * ($this->hasilKomposisiBanyak / 2)) - ($this->titikA5 * $this->titikA5 * ($this->hasilKomposisiBanyak / 2));
	}

	public function luasMomenTotal() 
	{
		$this->luasMomenTotal = 
			$this->luasMomenM1 +
			$this->luasMomenM2 +
			$this->luasMomenM3 +
			$this->luasMomenM4 +
			$this->luasMomenM5 +
			$this->luasMomenM6 +
			$this->luasMomenM7;
	}

	public function prediksi()
	{
		$this->prediksi = $this->luasMomenTotal / $this->luasBangunanTotal;
		$this->prediksiFix = (int) round($this->prediksi);
	}


	// METADATA
	public function meta() 
	{
		return [
			"Permintaan" => $this->jumlahPermintaan,
			"Sisa" => $this->jumlahSisa,
			"Kekurangan" => $this->jumlahKekurangan,

			"Derajat Keanggotaan" => [
				"Permintaan" => [
					"Sedikit" => $this->hasilFuzzyPermintaanSedikit,
					"Sedang" => $this->hasilFuzzyPermintaanSedang,
					"Banyak" => $this->hasilFuzzyPermintaanBanyak,
				],
				"Sisa" => [
					"Sedikit" => $this->hasilFuzzySisaSedikit,
					"Sedang" => $this->hasilFuzzySisaSedang,
					"Banyak" => $this->hasilFuzzySisaBanyak,
				],
				"Kekurangan" => [
					"Sedikit" => $this->hasilFuzzyKekuranganSedikit,
					"Sedang" => $this->hasilFuzzyKekuranganSedang,
					"Banyak" => $this->hasilFuzzyKekuranganBanyak,
				],
			],

			"Implikasi" => [
				"R1" => $this->hasilImplikasiR1,
				"R2" => $this->hasilImplikasiR2,
				"R3" => $this->hasilImplikasiR3,
				"R4" => $this->hasilImplikasiR4,
				"R5" => $this->hasilImplikasiR5,
				"R6" => $this->hasilImplikasiR6,
				"R7" => $this->hasilImplikasiR7,
				"R8" => $this->hasilImplikasiR8,
				"R9" => $this->hasilImplikasiR9,
				"R10" => $this->hasilImplikasiR10,
				"R11" => $this->hasilImplikasiR11,
				"R12" => $this->hasilImplikasiR12,
				"R13" => $this->hasilImplikasiR13,
				"R14" => $this->hasilImplikasiR14,
				"R15" => $this->hasilImplikasiR15,
				"R16" => $this->hasilImplikasiR16,
				"R17" => $this->hasilImplikasiR17,
				"R18" => $this->hasilImplikasiR18,
			],

			"Rule Produksi" => [
				"Sedikit" => $this->ruleProduksiSedikitWithKey,
				"Sedang" => $this->ruleProduksiSedangWithKey,
				"Banyak" => $this->ruleProduksiBanyakWithKey,
			],

			"Komposisi" => [
				"Sedikit" => $this->hasilKomposisiSedikit,
				"Sedang" => $this->hasilKomposisiSedang,
				"Banyak" => $this->hasilKomposisiBanyak,
			],

			"Defuzzifikasi" => [
				"Titik" => [
					"A1" => $this->titikA1,
					"A2" => $this->titikA2,
					"A3" => $this->titikA3,
					"A4" => $this->titikA4,
					"A5" => $this->titikA5,
					"A6" => $this->titikA6,
				],
				"Luas Bangunan" => [
					"L1" => $this->luasBangunanL1,
					"L2" => $this->luasBangunanL2,
					"L3" => $this->luasBangunanL3,
					"L4" => $this->luasBangunanL4,
					"L5" => $this->luasBangunanL5,
					"L6" => $this->luasBangunanL6,
					"L7" => $this->luasBangunanL7,
					"Total" => $this->luasBangunanTotal,
				],
				"Luas Momen" => [
					"M1" => $this->luasMomenM1,
					"M2" => $this->luasMomenM2,
					"M3" => $this->luasMomenM3,
					"M4" => $this->luasMomenM4,
					"M5" => $this->luasMomenM5,
					"M6" => $this->luasMomenM6,
					"M7" => $this->luasMomenM7,
					"Total" => $this->luasMomenTotal,
				],
			],

			"Hasil PREDIKSI" => $this->prediksi,
			"Hasil PREDIKSI (dibulatkan)" => $this->prediksiFix,
		];
	}
}