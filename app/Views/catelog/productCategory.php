<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Product Category</h2>

    <div id="deleteDiv">
        <p style="color: #fff;">Are you sure want to delete ?</p>
        <div class="deleteButton">
            <button id="okBtn">Ok</button>
            <button id="cancelBtn">Cancel</button>
        </div>
    </div>

    <div class="table_div">
    <div id="successDiv"></div>
    <div class="modal_div">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="categoryForm">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Language</label>
                            <select class="form-control" name="languageSelect" id="languageSelect">
                                <?php
                                    foreach($languages as $key => $value){ ?>
                                        <option value="<?= $value->id ?>"><?= $value->language_name ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" name="categoryName" placeholder="Enter name">
                            <span style="color:red;" id="nameErr"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Parent Category</label>
                            <select class="form-control" name="parentCategory">
                                <option value="0">Choose</option>
                                <?php
                                
                                foreach($categories as $key => $category){ ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                <?php }
                                
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Slug <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" name="categorySlug" placeholder="Enter slug">
                            <span style="color:red;" id="slugErr"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Category Media</label>
                            <input type="file" class="form-control-file" name="categoryImage">
                            <span style="color:red;" id="imageErr"></span>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Category Icon</label>
                            <input type="file" class="form-control-file" name="categoryIcon">
                            <span style="color:red;" id="iconErr"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <img id="loadingImage" style="width: 140px; height:40px; display:none;" src="https://f4n3x6c5.stackpathcdn.com/article/adding-a-loading-page-to-website/Images/chromecapture.gif" alt="loading gif">
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

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
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach($categoryData as $cat){ ?>
                        <tr>
                            <th scope="row"><?= $cat['id'] ?></th>
                            <td><?= $cat['category_name'] ?></td>
                            <td><?= $cat['category_description'] ?></td>
                            <td><?= $cat['category_slug'] ?></td>
                            <td>
                                <a href="">Edit</a> | <a class="deleteBtn" href="" data-id="">Delete</a>
                            </td>
                        </tr> 
                <?php }
                
                ?>
            </tbody>
        </table>
        <div class="pagination-1">
            <?php if ($pager): ?>
            <?php $pagiPath = 'product/attribute';?>
            <?php $pager->setPath($pagiPath);?>
            <?=$pager->links()?>
            <?php endif;?>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#categoryForm').submit(function(event){
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('category_create') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.categoryName && response.categoryName.status == 'error'){
                        $('#nameErr').text(response.categoryName.message);
                    }
                    if(response.brandImage && response.brandImage.status == 'error'){
                        $('#imageErr').text(response.brandImage.message);
                    }

                    if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#categoryForm')[0].reset();
                        $('#exampleModalCenter').hide();
                        location.reload();
                    }else{
                        $('#successDiv').text(response.message).show();
                        $('#categoryForm')[0].reset();
                    }
                    $('#loadingImage').hide();
                },
            })
        })
    });
</script>

<script>
    $(document).ready(function(){
        $('.deleteBtn').click(function(){
            $('#deleteDiv').show();
            var id = $(this).data('id');
                $('#okBtn').click(function(){
                    $.ajax({
                        url: "<?= base_url('brand_delete') ?>",
                        type: "POST",
                        data: 'id=' + id,
                        dataType: "json",
                        success: function(response) {
                            if(response.status && response.status == 'success'){
                                $('#successDiv').text(response.message).show();
                                location.reload();
                            }else{
                                $('#successDiv').text(response.message).show();
                            }
                        }
                    });
                    $('#deleteDiv').hide();
                });
            return false;
        });

        $('#cancelBtn').click(function(){
            $('#deleteDiv').hide();
        });
    });
</script>

<?= $this->endSection('content') ?>