<?php

function displayProducts($categoriaFilter = null, $idFilter = null, $searchQuery = null, $sortOption = null) {
    $produtos = $_SESSION['produtos'];
    
    if ($categoriaFilter) {
        $produtos = array_filter($produtos, function($produto) use ($categoriaFilter) {
            return $produto['categoria'] === $categoriaFilter;
        });
    }

    if ($idFilter) {
        echo '$idFilter';
        $produtos = array_filter($produtos, function($produto) use ($idFilter) {
            return $produto['id'] === $idFilter;
        });
    }

    if ($searchQuery) {
        $produtos = array_filter($produtos, function($produto) use ($searchQuery) {
            return (stripos($produto['nome'], $searchQuery) !== false || stripos($produto['desc'], $searchQuery) !== false || stripos($produto['categoria'], $searchQuery) !== false);
        });
    }

    if ($sortOption) {
        echo '$sortOption';
        usort($produtos, function($a, $b) use ($sortOption) {
            switch ($sortOption) {
                case 'popularity':
                    return $b['popularity'] <=> $a['popularity'];
                case 'alphabetic':
                    return strcmp($a['nome'], $b['nome']);
                case 'fantastic':
                    return $b['fantastic'] <=> $a['fantastic'];
                default:
                    return 0;
            }
        });
    }

    //var_dump($produtos);

    foreach ($produtos as $produto): ?>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="rounded position-relative fruite-item" >
                <div class="fruite-img" onclick="window.location.href='shop-detail.php?id=<?=$produto['id']?>'">
                    <img src="<?=$produto['image']?>" class="img-fluid w-100 rounded-top" alt="">
                </div>
                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?=$produto['categoria']?></div>
                
                <div class="p-4 rounded-bottom">
                    <h4><?=$produto['nome']?></h4>
                    <p><?=$produto['desc']?></p>
                    <div class="d-flex justify-content-between flex-lg-wrap">
                        <p class="text-dark fs-5 fw-bold mb-0">R$<?=$produto['preco']?></p>
                        <a data-product-id="<?=$produto['id']?>" class="add-to-cart btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                    </div>  
                </div>
            </div>
        </div>
    <?php endforeach;

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

}
    
    include 'includes/ajax.php';
    
    $categoriaFilter = $_GET['categoria'] ?? null;
    $searchQuery = $_GET['search'] ?? null;
    $sortOption = $_GET['sort'] ?? null;
    
    ?>
    
    <!DOCTYPE html>
    <html lang="en">

        <?php include 'header.php'; ?>
        
        <body>
    
            <!-- Single Page Header start -->
            <div class="container-fluid page-header py-5">
                <h1 class="text-center text-white display-6">Shop</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-white">Shop</li>
                </ol>
            </div>
            <!-- Single Page Header End -->
    
    
            <!-- Fruits Shop Start-->
            <div class="container-fluid fruite py-5">
                <div class="container py-5">
                    <h1 class="mb-4">Livraria Batata Shop</h1>
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <div class="col-xl-3">
                                    <form method="GET" action="shop.php" class="input-group w-100 mx-auto d-flex">
                                        <input type="search" name="search" class="form-control p-3" placeholder="procurar" aria-describedby="search-icon-1">
                                        <input type = "submit" id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></input>
                                    </form>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-xl-3">
                                    <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                        <label for="sort">Default Sorting:</label>
                                        <select id="sort" name="sort" class="border-0 form-select-sm bg-light me-3" form="sortForm">
                                            <option value="">Nothing</option>
                                            <option value="popularity">Popularity</option>
                                            <option value="alphabetic">Alphabetic</option>
                                            <option value="fantastic">Fantastic</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4">
                                <div class="col-lg-3">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                        <div class="mb-4">
                                            <h4>Categorias</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="shop.php?categoria=livro"><i class="fas fa-book me-2"></i>Livros</a> <span>(<?=5?>)</span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="d-flex justify-content-between fruite-name">
                                                        <a href="shop.php?categoria=material escolar"><i class="fas fa-pencil-alt me-2"></i>Materiais</a> <span>(<?=2?>)</span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <h4 class="mb-2">Price</h4>
                                                <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="500" value="0" oninput="amount.value=rangeInput.value">
                                                <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <h4>Additional</h4>
                                                <div class="mb-2">
                                                    <input type="radio" class="me-2" id="Categories-1" name="Categories-1" value="Fantasia">
                                                    <label for="Categories-1"> Fantasia</label>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="radio" class="me-2" id="Categories-2" name="Categories-1" value="Política">
                                                    <label for="Categories-2"> Política</label>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="radio" class="me-2" id="Categories-3" name="Categories-1" value="Infantil">
                                                    <label for="Categories-3"> Infantil</label>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="radio" class="me-2" id="Categories-4" name="Categories-1" value="Escolar">
                                                    <label for="Categories-4"> Escolar</label>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="radio" class="me-2" id="Categories-5" name="Categories-1" value="Descontos">
                                                    <label for="Categories-5"> Descontos</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php include 'includes/sideBar.php'; ?>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="row g-4 justify-content-center">
    
                                        <?=displayProducts($categoriaFilter, null, $searchQuery, $sortOption)?>
    
                                        <div class="col-12">
                                            <div class="pagination d-flex justify-content-center mt-5">
                                                <a href="#" class="rounded">&laquo;</a>
                                                <a href="#" class="active rounded">1</a>
                                                <a href="#" class="rounded">2</a>
                                                <a href="#" class="rounded">3</a>
                                                <a href="#" class="rounded">4</a>
                                                <a href="#" class="rounded">5</a>
                                                <a href="#" class="rounded">6</a>
                                                <a href="#" class="rounded">&raquo;</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fruits Shop End-->
    
            <?php include 'includes/footer.php'; ?>
        </body>
    
    </html>

$categoriaFilter = $_GET['categoria'] ?? null;
$searchQuery = $_GET['search'] ?? null;
$sortOption = $_GET['sort'] ?? null;

?>
