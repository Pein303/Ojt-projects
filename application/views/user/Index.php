<?php $this->load->view("includes/header"); ?>
<div class="row">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">USER LIST</h5>
            <a href="<?= base_url() ?>user/add/" class="btn btn-sm btn-primary" style="margin:5px 5px 10px 0;">ADD USERS</a>

            <div class="mb-3 d-flex align-items-center">
                <label for="entriesPerPage" class="mr-3" style="margin-right:10px;">Entries per page: </label>
                <select id="entriesPerPage" class="form-control w-auto">
                    <?php $options = [5, 10, 20, 50]; ?>
                    <?php foreach ($options as $option) { ?>
                        <option value="<?= $option ?>" <?= ($option == $entries_per_page) ? 'selected' : '' ?>>
                            <?= $option ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <input type="text" id="search" class="form-control" placeholder="Search by username, email, or mobile">
            </div>
            
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody id="user-list">
                    <?php if (!empty($users)) {
                        $i = $this->uri->segment(3) + 1;
                        foreach ($users as $row) { ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['mobile'] ?></td>
                            <td><?= $row['address'] ?></td>
                            <td>
                                <a href="<?= base_url() ?>user/edit/<?= $row['id'] ?>" class="btn btn-sm btn-primary">EDIT</a>
                                <a href="<?= base_url() ?>user/delete/<?= $row['id'] ?>" onclick="return confirm('Are you sure want to delete this user?')" class="btn btn-sm btn-danger">DELETE</a>
                            </td>
                        </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">No Users Found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <?= $pagination ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("includes/footer"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#entriesPerPage').on('change', function() {
        var entries = $(this).val();
        var url = "<?= base_url('user/index') ?>?entries_per_page=" + entries;
        window.location.href = url;
    });

    $('#search').on('keyup', function() {
        var query = $(this).val();
        
        $.ajax({
            url: '<?= base_url("user/search") ?>',
            method: 'POST',
            data: { query: query },
            success: function(data) {
                $('#user-list').html(data);
            },
            error: function() {
                alert('Failed to fetch data.');
            }
        });
    });
});
</script>
