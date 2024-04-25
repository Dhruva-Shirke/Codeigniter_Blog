<?= $this->extend('layouts/common') ?>

<?= $this->section('title') ?>Users<?= $this->endSection() ?>
<?= $this->section('content') ?>
<h1>Users</h1>

<table>
    <tr>
        <th>Id</th>
        <th>First Name</th>
        <th>Email</th>
        <th>Active</th>
        <th>Ban Status</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <td><?= $user->id ?></td>
            <td> <a href="<?= url_to("\Admin\Controllers\Users::show", $user->id) ?>"><?= esc($user->first_name) ?></a></td>
            <td><?= esc($user->email) ?></td>
            <td><?= yesno($user->active) ?></td>
            <td><?= yesno($user->isBanned()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?= $pager->links() ?>

<?= $this->endSection() ?>