<?php
// Example data array
$articles = [
    ['author' => 'Aldomar Assolin', 'title' => 'No mundo da Inteligência Artificial', 'date' => '2023-10-01'],
    ['author' => 'Maria Silva', 'title' => 'Avanços na Tecnologia', 'date' => '2023-09-15'],
    ['author' => 'João Souza', 'title' => 'O Futuro da Robótica', 'date' => '2023-08-20'],
];

$authors = [
    [
        'author' => 'Aldomar Assolin',
        'posts' => [
            ['title' => 'No mundo da Inteligência Artificial', 'date' => '2023-10-01'],
            ['title' => 'Aprendizado de Máquina', 'date' => '2023-09-25'],
            ['title' => 'Redes Neurais', 'date' => '2023-09-10']
        ]
    ]
    // [
    //     'author' => 'Maria Silva',
    //     'posts' => [
    //         ['title' => 'Avanços na Tecnologia', 'date' => '2023-09-15'],
    //         ['title' => 'Internet das Coisas', 'date' => '2023-09-05'],
    //         ['title' => 'Big Data', 'date' => '2023-08-30']
    //     ]
    // ],
    // [
    //     'author' => 'João Souza',
    //     'posts' => [
    //         ['title' => 'O Futuro da Robótica', 'date' => '2023-08-20'],
    //         ['title' => 'Automação Industrial', 'date' => '2023-08-10'],
    //         ['title' => 'Inteligência Artificial na Medicina', 'date' => '2023-07-25']
    //     ]
    // ]
];

$articles = [];
foreach ($authors as $author) {
    foreach ($author['posts'] as $post) {
        $articles[] = [
            'author' => $author['author'],
            'title' => $post['title'],
            'date' => $post['date']
        ];
    }
}

?>


<section class="list-user mx-md-3">
    <div class="">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h3 mb-0"><span class="lead fs-3 h2 ls-5">Lista de Artigos de</span> <b><?php echo $author['author'] ?></b></h1>
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
                <?php
                
                foreach ($articles as $article) {
                
                    echo "<tr>";
                    echo "<td>{$article['author']}</td>";
                    echo "<td>{$article['title']}</td>";
                    echo "<td>{$article['date']}</td>";
                    echo '<td class="text-end">';
                    echo '<button class="btn btn-primary btn-sm my-1 my-lg-0">';
                    echo '<svg class="bi">';
                    echo '<use xlink:href="#pencil" />';
                    echo '</svg>';
                    echo '</button>';
                    echo '<button class="btn btn-danger btn-sm my-1 my-lg-0 mx-0 mx-lg-2">';
                    echo '<svg class="bi">';
                    echo '<use xlink:href="#trash" />';
                    echo '</svg>';
                    echo '</button>';
                    echo '</td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>

