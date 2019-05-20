<?php 
session_start(); 
date_default_timezone_set("Asia/Jakarta");
// error_reporting(0);

include "vendor/autoload.php";
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;

$mysqli=new mysqli("localhost","root","","crawling");


class utama
{
	public $koneksi;

	function __construct($mysqli)
	{
		$this->koneksi=$mysqli;
	}
}
$utama = new utama($mysqli);

class pencarian extends utama
{

	function tampil()
	{
		$ambil= $this->koneksi->query("SELECT * FROM pencarian ORDER BY id_pencarian DESC");

		while($pecah=$ambil->fetch_assoc())
		{
			$data[]=$pecah;
		}
		return $data;	

	}
	function detail($id_pencarian)
	{
		$ambil= $this->koneksi->query("SELECT * FROM pencarian WHERE id_pencarian='$id_pencarian'");

		$pecah=$ambil->fetch_assoc();
		return $pecah;	

	}
	function tambah($tgl_pencarian,$kata_pencarian,$lama_pencarian)
	{
		$data['hasil']['bukalapak'] =$_SESSION['bukalapak'];
		$data['hasil']['shopee'] =$_SESSION['shopee'];
		$data['hasil']['lazada'] =$_SESSION['lazada'];
		

		// Menyimpan hasil pencarian
		foreach ($data['hasil'] as $key_0 => $value_0) {
			foreach ($value_0 as $key1 => $value1) {
				foreach ($value1 as $key2 => $value2) {
					foreach ($value2 as $key3 => $value3) {
						$b[$key_0][$key1][$key2][$key3]['foto'] = $value3['foto'];
						$b[$key_0][$key1][$key2][$key3]['link'] = $value3['link'];
						$b[$key_0][$key1][$key2][$key3]['nama'] = $value3['nama'];

						$array_harga = explode("Rp",$value3['harga']); // Menentukan ada diskon apa enggak
						if ($key_0=="bukalapak") {
							$regex_harga="/[^>]*span class='amount[^>]*>(.*?)<\/\s*span/";	
							if (isset($array_harga[2])) {
								preg_match_all($regex_harga, $array_harga[2],$hasil);
								$a=str_replace(".", "", $hasil[1][0]);
							} else
							{
								preg_match_all($regex_harga, $array_harga[1],$hasil);
								$a=str_replace(".", "", $hasil[1][0]);
							}
						} 
						elseif ($key_0=="shopee") {
							$regex_harga = '/[^>]*span class="_341bF0[^>]*>(.*?)<\/\s*span/';
							if (isset($array_harga[2])) {
								preg_match_all($regex_harga, $array_harga[2],$hasil);
								$a=str_replace(".", "", $hasil[1][0]);
							} else
							{
								preg_match_all($regex_harga, $array_harga[1],$hasil);
								$a=str_replace(".", "", $hasil[1][0]);
							}
						}
						elseif ($key_0=="lazada") {
							$a=str_replace(".", "", substr($value3['harga'], 2));
						}

						$b[$key_0][$key1][$key2][$key3]['harga'] = $a;
						
					}
				}
			}
		}
		
		$data_encode = json_encode($b);

		// menyimpan hasil dataset
		// Bagian Kategorisasi Ambil datasetnya terlebih dahulu

		// kalo mau search di komen, tapi kalo mau buat dataset dihidupkan
		// if (file_exists('dataset_nlp')) {
		// 	$dataset_nlp= file_get_contents('dataset_nlp');
		// 	$dataset_nlp= json_decode($dataset_nlp);
		// }
		// else
		// {
		// 	$dataset_nlp=[];
		// }

// 		$dataset_nlp=[]; // kalo mau buat dataset -> maka di komen , kalo mau searchh-> di hidupkan 
// 		foreach ($data['hasil'] as $key_0 => $value_0) {
// 			foreach ($value_0 as $key1 => $value1) {
// 				foreach ($value1 as $key2 => $value2) {
// 					foreach ($value2 as $key3 => $value3) {
// 						$dataset[$key_0][$key1][$key2][$key3]['kategori'] =['wanita',$value3['nama']] ;
// 						$dataset[$key_0][$key1][$key2][$key3]['kategori'] =['pria',$value3['nama']] ;
// 						$dataset[$key_0][$key1][$key2][$key3]['kategori'] =['general',$value3['nama']] ;

// 						$dataset_nlp[]=['wanita',$value3['nama']];
// 						$dataset_nlp[]=['pria',$value3['nama']];
// 						$dataset_nlp[]=['general',$value3['nama']];
// 					}
// 				}
// 			}
// 		}
// 		// file_put_contents('dataset_nlp', json_encode($dataset_nlp));// kalo mau searching di komen
		
// $tset = new TrainingSet(); // will hold the training documents
// $tok = new WhitespaceTokenizer(); // will split into tokens
// $ff = new DataAsFeatures(); // see features in documentation

// // ---------- Training ----------------
// foreach ($dataset_nlp as $d)
// {
// 	$tset->addDocument(
// 		$d[0], // class
// 		new TokensDocument(
// 		$tok->tokenize($d[1]) // The actual document
// 	)
// 	);
// }
// if (file_exists('model_nlp')) {
// 	// echo "Tidak Membuat Model baru";
// 	$model= file_get_contents('model_nlp');
// 	$model= unserialize($model);
// }
// else
// {
// 	// echo "Membuat Model baru";
// 	$model = new FeatureBasedNB();
// } 	
//  // train a Naive Bayes model
// // $model->train($ff,$tset);
// //Classification
// $cls = new MultinomialNBClassifier($ff,$model);
// $correct = 0;
// foreach ($dataset_nlp as $d)
// {
//     // predict if it is spam or ham
// 	$prediction = $cls->classify(
//         array('wanita','pria','general'), // all possible classes
//         new TokensDocument(
//             $tok->tokenize($d[1]) // The document
//         )
//     );
// 	if ($prediction==$d[0])
// 		$correct ++;
// }
// 	file_put_contents('model_nlp', serialize($model));


// 	echo "<pre>";
// 	printf("Accuracy: %.2f\n", 100*$correct / count($dataset_nlp));
// 	$hasil_dataset=json_encode($dataset_nlp);
// 	echo "</pre>";
	


$this->koneksi->query("INSERT INTO pencarian (tgl_pencarian,kata_pencarian,lama_pencarian,hasil_pencarian) VALUES('$tgl_pencarian','$kata_pencarian','$lama_pencarian','$data_encode')") or die(mysqli_error($this->koneksi));
}


function jumlah_pertanggal($tahunbulan)
{
	$ambil = $this->koneksi->query("SELECT * FROM pencarian WHERE tgl_pencarian LIKE '%$tahunbulan%'");
	while ( $pecah = $ambil->fetch_assoc()) {
		$data[]=$pecah;
	}
	return $data;
}
function hapuspencarian($id_pencarian)
{
	$this->koneksi->query("DELETE FROM pencarian WHERE id_pencarian='$id_pencarian'");
}
}
$pencarian= new pencarian($mysqli);



