<?=$this->extend('layout/base')?>

<?=$this->section('content')?>

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

        <!-- <div id="showModal" style="display: none;">
            <div>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Name</label>
                        <input type="text" class="form-control" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Name</label>
                        <input type="text" class="form-control" placeholder="Enter name">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div> -->

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

                if (count($languages)) {
                    foreach ($languages as $key => $value) {?>
                        <tr>
                            <th scope="row"><?=$value['id']?></th>
                            <td><?=$value['language_name']?></td>
                            <td><?=$value['language_code']?></td>
                            <td>
                                <a class="updateBtn" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                |
                                <a href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php }
                } else {?>
                    <div>
                        <P>No data found</P>
                        <a href="">Add Language</a>
                    </div>
            <?php }

                ?>
            </tbody>
        </table>

        <div class="pagination-1">
            <?php if ($pager): ?>
            <?php $pagiPath = 'language/languageList';?>
            <?php $pager->setPath($pagiPath);?>
            <?=$pager->links()?>
            <?php endif;?>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- <script>
    $(document).ready(function(){
        $('.updateBtn').click(function(){
            $('#showModal').show();
        })
    });
</script> -->

<?=$this->endSection('content')?>