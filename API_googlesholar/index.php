<?php
if (isset($_POST["cari"])) { //metode untuk mulai mencari data
    $cari = $_POST["cari"];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://serpapi.com/search?engine=google_scholar&api_key=21ae7b810054e4461501a3fe14bcdbecfe96f0ceeaba2ddbba81f92088b8ff76&q=" . $cari); //mengambil API dari google scholar
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($output); //output berupa json yang di tempilkan
    $data = $data->organic_results;

    // foreach ($data as $val) {
    //     echo "title: " . $val->title . "<br>";
    //     echo "snippet: " . $val->snippet . "<br>";
    //     echo "summary: " . $val->publication_info->summary . "<br><br>";
    // }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container ">
        <br>
        <div class="row d-flex justify-content-center mt-3 "><img src="gs2.png" alt="" height="80"></div>

        <div class="row d-flex justify-content-center mt-3">
            <div class="col-6">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="cari" placeholder="Masukan Judul"
                            aria-label="Masukan Judul" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (isset($_POST["cari"])) : ?>
        <h6 class="text-center mb-3">Menampilkan hasil dari : <strong
                class="text-success">"<?= $_POST["cari"] ?>"</strong></h6>
        <?php endif; ?>


        <?php if (isset($_POST["cari"])) : ?>
        <?php foreach ($data as $val) : ?>
        <div class="row">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title"><?= $val->title ? $val->title : "" ?></h5>
                    <h6 class="card-subtitle mb-2 text-primary">
                        <?= $val->publication_info->summary ? $val->publication_info->summary : ""  ?></h6>
                    <p class="card-text"><?= $val->snippet ? $val->snippet : "" ?></p>
                    <!-- menampilakn data berupa title, publication_info summar, dan snippet -->
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>