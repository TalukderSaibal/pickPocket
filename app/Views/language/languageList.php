<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Language List</h2>

    <div class="table_div">
    
        <div class="list_div">

            <div class="entry_show">
                <label for="">Show</label>
                <select name="" id="">
                    <option value="">10</option>
                    <option value="">20</option>
                    <option value="">30</option>
                </select>
                <label for="">entries</label>
            </div>

            <div class="search_form">
                <form action="" method="post">
                    <input type="text">
                    <input type="submit" value="Search">
                </form>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                if(count($languages)){
                    foreach($languages as $key => $value){ ?>
                        <tr>
                            <th scope="row"><?= $value['id'] ?></th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td><i class="fa fa-pencil-square-o" aria-hidden="true"></i> | <i class="fa fa-trash" aria-hidden="true"></i></td>
                        </tr>
                <?php }
                }else{ ?>
                    <div>
                        <P>No data found</P>
                        <a href="">Add Language</a>
                    </div>
            <?php }
                
                ?>
            </tbody>
        </table>

        <div class="pagination-1">
            <?php if($pager) : ?>
            <?php $pagiPath = 'language/languageList'; ?>
            <?php $pager->setPath($pagiPath); ?>
            <?= $pager->links() ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<?= $this->endSection('content') ?>