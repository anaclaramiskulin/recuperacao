<?= $this->extend('layouts/moviment_layout') ?>
<?= $this->section('table') ?>

        <div class="container">
            <h1><?= $title ?></h1>
            <hr>
            <div class="d-flex justify-content-end">
                <a href="<?= site_url('form')?>" class="btn btn-success mb-2">Add</a>
            </div>
            <table class="table table-bordered table-striped"id="moviment-list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Value</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($moviments): ?>
                    <?php foreach($moviments as $moviment): ?>
                        <tr>
                            <td><?= $moviment['id'] ?></td>
                            <td><?= $moviment['description'] ?></td>
                            <td><?= $moviment['date'] ?></td>
                            <td><?= $moviment['value'] ?></td>
                            <td><?= $moviment['type'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

        <script>
            $(document).ready( function () {
                $('#moviment-list').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'pdfHtml5',
                        'excelHtml5',
                        'csvHtml5'
                        
                    ]
                });
            } );
        </script>
<?= $this->endSection() ?>
