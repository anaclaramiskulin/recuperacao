<?= $this->extend('layouts/formUser_layout') ?>
<?= $this->section('dashboard') ?>

    <div class="container">
        <div class="row pt-3">
                <h4> Register new user: </h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <form method="post" name="add_create" action="<?= base_url('register') ?>" id="add_create">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                        <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'name') : '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                        <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'email') : '' ?>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <span class="text-danger text-sm">
                            <?= isset($validation) ? display_form_errors($validation, 'password') : '' ?>
                    </span>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-control">
                            <option value="counter">Counter</option>
                            <option value="admin">Admin</option>
                        </select>

                        <div class="form-group"><br>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
<?= $this->endSection() ?>