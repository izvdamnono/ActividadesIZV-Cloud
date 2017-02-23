<form id="activitysearch" class="search-filter" method="post" action="">
    
    <div role="tab" id="headingGeneros">
        <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#filtros" href="#collapseGeneros"
               aria-expanded="true" aria-controls="collapseGeneros">Filtros</a>
        </h3>
    </div>
        
    <div id="collapseGeneros" class="panel-collapse collapse in comment-bottom heading" role="tabpanel"
         aria-labelledby="headingGeneros">
        <div class="panel-body">
            <fieldset>
                <?php $generos = ["Profesor", "Departamento", "Fecha"]; ?>
                <?php foreach ($generos as $genero_key => $genero_value): ?>
                        
                    <?php $genero_value = strtolower($genero_value); ?>    
                           
                    <div class="form-group text-left">
                        <label for="input<?= $genero_value ?>" class="col-lg-12 control-label"><?= ucfirst($genero_value) ?></label>
                        <br>
                        <div class="col-lg-12">
                            
                            <?php 
                                
                                switch ($genero_value) { 
                                
                                    case "profesor" : {
                                    
                                        $teachers = get_teachers(get_departaments()[0]);
                                        
                                        echo '<select class="form-control sel-prf" name="filter-profesor" >';
                                        
                                        foreach ( $teachers as $teacher) {
                                            
                                            $selected = isset($_POST['filter-profesor']) && $_POST['filter-profesor'] === $teacher ? selected : '';
                                            echo "<option $selected>$teacher</option>";
                                        }
                                        
                                        echo '</select>';
                                        
                                        break; 
                                        
                                    }
                                    
                                    case "departamento": {
                                    
                                        $departaments = get_departaments();
                                        
                                        echo '<select class="form-control sel-dpt" name="filter-departamento">';
                                        
                                        foreach ( $departaments as $departament) {
                                            
                                            $selected = isset($_POST['filter-departamento']) && $_POST['filter-departamento'] === $teacher ? selected : '';
                                            echo "<option $selected>$departament</option>";
                                        }
                                        
                                        echo '</select>';
                                        break; 
                                        
                                    }
                                    case "fecha": {
                                        
                                        ?>
                                        <input type="date" class="form-control" id="filterfecha"
                                        placeholder="fecha" name="filter-fecha" 
                                        value="<?= isset($_POST['filter-fecha']) ? $_POST['filter-fecha'] : '' ?>">
                                        
                                        <?php
                                        break;
                                    }
                                } 
                            ?>
                            
                            <?php /*<input type="<?= $genero_value == 'fecha' ? "date" : "text" ?>" class="form-control" id="input<?= $genero_value ?>" placeholder="<?= $genero_value ?>" 
                                    name="filter-<?= $genero_value ?>" 
                                    value="<?= isset($_POST["filter-$genero_value"]) ? $_POST["filter-$genero_value"] : '' ?>">*/?>
                        </div>
                        
                    </div>
                <?php endforeach; ?>
            </fieldset>
            
            <input type="submit" name="filter-activity" value="Buscar" >
        </div>
    </div>

</form>

