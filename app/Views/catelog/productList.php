<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Product List</h2>

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
                    <th scope="col">Product Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                
                foreach($products as $product){ ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><?= $product->product_name ?></td>
                        <td>111</td>
                        <td>Active</td>
                        <td><?= $product->product_type ?></td>
                        <td><?= $product->product_price ?></td>
                        <td><?= $product->discount_price ?></td>
                        <td>Active</td>
                        <td>
                            <a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a class="deleteBtn" href="" data-id=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr> 
                <?php }
                
                ?>    
            </tbody>
        </table>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script>
    $(document).ready(function(){
        $('#brandForm').submit(function(event){
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('brand_create') ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#loadingImage').show();
                },
                success: function(response){
                    if(response.brandName && response.brandName.status == 'error'){
                        $('#nameErr').text(response.brandName.message);
                    }
                    if(response.brandImage && response.brandImage.status == 'error'){
                        $('#imageErr').text(response.brandImage.message);
                    }

                    if(response.status && response.status == 'success'){
                        $('#successDiv').text(response.message).show();
                        $('#brandForm')[0].reset();
                        $('#exampleModalCenter').hide();
                        location.reload();
                    }else{
                        $('#successDiv').text(response.message).show();
                        $('#brandForm')[0].reset();
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