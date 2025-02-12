<?php
function displayProducts($categoriaFilter = null, $idFilter = null) {
    $produtos = $_SESSION['produtos'];
    
    if ($categoriaFilter) {
        $produtos = array_filter($produtos, function($produto) use ($categoriaFilter) {
            return $produto['categoria'] === $categoriaFilter;
        });
    }

    if ($idFilter) {
        $produtos = array_filter($produtos, function($produto) use ($idFilter) {
            return $produto['id'] === $idFilter;
        });
    }

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
}

include 'includes/ajax.php';