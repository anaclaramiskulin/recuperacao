<?= $this->extend('layouts/main_layout') ?>
    <?= $this->section('dashboard') ?>

        <div class="container">
            <table class="table table-hover"
                style="border-left: solid; border-left-color: #212529; border-right: solid; border-right-color: #212529; border-bottom: solid; border-bottom-color: #212529;">
                <a href="<?= site_url('formUser')?>" class="btn btn-success mb-2">Add</a>
                <tr class="table-dark">
                    <th>N°</th>
                    <th>Usuário</th>
                    <th>Tipo</th>
                    <th>Controle</th>
                </tr>
               <?PHP foreach($userAll as $userAll): 


?>
   <tr >
       <td><?=  $userAll['id'] ?></td>
       <td><?=  $userAll['name'] ?></td>
       <td><?= $userAll['type']?></td>
       <form action = "<?= site_url('buttons')?>/<?=$userAll['id']?>" method="post">
       <td><input type="submit" name="done" value="Apagar" /></td>
       </form>
   </tr>
<?php
endforeach; ?>
</table>
        </div>




        <?= $this->endSection() ?>