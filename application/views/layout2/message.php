<?php if($this->session->flashdata('message')) : ?>
<?php 
echo '<div class="alert alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Warning!</strong>'.' '.$this->session->flashdata('message').'
    </div>';
  ?>
<?php endif; ?>

