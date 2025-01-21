
<?php foreach ($error as $err) :?>
<p class="error"><?=$err?></p>
<?php endforeach; ?>

<p>Tal vez quieras volver al inicio</p>
<a href="<?=BASE_URL?>">volver</a>

<style>
    .error {
        color: red;
    }
</style>