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
	

	public function __construct($jumlahPermintaan, $jumlahSisa = 0, $jumlahKekurangan = 0) 
	{
		$this->jumlahPermintaan = $jumlahPermintaan;
		$this->jumlahSisa = $jumlahSisa;
		$this->jumlahKekurangan = $jumlahKekurangan;

		$this->fuzzifikasi();
		$this->implikasi();
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
		if($this->jumlahSisa <= $this->_batasSisaSedikit) {
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
		if($this->jumlahKekurangan <= $this->_batasKekuranganSedikit) {
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

	public function implikasiR1() 
	{
		$this->hasilImplikasiR1 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzySisaSedikit);
	}

	public function implikasiR2() 
	{
		$this->hasilImplikasiR2 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzySisaSedang);
	}

	public function implikasiR3() 
	{
		$this->hasilImplikasiR3 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzySisaBanyak);
	}

	public function implikasiR4() 
	{
		$this->hasilImplikasiR4 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzySisaSedikit);
	}

	public function implikasiR5() 
	{
		$this->hasilImplikasiR5 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzySisaSedang);
	}

	public function implikasiR6() 
	{
		$this->hasilImplikasiR6 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzySisaBanyak);
	}

	public function implikasiR7() 
	{
		$this->hasilImplikasiR7 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzySisaSedikit);
	}

	public function implikasiR8() 
	{
		$this->hasilImplikasiR8 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzySisaSedang);
	}

	public function implikasiR9() 
	{
		$this->hasilImplikasiR9 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzySisaBanyak);
	}

	public function implikasiR10() 
	{
		$this->hasilImplikasiR10 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzyKekuranganSedikit);
	}

	public function implikasiR11() 
	{
		$this->hasilImplikasiR11 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzyKekuranganSedang);
	}

	public function implikasiR12() 
	{
		$this->hasilImplikasiR12 = min($this->hasilFuzzyPermintaanSedikit, $this->hasilFuzzyKekuranganBanyak);
	}

	public function implikasiR13() 
	{
		$this->hasilImplikasiR13 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzyKekuranganSedikit);
	}

	public function implikasiR14() 
	{
		$this->hasilImplikasiR14 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzyKekuranganSedang);
	}

	public function implikasiR15() 
	{
		$this->hasilImplikasiR15 = min($this->hasilFuzzyPermintaanSedang, $this->hasilFuzzyKekuranganBanyak);
	}

	public function implikasiR16() 
	{
		$this->hasilImplikasiR16 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzyKekuranganSedikit);
	}

	public function implikasiR17() 
	{
		$this->hasilImplikasiR17 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzyKekuranganSedang);
	}

	public function implikasiR18() 
	{
		$this->hasilImplikasiR18 = min($this->hasilFuzzyPermintaanBanyak, $this->hasilFuzzyKekuranganBanyak);
	}
}