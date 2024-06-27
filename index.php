
<!-- Inicio Conexion a bd --->

<?php
   $server = "localhost";
   $username= "root";
   $password= "";
   $dbname="imss";
   $mysqli = new mysqli($server,$username,$password,$dbname);
?>

<?php 
$medicos=$mysqli->query("SELECT Nombre_Medico FROM médico")

?>
<!-- Fin Conexion a bd --->

   <!DOCTYPE html>

<html lang="es">
    
    <head>

        <meta charset="UTF-8"> 
        <title>Cita Primer Nivel 1</title>
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="est calen.css">
        <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    </head>
  
    <body>
      <div class="central"> 
        <div >
        <h1 class="titulo">Agendar Cita de Primer Nivel</h1> 
        </div>
    </div>
        <div class="container">
            <div class="left">
              <div class="calendar">
                <div class="month">
                  <i class="fas fa-angle-left prev"></i>
                  <div class="date">december 2015</div>
                  <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays">
                  <div>D</div>
                  <div>L</div>
                  <div>M</div>
                  <div>M</div>
                  <div>J</div>
                  <div>V</div>
                  <div>S</div>
                </div>
                <div class="days"></div>
                <div class="goto-today">
                  <div class="goto">
                    <input type="text" placeholder="mm/aaaa" class="date-input" />
                    <button class="goto-btn">Ir</button>
                  </div>
                  <button class="today-btn">Hoy</button>
                </div>
              </div>
            </div>
            <div class="right">
              <div class="today-date">
                <div class="event-day">wed</div>
                <div class="event-date">12th december 2022</div>
              </div>
              <div class="events"></div>
              <div class="add-event-wrapper">
                <div class="add-event-header">
                  <div class="title">Reservar cita</div>
                  <i class="fas fa-times close"></i>
                </div>
                <div class="add-event-body">
                <form action="" method="post"> 
                <!-- Campo oculto para la fecha -->
 <!-- --><input type="hidden" name="fecha_cita" id="fecha_cita"> 
  <!-- El resto de los campos del formulario -->
                <div class="add-event-input">
                <input type="text" name="hora_inicio" placeholder="Hora de inicio HH:MM:00">
                  </div>
                  <div class="add-event-input">
                  <input type="text" name="hora_fin" placeholder="Hora de fin  HH:MM:00">
                  
                  </div>
                 
                  <p>
                        <label for="medico">Médico:</label>
                        <select name="medico" id="medico">
                          <option value="">Médico</option>
                          <?php while ($row = $medicos->fetch_assoc()) { ?>
                            <option value="<?php echo $row['Nombre_Medico']; ?>">
                              <?php echo $row['Nombre_Medico']; ?>
                             </option>
                    <?php } ?>  
                                  </select>      
                </p>
                

                  <div class="add-event-input">
                  <input type="text" name="paciente" placeholder="Nombre del paciente">
                  </div>
                  <div class="add-event-input">
                  <input type="email" name="email" placeholder="E-mail del paciente">
                  </div>

                <div class="add-event-footer">
              
               <button  name="registro"  class="add-event-btn" type="submit">Agendar cita</button>
                </div>
              </div>
            </div> </div>
            </form>

<!---->
<script>
  // Función para actualizar el campo oculto con la fecha seleccionada
  function updateHiddenDateField() {
    const fecha_cita = document.getElementById('fecha_cita');
    fecha_cita.value = selectedDate;
  }

  // Llama a esta función cada vez que se seleccione una fecha
  document.querySelector('.add-event-btn').addEventListener('click', updateHiddenDateField);
</script> 

          <button class="add-event">
            <i class="fas fa-plus"></i>
          </button>
        </div> 
          
        <script src="calen java.js"></script> 


 </body>
</html>


<?php

if (isset($_POST['registro'])) {
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $medico = $_POST['medico'];
    $paciente = $_POST['paciente'];
    $email = $_POST['email']; 
    $fecha_cita = $_POST['fecha_cita'];  // Obtener la fecha de la cita
    $insertarDatos = "INSERT INTO agendadas (fecha_cita,hora_inicio, hora_fin,medico,paciente,email) VALUES ('$fecha_cita','$hora_inicio', '$hora_fin', '$medico','$paciente','$email')";
      //$insertarDatos = "INSERT INTO agendadas (hora_inicio, hora_fin,medico,paciente,email) VALUES ('$hora_inicio', '$hora_fin', '$medico','$paciente','$email')";
  
      if ($mysqli->query($insertarDatos) ===TRUE) {
       echo "Cita agendada correctamente!";
       
       
    } else {
       // echo "Error al agendar la cita: " . $mysqli->error;
       echo "Error al agendar la cita: " ;
    }

  }
  /*
  if (resultado === true) {
    window.alert('Okay, si estas seguro.');
} else { 
    window.alert('Pareces indeciso');
}
 */ 

?>