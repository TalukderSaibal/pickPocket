<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="container">
    <h2>Stock List</h2>

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
            <tr>
                <th scope="row">1</th>
                <td>Saikat</td>
                <td>Active</td>
                <td>
                    <a href="">Edit</a> | <a href="">Delete</a>
                </td>
            </tr>     
        </tbody>
    </table>
</div>

<?= $this->endSection('content') ?>