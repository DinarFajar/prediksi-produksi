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

	public function __construct($jumlahPermintaan, $jumlahSisa = 0, $jumlahKekurangan = 0) 
	{
		$this->jumlahPermintaan = $jumlahPermintaan;
		$this->jumlahSisa = $jumlahSisa;
		$this->jumlahKekurangan = $jumlahKekurangan;

		$this->fuzzifikasi();
		$this->implikasi();
		$this->komposisi();
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
		];
	}
}