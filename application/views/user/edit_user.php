<?php $this->load->view("includes/header"); ?>
<div class="row">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title" text-center>Update User</h5>
            <form method="post" action="<?= base_url() ?>user/edit/<?= $id ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name='username' placeholder="Username" class="form-control" id="username"
                        value="<?= $users->username ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name='email' value="<?= $users->email ?>" placeholder="Email Address" class="form-control" id="email"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="text" name="mobile" value="<?= $users->mobile ?>" placeholder="Mobile" class="form-control" maxlenght="11"
                        id="mobile" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" placeholder="Address" value="<?= $users->address ?>" class="form-control" id="address">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= base_url() ?>user/index"  class="btn btn-sm btn-outline-primary fw-semibold fs-6">Back</a>
            </form>
            <?php
            if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success" role="alert">
                    Successfully Updated
                </div>
            <?php }
            ?>
            <?php
            if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger" role="alert">
                    Failed
                </div>
            <?php }
            ?>
        </div>
    </div>

</div>

</div>
<?php $this->load->view("includes/footer"); ?>