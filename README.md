# Metro-consulting-group---Bestnid

Equipo primero configuren el git, en la pagina tienen todos los pasos.
Luego si no tienen instalado para poder desarrollar con PHP y MySQL, lo que tienen que hacer es bien sencillo, para emular en su maquina como si estuvieran en un servidor.
No les voy a poner todos los pasos, porque hay millones de tutoriales, solo les comento a grandes rasgos los pasos a seguir.
Yo personalmente en MAC uso MAMP pero el más conocido para en WINDOWS es XAMPP (https://www.apachefriends.org/es/download.html).
Que hace esto?? Simple, instalando esto, nos instala todos los servicios para poder correr PHP y MySQL, ustedes elegiran como instalarlo si como un programa o un servicio para que arranque al iniciar Windows. Yo les recomiendo por si no lo usan más, que lo instales como programa.
Una vez finalizado, lo abren y les va a decir si esta corriendo el Servidor Apache y Servidor MySQL. OJO con Skype que suelen tener conflictos en WINDOWS porque suelen usar el mismo puerto. Cerrarlo por las dudas.
Donde se ponen los archivos para que luego podamos acceder a la web desde el navegador???
Simple, se clonan desde GitHub lo que les subi dentro de la carpeta htdocs del XAMPP (O el programa que ustedes instalaron)
Luego que les clona todos los archivos lo que tienen que hacer es abrir el phpmyadmin desde el XAMPP y ejecutar el script que esta dentro de la carpeta CORE que les hice. 
Por ahora solo tiene la tabla USERS con 2 usuarios por defectos, uno admin y otro normal. 

Por el momento lo que ya esta listo es
Registro de Usuarios
Login de Usuario y Admin (Se pueden loguear con el email o el username)
Logout de Usuario y Admin
MyAccount de Usuario y Admin