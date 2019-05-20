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