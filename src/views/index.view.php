<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"><?= $view_bag['heading'] ?></h1>
        </div>
    </div>
    <div class="row">
        <form action="" method="GET" class="form-inline">
            <div class="form-group">
                <input type="text" name="search" id="search">
                <input type="submit" value="Search">
            </div>
        </form>
    </div>
    <div class="row" style="margin-top: 20px">
        <table class="table table-stripered">
            <?php foreach ($model as $item) : ?>
                <tr>
                    <td><?= $item->id ?></td>
                    <td><a href="detail.php?id=<?= $item->id ?>"><?= $item->term ?></a></td>
                    <td><?= $item->definition ?></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </div>
</div>