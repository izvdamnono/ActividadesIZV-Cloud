<?php
/**
 * pqgjJnpgWTLBiTi#$^YZE7Zt
 * Traducciones pendientes
 * Read more
 * Recent posts
 * By
 * on
 * Últimas noticias
 * Last name
 * https://github.com/Alecaddd/Sunset-theme/blob/master/Lesson%2062/inc/function-admin.php
 */ 
?>
filtersCollapsed

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingGeneros">
        <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#filtros" href="#collapseGeneros"
               aria-expanded="true" aria-controls="collapseGeneros">Géneros</a>
        </h4>
    </div>
    <div id="collapseGeneros" class="panel-collapse collapse " role="tabpanel"
         aria-labelledby="headingGeneros">
        <div class="panel-body">
            <fieldset>
                <div class="form-group">
                    <label for="generos" class="col-lg-3 control-label small">Géneros:</label>
                    <div class="col-lg-9">
                        <div class="checkbox">
                            <?php
                            $generos = ["Acción", "Apocalíptico", "Artes Marciales", "Aventura", "Ciencia Ficción", "Comedia", "Cyberpunk", "Demonios", "Deportes", "Drama", "Ecchi", "Fantasía", "Gender Bender", "Gore", "Harem", "Histórico", "Horror", "Magia", "Mecha", "Militar", "Misterio", "Musical", "Parodia", "Policial", "Psicológico", "Realidad Virtual", "Recuentos de la vida", "Reencarnación", "Romance", "Samurai", "Sobrenatural", "Super Poderes", "Supervivencia", "Suspense", "Thiller", "Tragedia", "Vampiros", "Vida Escolar", "Yaoi", "Yuri"];
                            ?>
                            <?php foreach ($generos as $genero_key => $genero_value): ?>
                                <label>
                                    <input type="checkbox" name="generos[]" value="<?= $genero_value ?>"> <?= $genero_value ?>
                                </label>
                                <br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- Ejemplos de formulario bootstrap -->
<form class="form-horizontal">
  <fieldset>
    <legend>Legend</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Checkbox
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Textarea</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
    <div class="form-group">
      <label class="col-lg-2 control-label">Radios</label>
      <div class="col-lg-10">
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
            Option one is this
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
            Option two can be something else
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Selects</label>
      <div class="col-lg-10">
        <select class="form-control" id="select">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <br>
        <select multiple="" class="form-control">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancel</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>