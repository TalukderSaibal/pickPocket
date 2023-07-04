<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Product Attribute</h2>

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
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Attribute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="attributeForm">
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
                            <label for="exampleInputEmail1">Name <span style="color: red;">*</span> </label>
                            <input type="text" class="form-control" name="attributeName" placeholder="Enter name">
                            <span style="color:red;" id="nameErr"></span>
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
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                
                if(count($attributes)){
                    foreach($attributes as $attribute){ ?>
                        <tr>
                            <th scope="row"><?= $attribute['id'] ?></th>
                            <td><?= $attribute['attribute_name'] ?></td>
                            <td>Active</td>
                            <td>
                                <a href="<?= base_url('attribute/edit/'.$attribute['id']) ?>">Edit</a> | <a class="deleteBtn" href="" data-id="<?= $attribute['id'] ?>">Delete</a>
                            </td>
                        </tr>
                <?php }
                }else{
                    echo "No units found";
                }
                
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
        $('#attributeForm').submit(function(event){
            event.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "<?= base_url('attribute_create') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.attributeName && response.attributeName.status == 'error'){
                        $('#nameErr').text(response.attributeName.message);
                    }

                    if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#attributeForm')[0].reset();
                        $('#exampleModalCenter').hide();
                        location.reload();
                    }else{
                        $('#successDiv').text(response.message).show();
                        $('#attributeForm')[0].reset();
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
                        url: "<?= base_url('attribute_delete') ?>",
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