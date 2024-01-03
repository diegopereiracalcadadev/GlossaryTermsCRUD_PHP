<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"><?= $view_bag['heading'] ?></h1>
        </div>
    </div>
    <div class="row">
        Confirm delete term <?= $model->term ?> ?
    </div>
    <div class="row" style="margin-top: 20px">
        <form action="" method="POST">
            <input type="hidden" name="term" value="<?= $model->term; ?>">
            <div class="form-group">
                <input type="submit" value="Delete">
            </div>
        </form>
    </div>
</div>