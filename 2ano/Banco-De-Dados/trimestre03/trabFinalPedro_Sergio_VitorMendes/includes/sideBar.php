<div c  lass="col-lg-12">
        <h4 class="mb-4">Outros produtos</h4>
        <?php foreach ($_SESSION['produtos'] as $produto): ?>
            <div class="d-flex align-items-center justify-content-start mb-3">
                <div class="rounded" style="width: 100px; height: 100px;">
                    <img src="<?= $produto['image'] ?>" class="img-fluid rounded" style = "width:100%;height:100%" alt="Image">
                </div>
                <div class="ms-3">
                    <h6 class="mb-2"><?= $produto['nome'] ?></h6>
                    <div class="d-flex mb-2">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i class="fa fa-star <?= $i < $produto['rating'] ? 'text-secondary' : '' ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="d-flex mb-2">
                        <h5 class="fw-bold me-2"><?= $produto['preco'] ?> $</h5>
                        <?php if (isset($produto['preco_antigo'])): ?>
                            <h5 class="text-danger text-decoration-line-through"><?= $produto['preco_antigo'] ?> $</h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="d-flex justify-content-center my-4">
            <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="position-relative">
            <img src="https://png.pngtree.com/png-clipart/20230827/original/pngtree-watercolor-illustration-banner-template-featuring-world-book-day-concept-vector-png-image_10695533.png" class="img-fluid w-100 rounded" alt="">
            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
            </div>
        </div>
</div>