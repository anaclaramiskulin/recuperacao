<style>
    th, td {
        padding: 10px 10px;
    }
    h1{
        text-align: justfy;
    }
</style>

<h1>Todos os movimentos</h1>

<table class="table">
    <tr>
        <th>#</th>
        <th>Descrição</th>
        <th>Data</th>
        <th>Valor</th>
        <th>Tipo E/S</th>
    </tr>
    <?php foreach($moviments as $moviment): ?>
        <tr>
            <td><?= $moviment['id'] ?></td>
            <td><?= $moviment['description'] ?></td>
            <td><?= $moviment['date'] ?></td>
            <td><?= $moviment['value'] ?></td>
            <td><?= $moviment['type'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>