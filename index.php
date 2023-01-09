<?php
$filteredList = [];
$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];

foreach ($hotels as $element){
    if(!empty($_GET['parking']) || !empty($_GET['rating'])){
        $toPush = true;

        if(!empty($_GET['parking'])){
            if($element['parking'] != $_GET['parking']){
                    $toPush = false;
            }
        }

        if(!empty($_GET['rating'])){
            if($_GET['rating'] < 0){
                $_GET['rating'] = 0;
            }
            if($_GET['rating'] > 5){
                $_GET['rating'] = 5;
            }
            if($_GET['rating'] > $element['vote']){
                $toPush = false;
            }
        }

        if($toPush){
            $filteredList[] = $element;
        }
    }else{
        $filteredList = $hotels;
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <main class="container">
        <h1 class="text-center pt-3">Awesome Hotels Page</h1>

        <form class="py-5" action="" method="GET">
            <div class="row">
                <div class="col-6 ">
                    <label class="form-label">Parcheggio</label></br>
                    <input type="checkbox" name="parking" class="form-check-input">
                </div>
                <div class="col-6">
                    <label class="form-label">Rating</label>
                    <input name="rating" type="number" class="form-control">
                </div>
            </div>
            <button class="btn btn-secondary mt-3">Cerca</button>
        </form>


        <div class="row g-5">
            <?php foreach ($filteredList as $element) { ?>

                <div class="col-4">
                    <div class="card text-center">
                        <div class="card-header">
                            <h2><?php echo $element["name"] ?></h2>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title mb-3"><?php echo $element["description"] ?></h4>
                            <ul class="text-start">
                                <li>
                                    <p class="card-text">Distanza dal centro: <?php echo $element["distance_to_center"] ?>m</p>
                                </li>
                                <li>
                                    <p class="card-text">Parcheggio:
                                        <?php
                                        if ($element["parking"]) {
                                            echo '<i class="fa-regular fa-circle-check text-success"></i>';
                                        } else {
                                            echo '<i class="fa-regular fa-circle-xmark text-danger"></i>';
                                        }
                                        ?>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer text-muted">
                            <?php
                            for ($i = 0; $i < $element["vote"]; $i++) {
                                echo '<i class="fa-solid fa-star"></i>';
                            }
                            for ($i = 0; $i < (5 - $element["vote"]); $i++) {
                                echo '<i class="fa-regular fa-star"></i>';
                            }
                            ?>
                        </div>
                    </div>
                </div>

            <?php }; ?>
        </div>
    </main>
</body>

</html>