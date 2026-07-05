/* Tablas primera versión */

/* se registran las marcas en donde se almacena la informacion de las marcas
 que se comercializa */

create table marcas (
 id int primary key bigserial,
 nombre varchar(255) not null,
 descripcion varchar(255) null,
 estado boolean not null default true
);

/* Se registran las categorias en donde se almacena la información de las categorias que se 
comercializan */

create table categorias ( 
 id int primary key bigserial, 
 nombre varchar (255) not null
 descripcion varchar(255),
 estado boolean not null default true
);
 
/* En esta tabla se va almacenar información de las subcategorias que se asocia a cada categoria. */

create table sub_categorias(
 id int primary key bigserial,
 nombre varchar(255) not null
 descripcion varchar(255),
 categoria_id int not null,
 estado boolean not null default true,
 foreign key (categoria_id) references categorias(id)
);

/* En esta tabla se almacenaría toda la información de los productos que se comercializan 
en el local BNL motos */

create table productos (
 id bigserial primary key,
 codigo varchar(255) not null unique,
 codigo_barra varchar(255) unique,
 nombre varchar(255) not null,
 descripcion text,
 precio_costo decimal(12,2) not null,
 porcentaje_ganancia decimal (5,2) default 0.00,
 precio_venta decimal(12,2) not null,
 stock_actual int not null default 0,
 stock_minimo int not null default 0,
estado boolean not null default true,
 marca_id int not null,
 subcategoria_id int not null,
 foreign key(marca_id) references marcas(id),
 foreign key(subcategoria_id) references sub_categorias(id)
);

/* tipos_clientes es la tabla que contendrá información sobre los diferentes tipos de clientes y un descuento que se puede aplicar.
 por ejemplo si el cliente es un cliente UBER - DIDI - DELIBERY - MECANICO Y se le aplica un descuento. */

create table tipos_clientes(
   id int primary key bigserial,
   nombre varchar(255) not null,
   estado boolean not null default true,
   descuento int not null default 0
);

/* genero es la tabla que contiene la información sobre los diferentes tipos de genero que existen */

create table genero (
   id int primary key bigserial,
   nombre varchar(255) not null
);

/* fecha nacimiento se almacena para la posibilidad de enviar mensajes de cumpleaños a los clientes
 para aplicar bonificaciones en cumpleaños. */

create table clientes (
 id int primary key bigserial,
 nombre varchar(255) not null,
 apellido varchar(255) not null,
 email varchar(255) not null,
 telefono varchar(50),
 direccion varchar(255),
 estado boolean not null default true,
 fecha_nacimiento date not null,
 genero_id int not null,
 foreign key(genero_id) references generos(id),
 tipo_cliente_id int not null,
 foreign key(tipo_cliente_id) references tipos_clientes(id)
);

/* tabla de configuración para almacenar las diferentes formas de pago que se utilizan en el local. */

create table condicion_pago(
 id int primary key bigserial,
 descripcion varchar(255) not null,
 estado boolean not null default true
);

/* En esta tabla de bd se almacenarán todas las ventas que se realicen en el local BNL motos,
el mismo se relaciona al cliente, usuario. */

create table ventas(
 id int primary key bigserial,
 cliente_id int null,
 fecha date not null default current_date(),
 hora time not null default current_time(),
 nro_comprobante int not null,
 subtotal decimal(10,2) not null,
 total decimal(10,2) not null
);

/* Se almacena los articulos asociados a una venta. */

create table ventas_detalle(
 id int primary key bigserial,
 venta_id int not null,
 producto_id int not null,
 cantidad int not null,
 precio_unitario decimal(10,2) not null,
foreign key(venta_id) references ventas(id),
foreign key(producto_id) references productos(id)
);

/* Se almacena las condiciones de pago que aplican a cada venta.*/

create table ventas_condicion_pago(
 id int primary key bigserial,
 venta_id int not null,
 condicion_pago_id int not null,
 importe decimal(10,2) not null,
 interes_aplicado int,
 importe_final decimal(10,2) not null,
 foreign key(venta_id) references ventas(id),
 foreign key(condicion_pago_id) references condicion_pago(id)
);