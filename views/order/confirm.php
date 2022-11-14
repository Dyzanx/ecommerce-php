<?php if(isset($_SESSION['order']) && $_SESSION['order'] == "completed"): ?>
<h1>Tu pedido ha sido confirmado</h1>
<p>
    Pedido confirmado correctamente, ha sido guardado con exito, una vez realizada la transferencia bancaria a la 
    cuenta ################ con el coste del pedido, este será procesado y envíado a su destino
</p>

<?php elseif(isset($_SESSION['order']) && $_SESSION['order'] != "completed"): ?>

<?php endif; ?>