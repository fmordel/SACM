<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">
            Recuperar Contraseña
        </h2>
        <?= $this->Form->create($user);?>
        <?= $this->Form->input('Password',array('type'=>'password'));?>
        <?= $this->Form->submit('Enviar',array('class'=>'button'));?>
        <?= $this->Form->end();?>
      
    </div>
</div>