class kategori extends utama
{
	function tampil()
	{
		$ambil=$this->koneksi->query("SELECT * FROM kategori ORDER BY id_kategori DESC");

		while ($pecah=$ambil->fetch_assoc()) {
			$data[]=$pecah;
		}
		return $data;
	}

	//Fungsi ini sekaligus update data
	function tambah()
	{
		foreach ($_SESSION['bukalapak'] as $key => $value) {
			foreach ($value as $key2 => $value2) {
				foreach ($value2 as $key3 => $value3) {
					$link_produk = substr($value3['link'], 29);
					$pecah = explode("/", $link_produk);
					$banyak_kategori=$pecah[0];
					$kategori[$banyak_kategori]=$banyak_kategori;
				}

			}
		}
		
		foreach ($kategori as $key => $value) {
			//Mengecek apakah kategori sudah ada
			$ambil=$this->koneksi->query("SELECT * FROM kategori WHERE nama_kategori='$value'");
			//Hitung $ambil
			$hitung=mysqli_num_rows($ambil);
			if ($hitung>0) {
				//Mengupdate jumlah kategorinya
				$pecah=$ambil->fetch_assoc();
				$jumlah_lama = $pecah['jumlah_kategori'];
				$jumlah_baru = $jumlah_lama+1;
				$id_kategori = $pecah['id_kategori'];
				$this->koneksi->query("UPDATE kategori SET jumlah_kategori='$jumlah_baru' WHERE id_kategori='$id_kategori'") or die(mysql_error($this->koneksi));
			} else {
				//Menambah Kategori
				$this->koneksi->query("INSERT INTO kategori (nama_kategori,jumlah_kategori) VALUES('$value','1')");

			}


		}

	}

