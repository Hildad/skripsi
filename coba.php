<?php 
include "config/class.php";

// error_reporting(0);

include "vendor/autoload.php";
use NlpTools\Tokenizers\WhitespaceTokenizer;
use NlpTools\Models\FeatureBasedNB;
use NlpTools\Documents\TrainingSet;
use NlpTools\Documents\TokensDocument;
use NlpTools\FeatureFactories\DataAsFeatures;
use NlpTools\Classifiers\MultinomialNBClassifier;


$hasil_kategori=$kategorisasi->nlp();


?>
<div class="table-responsive">
    <table class="table table-bordered" id="thetable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori </th>
                <th>Akurasi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil_kategori as $key => $value): ?> 
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $value[0]; ?></td>
                <td><?php echo $value[1]; ?></td>
                
            </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</div>

