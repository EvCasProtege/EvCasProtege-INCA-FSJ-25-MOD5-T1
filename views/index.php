<?php include_once 'header.php'; ?>

    <h1>Listado de Libros</h1>
    <a href="index.php?action=agregar" class="form-control btn btn-success">Agregar Nuevo Libro</a>
    <p>

        <form action="index.php?action=buscar" method="GET">
            <div class="input-group mb-3">
                <input type="hidden" name="action" value="buscar">
                <input type="text" class="form-control" placeholder="Buscar por título" name="titulo" value="<?php echo isset($_GET['titulo'])?$_GET['titulo']:"" ?>">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                <a href="index.php" class="btn btn-outline-secondary">Limpiar</a>
            </div>
        </form>
    </p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Año de Publicación</th>
                <th>Género</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= $libro['titulo'] ?></td>
                    <td><?= $libro['autor'] ?></td>
                    <td><?= $libro['anio_publicacion'] ?></td>
                    <td><?= $libro['genero'] ?></td>
                    <td>
                        <a href="index.php?action=editar&id=<?= $libro['id'] ?>" class="btn btn-success mb-3">Editar</a>
                    </td>
                    <td>
                        <?php if (isset($libro['estado'])): ?>
                            <span class="badge <?= $libro['estado'] == 'activo' ? 'bg-success' : 'bg-danger' ?>">
                                <?= ucfirst($libro['estado']) ?>
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Estado no disponible</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($libro['estado'] == 'activo'): ?>
                            <a href="index.php?action=cambiar_estado&id=<?= $libro['id'] ?>&estado=inactivo" class="btn btn-warning btn-sm">Marcar Inactivo</a>
                        <?php else: ?>
                            <a href="index.php?action=cambiar_estado&id=<?= $libro['id'] ?>&estado=activo" class="btn btn-success btn-sm">Marcar Activo</a>
                        <?php endif; ?>
                        <a href="index.php?action=prestamo&id=<?= $libro['id'] ?>" class="btn btn-danger btn-sm">Prestar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php include_once 'footer.php'; ?>