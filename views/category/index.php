<h1>Gestionar categorias</h1>

<?php if(isset($_SESSION['save']) && $_SESSION['save'] == 'completed'): ?>
    <div class="alert">
        Categoria creada correctamente
    </div>
<?php elseif(isset($_SESSION['save']) && $_SESSION['save'] == 'failed'): ?>
    <div class="alert alert-error">
        Fallo al crear la categoria, introduce el nombre correctamente
    </div>
<?php 
    endif;
    utils::deleteSession('save');
?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'completed'): ?>
    <div class="alert">
        Categoria eliminada correctamente
    </div>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed'): ?>
    <div class="alert alert-error">
        Fallo algo al eliminar la categoria
    </div>
<?php 
    endif;
    utils::deleteSession('delete');
?>

<a href="<?=base_url?>?controller=category&action=create" class="button button-small">Crear nuevas categorias</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Eliminar</th>
    </tr>
    <?php while($cat = $categories->fetch_object()): ?>
    <tr>
        <td><?= $cat->id ?></td>
        <td><?= $cat->name ?></td>
        <td><a href="<?=base_url?>?controller=category&action=delete&id=<?=$cat->id?>"><i class="fa-solid fa-trash table-icon button button-red"></i></a></td>
    </tr>
    <?php endwhile; ?> 
</table>