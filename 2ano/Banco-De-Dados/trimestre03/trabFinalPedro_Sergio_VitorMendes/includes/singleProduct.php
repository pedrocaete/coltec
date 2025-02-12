<?php
function displayProduct($produto, $categoriaFilter = True, $precoFilter = True) {
        if ($produto['categoria'] == $categoriaFilter && $produto['preco'] == $precoFilter) {
            echo '
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="rounded position-relative fruite-item" onclick="window.location.href=\'shop-detail.php?id=' . $produto['id'] . '\'">
                    <div class="fruite-img">
                        <img src="' . $produto['image'] . '" class="img-fluid w-100 rounded-top" alt="">
                    </div>
                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">' . $produto['categoria'] . '</div>
                    
                    <div class="p-4 rounded-bottom">
                        <h4>' . $produto['nome'] . '</h4>
                        <p>' . $produto['desc'] . '</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold mb-0">R$' . $produto['preco'] . '</p>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>  
                    </div>
                </div>
            </div>';
        }
    }
?>