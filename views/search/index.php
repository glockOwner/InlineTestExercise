<?php include 'views/layouts/header.php';?>
    <form method="POST">
        <div class="input-group" style="width: 500px">
            <input type="text" autocomplete="off" class="form-control" placeholder="Search post" name="searchInput" id="search-input" style="border-right: none;">
            <button name="search" class="btn" id="srchbtn" type="btn-default" style="border: lightgrey solid 1px; border-bottom-right-radius: 10px;border-top-right-radius: 10px;border-left: none;">
                <i class="fa fa-search" aria-hidden="true"></i>
            </button>
        </div>
    </form>
    <?php if ($posts && !$errors): ?>
        <table class="table table-dark table-striped mt-5">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Post-Title</th>
                <th scope="col">Comment</th>
            </tr>
            </thead>
            <tbody>
            <?php $id = 1;?>
            <?php foreach($posts as $post => $comment):?>
                <tr>
                    <td><?php echo $id;?></td>
                    <td><?php echo $post;?></td>
                    <td><?php echo $comment;?></td>
                </tr>
                <?php $id++; ?>
            <?php endforeach;?>
            </tbody>
        </table>
    <?php else: ?>
        <?php foreach ($errors as $error): ?>
            <p class="text-danger mt-5"><?php echo $error;?></p>
        <?php endforeach;?>
    <?php endif;?>
<?php include 'views/layouts/footer.php';?>