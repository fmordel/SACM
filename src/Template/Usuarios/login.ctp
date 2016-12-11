<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
    <div class="panel">
        <h2 class="text-center">
            Login
        </h2>
        
        <?= $this->Form->create();?>
        <?= $this->Form->input('Correo');?>
        <?= $this->Form->input('Password',array('type'=>'password'));?>
        <?= $this ->Html->link('Recuperar Contraseña',['controller'=>'usuarios','action'=>'validar']); ?>
        <?= $this->Form->submit('Acceder',array('class'=>'button'));?>
        <?= $this->Form->end();?>
    </div>
</div>