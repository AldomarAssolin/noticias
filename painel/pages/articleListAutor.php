<?php

// Carregar o arquivo JSON
$jsonData = file_get_contents(INCLUDE_PATH . 'cors/articlesData.json');

//var_dump($jsonData);

// Decodificar o JSON para um array associativo
$articles = json_decode($jsonData, true);

//Iterar sobre os artigos e exibi-los
foreach ($articles['artigos'] as $article) {
    $article['title'];
    $article['author'];
    $article['date'];
    $article['content'];
}


?>




<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0"><span class="lead fs-3 h2 ls-5">Lista de Artigos de</span> <b><?php echo $article['author'] == 'Aldomar Assolin' ? $article['author'] : 'Aldomar Assolin' ?></b></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1 d-none">
                    This week
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr class="table-success">
                    <td>Autor</td>
                    <td>Título</td>
                    <td>Data</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplo de linha de artigo -->
                <?php
                foreach ($articles['artigos'] as $article) {
                    if($article['author'] == "Aldomar Assolin"){
                    echo "<tr>";
                    echo "<td>{$article['author']}</td>";
                    echo "<td>{$article['title']}</td>";
                    echo "<td>{$article['date']}</td>";
                    echo "<td class='text-end'>";
                    echo "<button class='btn btn-primary btn-sm my-1 my-md-0'>";
                    echo "<svg class='bi'>";
                    echo "<use xlink:href='#folder-symlink-fill' />";
                    echo "</svg>";
                    echo "</button>";
                    echo "<button class='btn btn-warning btn-sm my-1 my-md-0 mx-lg-2'>";
                    echo "<svg class='bi'>";
                    echo "<use xlink:href='#pencil' />";
                    echo "</svg>";
                    echo "</button>";
                    echo "<button class='btn btn-danger btn-sm my-1 my-md-0'>";
                    echo "<svg class='bi'>";
                    echo "<use xlink:href='#trash' />";
                    echo "</svg>";
                    echo "</button>";
                    echo "</td>";
                    echo "</tr>";
                    echo "";

                    }
                }
                ?>
                <!-- Fim do exemplo de linha de artigo -->
            </tbody>
        </table>
    </div>


</section>