	function hapuskategori($id_kategori)
	{
		$this->koneksi->query("DELETE FROM kategori WHERE id_kategori='$id_kategori'");
	}
	
}
$kategori=new kategori($mysqli);



class admin extends utama
{
	function login($username,$password)
	{
		//intinya login adalah mencocokkan data dari form ke DB. Lalu di cocokkan data dari form disimpan ke dalam session

		//1. Mencocokkan data
		$ambil=$this->koneksi->query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
		// Kita hitung data yang berhasil
		$hitung=mysqli_num_rows($ambil);
		//$hitung bisa bernilai 1 atau 0
		//jika bernilai 1, maka lanjut
		if ($hitung==1)
		{
			$pecah=$ambil->fetch_assoc();
			$_SESSION['admin']=$pecah;
			return "sukses";
		} else 
		{
			return "gagal";
		}
	}

	function ubah_profil($username,$password,$id_admin)
	{
		//Mengubah di database
		$this->koneksi->query("UPDATE admin SET username='$username', password='$password',id_admin='$id_admin'");
		//Mengubah sessionnya

		$_SESSION['admin']['username']=$username;
		$_SESSION['admin']['password']=$password;

	}
}


$admin=new admin($mysqli);



class crawling extends utama
{
	public $html;
	public $batas=8;

