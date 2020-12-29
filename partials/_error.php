<?php 

if(isset($errors) && count($errors) != 0){
    echo '<div class=" alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="close"></button>';

            foreach($errors as $error) {
                echo $error.'<br/>';
            }
    echo '</div>';
} 
