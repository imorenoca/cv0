# REFACTORIZACIÓN Y REVISIÓN DE CÓDIGO.

## Revisión de la base de datos.  

1. Se establece una tabla intermedia para conectar Rol - Usuario. En el caso de
que un usuario pueda tener múltiples Roles.  
2. Se asocia los contactos creados a un usuario, antes un usuario podría ver los 
contactos creados por otros usuarios.
3. Se cambiará la seguridad del hash1, aunque se realiza a nivel de base de datos.  
4. Se aumenta la seguridad cambiando la conexión del root a un usuario específico 
creado.
5. Se eliminan los campos enum de toda la base de datos.
6. Se añade la posibilidad de que el contacto sea un headhunter.
7. Se separa la estructura de la inserción de datos en dos archivos.
8. Se cambia el motor de la base de datos a Transaccional: InnoDB.



 

