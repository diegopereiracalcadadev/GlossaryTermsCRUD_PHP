<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="mt-5"><?= $view_bag['heading'] ?></h1>
        </div>
    </div>
    <div class="row">
        <a href="create.php">Create new Term</a>
    </div>
    <div class="row" style="margin-top: 20px">
        <table class="table table-stripered">
            <?php foreach ($model as $item) : ?>
                <tr>
                    <td><?= $item->term ?></td>
                    <td><?= $item->definition ?></td>
                    <td><a href="edit.php?key=<?= $item->term ?>">Edit</a></td>
                    <td><a href="delete.php?key=<?= $item->term ?>">Delete</a></td>
                </tr>

            <?php endforeach; ?>
        </table>
    </div>
</div>