	function ambil_halaman($url,$return=false)
	{
			//fungsi ambil_halaman ini untuk mendapatkan halaman web yanng akan discrap, lalu hasil akhirnya diberikan ke atribut html.

			//Ada 4 langkah penggunakan Curl di PHP

			// 1. Inisialisasi
			// 2. Set Option
			// 3. Eksekusi Curl/Ambil Halamannya
			// 4. tutup Curl


		//. Langkah 1 .inisialisasi
		$ch = curl_init();

		//. Kemudian 2. Set Option

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_REFERER, "https://www.google.com/");
		curl_setopt($ch, CURLOPT_USERAGENT, "Googlebot/2.1 (+http://www.google.com/bot.html");
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);


		//3. EKSEKUSI Curl

		$output = curl_exec($ch);
		// || artinya atau
		if (curl_error($ch)|| curl_errno($ch))
		{
			throw new Exception("Error Getting Data", E_USER_ERROR);

		}else
		{
			if ($return==true)
			{
				return $output;
			} else
			{
				$this->html=$output;
			} 

		}
		//4. Tutup curl
		curl_close($ch);

	}
	function ambil_bukalapak()
	{
		// Di skrip ini bakal diambil data yang dibutuhkan saja
		//1. Membuat inisialisasi variabel

		$semua['nama']=array();
		$semua['link']=array();
		$semua['harga']=array();
		$semua['foto']=array();


		//2. Menaruh html (yang berisi skrip 1 halaman bukalapak ke dalam $data)
		$data=$this->html;

		//3. Mengambil judulnya. dengan cara menulis reguler expression yang sesuai di url
		//Gunakan fungsi php preg_match_all
		//preg_match_all($a,$b,$c)
		//$a : adalah regexnya
		//$b : adalah kumpulan stringnya
		//$c: adalah hasilnya. Hasil disini berupa array multi dimensi

		$regex_judul='/<\s*a title="[^>]*>(.*?)<\/\s*a>/';
		preg_match_all($regex_judul, $data, $nama_produk);
		$regex_link_produk='/class="product__name[^>]*" href="(.*?)">/';
		preg_match_all($regex_link_produk, $data, $link_produk);
		$regex_harga='/<\s*div class="product-price[^>]*>(.*?)<\/\s*div>/';
		preg_match_all($regex_harga, $data, $harga);
		$regex_foto='/<\s*img[^>]*>(.*?)/';
		preg_match_all($regex_foto, $data, $foto );

		
		// 4. Mengolah arraynya 
		$semua['nama']=$nama_produk[1];
		$semua['link']=$link_produk[1];
		$semua['harga']=$harga[1];



		foreach ($foto[0]as $key => $value)
		{
			$doc = new DOMDocument(); // Membuat objek baru
			$doc->loadHTML($value); // Memuat html string bernilai value 
			$imageTags = $doc->getElementsByTagName('img'); //Mencari semua elemen berdasarkan nama lokal yang diberikan yaitu img. 
			$img="";
			foreach ($imageTags as $tag ) {
				if(!empty($tag->getAttribute('data-src')))
				{
					$img=$tag->getAttribute('data-src');
				}
			}
			if (!empty($img)) {
				$semua['foto'][]=$img;
			}
		}

		$hasil=array();
		foreach ($semua['link'] as $no => $isi) 
		{
			$hasil[$no]['link']="https://www.bukalapak.com/".$isi;
			$hasil[$no]['nama']=$semua['nama'][$no];;
			$hasil[$no]['harga']=$semua['harga'][$no];
			$hasil[$no]['foto']=$semua['foto'][$no];


		}
		return $hasil;
		
	}


	function ambil_shopee()
	{
		$semua['foto']=array();
		$semua['nama']=array();
		$semua['link']=array();
		$semua['harga']=array();

		$data=$this->html;

		$regex_foto='/class="_1T9dHf[^>]*" style="(.*?)>/';
		preg_match_all($regex_foto, $data, $foto);
		$regex_nama='/div class="_1NoI8_[^>]*>(.*?)<\/\s*div/';
		preg_match_all($regex_nama, $data, $nama);
		$regex_link='/class="col-xs-2-4 shopee-search-item-result__item"><div><a href="(.*?)">/';
		preg_match_all($regex_link, $data, $link);
		if (empty($link[1])) {
			$regex_link='/class="col-md-2 col-xs-4 shopee-search-recommendation__item"><div><a href="(.*?)">/';
			preg_match_all($regex_link, $data, $link);
		}

		$regex_harga='/<\s*div class="_1w9jLI _37ge-4[^>]*>(.*?)<\/\s*div>/';
		preg_match_all($regex_harga, $data, $harga);

		foreach ($foto[1] as $key => $value) {
			$semua['foto'][$key]=substr($value, 21,64);
		}
		$semua['link']=$link[1];
		$semua['nama']=$nama[1];
		$semua['harga']=$harga[1];


		$hasil=array();
		foreach ($semua['foto'] as $no => $value) {
			$hasil[$no]['foto']=$value;
			$hasil[$no]['link']="https://shopee.co.id".$semua['link'][$no];
			$hasil[$no]['nama']=$semua['nama'][$no];
			$hasil[$no]['harga']=$semua['harga'][$no];
		}
		return $hasil;

	}
	function ambil_lazada()
	{

		$semua['foto']=array();
		$semua['nama']=array();
		$semua['link']=array();
		$semua['harga']=array();
		$data=$this->html;

		$dom= new DOMDocument();
		libxml_use_internal_errors(1);
		$dom->loadHTML($data);
		$xpath = new DOMXpath($dom);
		$script = $dom->getElementsByTagName('script');
		$script = $xpath->query('//script[@type="application/ld+json"]');
		$json= $script->item(0)->nodeValue;
		foreach ($script as $key) {
			$nv = $key->nodeValue;
		}
		$data_decode = json_decode($nv,true);
		foreach ($data_decode['itemListElement'] as $key => $value) {
			$semua['foto'][$key]=$value['image'];
		}


		$regex_nama='/<div class="c16H9d"><a age="0"[^>]*>(.*?)<\/\s*div>/';
		preg_match_all($regex_nama, $data, $nama);
		$regex_link='/<div class="c16H9d"><a age="0" href="(.*?)<\/\s*div>/';
		preg_match_all($regex_link, $data, $link);
		$regex_harga='/<div class="c3gUW0"><span class="c13VH6">(.*?)<\/\s*div>/';
		preg_match_all($regex_harga, $data, $harga);

		
		$semua['link']=$link[1];
		$semua['nama']=$nama[1];
		$semua['harga']=$harga[1];


		$hasil=array();
		foreach ($semua['link'] as $no => $value) {
			$pecah_link= explode('"', $value);
			$hasil[$no]['link']="https:".$pecah_link[0];
			$hasil[$no]['nama']=$semua['nama'][$no];
			$hasil[$no]['harga']=$semua['harga'][$no];
			$hasil[$no]['foto']=$semua['foto'][$no];
		}
		return $hasil;

	}

	function tampil_bukalapak($hasil_bukalapak)
	{
		//Membuat filter data yaitu hanya yang mengandung kata di kata kunci sepatu
		foreach ($hasil_bukalapak as $page => $value) {
			foreach ($value as $key => $value2) {
				if (stristr($value2['nama'],'sepatu') AND !stristr($value2['nama'],'tas') AND !stristr($value2['nama'],'baju')) {
					$hasil_bukalapak_filter[$page][$key]=$value2;
				}
			}
		}
		
		if (isset($hasil_bukalapak_filter)) {
			//Mencari Jumlah produk perhalaman
			foreach ($hasil_bukalapak_filter as $key => $value) {
				$jumlah_perhalaman_bukalapak[$key]=count($value);
			}
			//mencari jumlah produk semuanya
			$jumlah_semua_bukalapak=0;
			foreach ($jumlah_perhalaman_bukalapak as $key => $jumlah) {
				$jumlah_semua_bukalapak+=$jumlah;  
			}
			if($jumlah_semua_bukalapak>0){
				//Kemudian menentukan batas produk
				$batas=$this->batas;
				//Mencari jumlah halaman 
				$pagination_bukalapak=ceil($jumlah_semua_bukalapak/$batas);
				//Mengubah array yang mengandung halaman menjadi tidak mengandung halaman langsung ke produknya
				$no=0;
				foreach ($hasil_bukalapak_filter as $halaman => $value_perh) {
					foreach ($value_perh as $key_p => $value_p) {
						$data_produk_bukalapak[$no]=$value_p;
						$no+=1;
					}
				}

				//Membuat kelompok produk pada setiap page
				if (!isset($_GET['halaman_bukalapak'])) {
					for ($i=0; $i <=7 ; $i++) { 
						$kelompok_bukalapak[$i]=$data_produk_bukalapak[$i];
					}
				} else{
					$hp=$_GET['halaman_bukalapak'];
					$dari=($hp-1)*$batas;
					$sampai=$dari+($batas-1);
					for ($i=$dari; $i <=$sampai ; $i++) { 
						if (isset($data_produk_bukalapak[$i])) {
							$kelompok_bukalapak[$i]=$data_produk_bukalapak[$i];
						}
					}
				}
				$data_return['pagination']=$pagination_bukalapak;
				$data_return['kelompok_bukalapak']=$kelompok_bukalapak;
				return $data_return;

			

			} 	
		}
		
	}

	function tampil_shopee($hasil_shopee)
	{
		foreach ($hasil_shopee as $page => $value) {
			foreach ($value as $key => $value2) {
				if (stristr($value2['nama'],'sepatu' ) AND !stristr($value2['nama'],'tas' ) AND !stristr($value2['nama'],'baju' )) {
					$hasil_shopee_filter[$page][$key]=$value2;
				}
			}
		}
		if (isset($hasil_shopee_filter)) {
			//Mencari Jumlah produk perhalaman
			foreach ($hasil_shopee_filter as $key => $value) {
				$jumlah_perhalaman_shopee[$key]=count($value);
			}

		//mencari jumlah produk semuanya
			$jumlah_semua_shopee=0;
			foreach ($jumlah_perhalaman_shopee as $key => $jumlah) {
				$jumlah_semua_shopee+=$jumlah;  
			}

		//Kemudian menentukan batas produk
			if($jumlah_semua_shopee>0){
				$batas=$this->batas;
		//Mencari jumlah halaman 
				$pagination_shopee=ceil($jumlah_semua_shopee/$batas);
		//Mengubah array yang mengandung halaman menjadi tidak mengandung halaman->langsung ke produknya
				$no=0;
				foreach ($hasil_shopee_filter as $halaman => $value_perh) {
					foreach ($value_perh as $key_p => $value_p) {
						$data_produk_shopee[$no]=$value_p;
						$no+=1;
					}
				}

		//Membuat kelompok produk pada setiap page
				if (!isset($_GET['halaman_shopee'])) {
					for ($i=0; $i <=7 ; $i++) { 
						$kelompok_shopee[$i]=$data_produk_shopee[$i];
					}
				} else{
					$hp=$_GET['halaman_shopee'];
					$dari=($hp-1)*$batas;
					$sampai=$dari+($batas-1);
					for ($i=$dari; $i <=$sampai; $i++) { 
						if (isset($data_produk_shopee[$i])) {
							$kelompok_shopee[$i]=$data_produk_shopee[$i];
						}
					}
				}
				$data_return['pagination']=$pagination_shopee;
				$data_return['kelompok_shopee']=$kelompok_shopee;
				return $data_return;


			} 	
		}

		
	}
	function tampil_lazada($hasil_lazada)
	{
		foreach ($hasil_lazada as $page => $value) {
			foreach ($value as $key => $value2) {
				if (stristr($value2['nama'],'sepatu' ) AND !stristr($value2['nama'],'tas' ) AND !stristr($value2['nama'],'baju' )) {
					$hasil_lazada_filter[$page][$key]=$value2;
				}
			}
		}
		if (isset($hasil_lazada_filter)) {
			//Mencari Jumlah produk perhalaman
			foreach ($hasil_lazada_filter as $key => $value) {
				$jumlah_perhalaman_lazada[$key]=count($value);
			}

		//mencari jumlah produk semuanya
			$jumlah_semua_lazada=0;
			foreach ($jumlah_perhalaman_lazada as $key => $jumlah) {
				$jumlah_semua_lazada+=$jumlah;  
			}

			if ($jumlah_semua_lazada>0) {
			//Kemudian menentukan batas produk
				$batas=$this->batas;
		//Mencari jumlah halaman 
				$pagination_lazada=ceil($jumlah_semua_lazada/$batas);
		//Mengubah array yang mengandung halaman menjadi tidak mengandung halaman->langsung ke produknya
				$no=0;
				foreach ($hasil_lazada_filter as $halaman => $value_perh) {
					foreach ($value_perh as $key_p => $value_p) {
						$data_produk_lazada[$no]=$value_p;
						$no+=1;
					}
				}



		//Membuat kelompok produk pada setiap page
				if (!isset($_GET['halaman_lazada'])) {
					for ($i=0; $i <=7 ; $i++) { 
						$kelompok_lazada[$i]=$data_produk_lazada[$i];
					}
				} else{
					$hp=$_GET['halaman_lazada'];
					$dari=($hp-1)*$batas;
					$sampai=$dari+($batas-1);
					for ($i=$dari; $i <=$sampai; $i++) { 
						if (isset($data_produk_lazada[$i])) {
							$kelompok_lazada[$i]=$data_produk_lazada[$i];
						}
					}
				}
				$data_return['pagination']=$pagination_lazada;
				$data_return['kelompok_lazada']=$kelompok_lazada;
				return $data_return;
			}	
		}
		
	}

}
$crawling = new crawling($mysqli);
?>

