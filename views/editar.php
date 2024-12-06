<!-- editar.php -->
<?php include_once 'header.php'; ?>

<h1>Editar Libro</h1>

<form action="index.php?action=editar&id=<?php echo $this->libro->getId(); ?>" method="POST">
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="hidden" name="id" value="<?php echo $this->libro->getId(); ?>">
        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $this->libro->getTitulo(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="autor" class="form-label">Autor</label>
        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $this->libro->getAutor(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="anio_publicacion" class="form-label">Año de Publicación</label>
        <input type="number" class="form-control" id="anio_publicacion" name="anio_publicacion" value="<?php echo $this->libro->getAnioPublicacion(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="genero" class="form-label">Género</label>
        <input type="text" class="form-control" id="genero" name="genero" value="<?php echo $this->libro->getGenero(); ?>" required>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-control" id="estado" name="estado" required>
            <option value="activo" <?= $this->libro->getEstado() == 'activo' ? 'selected' : '' ?>>Activo</option>
            <option value="inactivo" <?= $this->libro->getEstado() == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar Libro</button>
</form>

<?php 
?>

<?php include_once 'footer.php'; ?>
