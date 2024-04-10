<?php

echo '
<div class="w-100">

    <small class="text-muted">Vyhľadávanie</small>

    <form action="' . URL . '/lgsl_search" method="post" class="form-inline">
        
        <div class="form-group mb-1 mx-sm-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">IP</span>
                </div>
                <input type="text" name="ip" class="form-control" aria-label="Small" value="' . $_POST['ip'] . '" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        
        <div class="form-group mb-1 mr-sm-2">
            <div class="input-group input-group-sm">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">PORT</span>
                </div>
                <input type="text" name="c_port"  class="form-control" aria-label="Small" value="' . $_POST['c_port'] . '" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        
        <div class="mb-1">
            <button type="submit" class="btn btn-primary btn-sm">Hľadať</button>
        </div>
    
    </form>
    
</div>

<hr>';