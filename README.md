
![Logo](https://www.redttu.edu.co/es/wp-content/uploads/2019/03/11.-IU-DIGITAL.png)

## Evidencia de Aprendizaje 4: Reto final
## Gestion de asignaturas

API que permite la gestión de asignaturas por parte 
de una serie de usuarios en función de roles específicos.

## Authors

- [@AlexIbar](https://github.com/AlexIbar)
Edwin Alexander Ibarra Ortiz - PREELEC2202PC-TDS0033 
- [@chechorios2008](https://github.com/chechorios2008)
Sergio Andres Rios Gomez - PREELEC2202PC-TDS0033


## Repositorio GitHub
[![portfolio](https://pythonforundergradengineers.com/posts/git/images/git_and_github_logo.png)](https://github.com/)
Enlace: https://github.com/AlexIbar/backGestionAsignaturas.php

## Se debe tener previamente

Se debe crear una información base para que el usuario coordinador pueda crear los usuarios profesores y alumnos

```sql
    insert into rols(id, nombre) VALUES (1, 'COORD')
    insert into rols(nombre) VALUES ('EST')
    insert into rols(nombre) VALUES ('PROF')
```
El rol COORD -> Es el que se encargara de crear los usuarios y roles asociados a los usuarios

```sql
    insert into usuarios(nombre, correo, password, id_rol) VALUES('Administrador', 'sergio.rios@gmail.com','$2y$12$FUq30sLT.dylLS4VJn8hCOL9Wp7m1aOAcOorIYxiRQsw5sIz4XtCK', 1)
    -- La contraseña es: sergio.rios@gmail.com
```

# Descripción de rutas

### Authentication
- POST: api/auth - Permite loguear un usuario

### Rol Controller
- GET: api/rol - Envia toda la información del controller
- GET: api/rol/id - Envia el ID del controller
- POST: api/rol - cambia el valor del rol
- PUT: api/rol/id - Reemplaza el rol por ID
- DELETE: api/rol/id - Elimina del rol creado por ID

### Asignatura Controller
- GET: api/asignatura - Envia toda la información de las asignaturas
- GET: api/asignatura/id - Envia la asignatura por id
- POST: api/asignatura - Agrega una nueva asignatura
- PUT: api/asignatura/id - Actualiza una asignatura por ID
- DELETE: api/asignatura/id - Elimina del asignatura por ID

### Usuario Controller
- GET: api/usuario - Envia toda la información de Usuario
- GET: api/usuario/id - Envia información del usuario por ID
- POST: api/usuario - Crea un nuevo usuario
- PUT: api/usuario/id - Actualiza un usuario por el ID
- DELETE: api/usuario/id - Elimina usuario por ID

### Docente
- GET: api/docente - De la lista de usuarior registrados obtiene los que son de usuarios con rol de docente