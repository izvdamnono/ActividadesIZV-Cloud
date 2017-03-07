<form id="activitysearch" class="search-filter" method="post" action="">
    
    <div role="tab" id="headingGeneros">
        <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#filtros" href="#collapseGeneros"
               aria-expanded="true" aria-controls="collapseGeneros"><?= __('Filters', 'web')?></a>
        </h3>
    </div>
        
    <div id="collapseGeneros" class="panel-collapse collapse in comment-bottom heading" role="tabpanel"
         aria-labelledby="headingGeneros">
        <div class="panel-body">
            <fieldset>
                <?php $generos = [__("Teacher",'web'), __("Department",'web'), __("Date",'web')]; ?>
                <?php foreach ($generos as $genero_key => $genero_value): ?>
                        
                    <?php $genero_value = strtolower($genero_value); ?>    
                           
                    <div class="form-group text-left">
                        <label for="input<?= $genero_value ?>" class="col-lg-12 control-label"><?= ucfirst($genero_value) ?></label>
                        <br>
                        <div class="col-lg-12">
                            
                            <?php 
                                
                                switch ($genero_value) { 
                                
                                    case strtolower(__("Teacher", 'web')) : {
                                    
                                        $depart   = isset($_POST['filter-departamento']) ? $_POST['filter-departamento'] : get_departaments()[0]; 
                                        $teachers = get_teachers($depart);
                                        
                                        echo '<select class="form-control sel-prf" name="filter-profesor" >';
                                        echo "<option value=''>".__("Without Specifying", "web")."</option>";
                                        foreach ( $teachers as $teacher) {
                                            
                                            $selected = isset($_POST['filter-profesor']) && $_POST['filter-profesor'] === $teacher ? "selected" : '';
                                            echo "<option  value='$teacher' $selected>$teacher</option>";
                                        }
                                        
                                        echo '</select>';
                                        
                                        break; 
                                        
                                    }
                                    
                                    case strtolower(__("Department", 'web')): {
                                    
                                        $departaments = get_departaments();
                                        
                                        echo '<select class="form-control sel-dpt" name="filter-departamento">';
                                        echo "<option class='wtsp' value=''>".__("Without Specifying", "web")."</option>";
                                        
                                        foreach ( $departaments as $departament) {
                                            
                                            $selected = isset($_POST['filter-departamento']) && $_POST['filter-departamento'] === $departament ? 'selected' : '';
                                            echo "<option $selected value='$departament'>$departament</option>";
                                        }
                                        
                                        echo '</select>';
                                        break; 
                                        
                                    }
                                    case strtolower(__("Date", 'web')): {
                                        
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
            
            <input type="submit" name="filter-activity" value="<?= __('Search', 'web')?>" >
        </div>
    </div>

</form>

