<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5">Glossary</h1>
        </div>
    </div>
    <div class="row" style="margin-top: 20px">
        <table class="table table-stripered">
            <?php foreach ($model as $item) : ?>
                <tr>
                    <td><a href="detail.php?term=<?= $item->term ?>"><?= $item->term ?></a></td>
                    <td><?= $item->definition ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </div>
</div>