<?php include 'config/class.php'; ?>
<?php 

include('vendor/autoload.php'); // won't include it again in the following examples
 
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;
 
// ---------- Data ----------------
// data is taken from http://archive.ics.uci.edu/ml/datasets/SMS+Spam+Collection
// we use a part for training
if (file_exists('dataset_nlp')) {
			$dataset_nlp= file_get_contents('dataset_nlp');
			$dataset_nlp= json_decode($dataset_nlp);
		}
 
$tset = new TrainingSet(); // will hold the training documents
$tok = new WhitespaceTokenizer(); // will split into tokens
$ff = new DataAsFeatures(); // see features in documentation
 
// ---------- Training ----------------
foreach ($dataset_nlp as $d)
{
    $tset->addDocument(
        $d[0], // class
        new TokensDocument(
            $tok->tokenize($d[1]) // The actual document
        )
    );
}
 
$model = new FeatureBasedNB(); // train a Naive Bayes model
$model->train($ff,$tset);
 
 
// ---------- Classification ----------------
$cls = new MultinomialNBClassifier($ff,$model);
$correct = 0;
foreach ($dataset_nlp as $d)
{
    // predict if it is spam or ham
    $prediction = $cls->classify(
        array('wanita','pria','general'), // all possible classes
        new TokensDocument(
            $tok->tokenize($d[1]) // The document
        )
    );
    if ($prediction==$d[0])
        $correct ++;
    else {
    echo "<pre>";
    echo "$d[1]  : $d[0]";
    echo "</pre>";
    }
}
 
printf("Accuracy: %.2f\n", 100*$correct / count($dataset_nlp));
	file_put_contents('model_nlp', serialize($model));
 ?>
 