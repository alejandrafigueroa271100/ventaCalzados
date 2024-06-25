-- permisos
insert into permiso (id, nombre, descripcion, estado) values(1, 'roles', 'Gestión de roles de usuarios', 1);
insert into permiso (id, nombre, descripcion, estado) values(2, 'usuarios', 'Gestión de usuarios', 1);
insert into permiso (id, nombre, descripcion, estado) values(3, 'clientes', 'Gestión de clientes', 1);
insert into permiso (id, nombre, descripcion, estado) values(4, 'empleados', 'Gestión de empleados', 1);
insert into permiso (id, nombre, descripcion, estado) values(5, 'categorias', 'Gestión de categorias', 1);
insert into permiso (id, nombre, descripcion, estado) values(6, 'productos', 'Gestión de productos', 1);


-- rol
insert into rol (id, nombre) values (1, 'administrador')

-- empleado
insert into empleado (id_empleado, nombre, apellidos, telefono, direccion, sueldo)
values (1, 'alejandra', 'figueroa huanca', 78454541, 'santa cruz', 3000)

-- usuario
insert into users (id, name, password, email, estado, id_rol, id_empleado) values (1, 'administrador', '$2y$10$VxsA4OYKnf.oE4ySmulV3.fK9SQ4dPfERTT.2VjqktOWhV.JBlSv6', 'admin@gmail.com', 1, 1, 1);

-- permisos rol administrador
insert into permiso_rol (id_permiso, id_rol) values (1, 1);
insert into permiso_rol (id_permiso, id_rol) values (2, 1);
insert into permiso_rol (id_permiso, id_rol) values (3, 1);
insert into permiso_rol (id_permiso, id_rol) values (4, 1);
insert into permiso_rol (id_permiso, id_rol) values (5, 1);
insert into permiso_rol (id_permiso, id_rol) values (6, 1);

