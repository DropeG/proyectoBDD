# Entrega 0 - Bases de datos IIC2413

**Nombre:** Pedro González Honorato
**Número de Alumno:** 24664251
### Credenciales de acceso
**Usuario Uc** pedro.gonzlez@bdd1.ing.puc.cl
**Contraseña** 24664251


## Contenido del Informe

### 1. Análisis de los datos entregados en los archivos

- **Archivo `usuarios_rescatados.csv`**: Contiene información sobre los usuarios y sus reservas en la plataforma Booked.com. Las columnas son:
  - `nombre`: String, nombre completo del usuario, admite nulo.
  - `run`: Integer, Rol Único Nacional, no nulo.
  - `dv`: String, dígito verificador del RUN, valores posibles 0-9, K o k, no nulo.
  - `correo`: String, correo electrónico del usuario, no nulo.
  - `nombre_usuario`: String, nombre de usuario en la web, admite nulo.
  - `contrasena`: String, contraseña del usuario, admite nulo.
  - `telefono_contacto`: String, teléfono de contacto en formato `[código de país] X XXXX XXXX`, no nulo.
  - `puntos`: Integer, puntuación del usuario en la aplicación, admite nulo.
  - `codigo_agenda`: Integer, código único para identificar una agenda, no nulo.
  - `etiqueta`: String, temática de la agenda de viaje, admite nulo.
  - `codigo_reserva`: Integer, código único para identificar una reserva, no nulo.
  - `fecha`: Date, fecha de la reserva en formato `YYYY-MM-DD`, admite nulo.
  - `monto`: Float, precio en pesos de la reserva, no nulo.
  - `cantidad_personas`: Integer, cantidad de personas en la reserva, admite nulo.

- **Archivo `empleados_rescatados.csv`**: Contiene información sobre los empleados y las reservas de transporte donde un empleado es el conductor asignado. Las columnas son:
  - `nombre`: String, nombre completo del empleado, admite nulo.
  - `run`: Integer, Rol Único Nacional, no nulo.
  - `dv`: String, dígito verificador del RUN, valores posibles 0-9, K o k, no nulo.
  - `correo`: String, correo electrónico del empleado, no nulo.
  - `nombre_usuario`: String, nombre de usuario en la web, admite nulo.
  - `contrasena`: String, contraseña del empleado, no nulo.
  - `telefono_contacto`: String, teléfono de contacto en formato `[código de país] X XXXX XXXX`, no nulo.
  - `jornada`: String, diurno o nocturno, admite nulo.
  - `isapre`: String, nombre de la isapre, admite nulo.
  - `contrato`: String, tipo de contrato (part time o full time), admite nulo.
  - `codigo_reserva`: Integer, código único para identificar una reserva, no nulo.
  - `codigo_agenda`: Integer, código único para identificar una agenda, admite nulo.
  - `fecha`: Date, fecha de la reserva en formato `YYYY-MM-DD`, admite nulo.
  - `monto`: Float, precio en pesos de la reserva, no nulo.
  - `cantidad_personas`: Integer, cantidad de personas en la reserva, admite nulo.
  - `estado_disponibilidad`: String, estado de la reserva ("Disponible" o "No disponible"), admite nulo.
  - `numero_viaje`: Integer, identificador del viaje, no nulo.
  - `lugar_origen`: String, lugar de origen, solo letras, admite nulo.
  - `lugar_llegada`: String, lugar de llegada, solo letras, admite nulo.
  - `fecha_salida`: Date, fecha de salida del transporte en formato `YYYY-MM-DD`, admite nulo.
  - `fecha_llegada`: Date, fecha de llegada del transporte en formato `YYYY-MM-DD`, no nulo.
  - `capacidad`: Integer, cantidad máxima del viaje, admite nulo.
  - `tiempo_estimado`: Integer, tiempo en minutos del viaje, admite nulo.
  - `precio_asiento`: Integer, valor individual del viaje, no nulo.
  - `empresa`: String, empresa de transporte, admite nulo.
  - `tipo_de_bus`: String, tipo de bus (normal, semi-cama, cama), admite nulo.
  - `comodidades`: String array, lista de comodidades del transporte, admite nulo.
  - `escalas`: String array, lista de escalas de un avión, admite nulo.
  - `clase`: String, tipo de asiento en aviones (primera clase, clase ejecutiva, clase económica), admite nulo.
  - `paradas`: String array, lista de paradas de un tren, admite nulo.

### 2. Tipos de errores de datos detectados por el programa y forma de solución utilizada

#### Archivo `usuarios_rescatados.csv`:
- **RUN no válido**: Algunos RUNs contenían puntos o guiones, o no eran números naturales mayores o iguales a 1.
  - **Solución**: Se eliminaron puntos y guiones, y se verificó que el valor fuera un número entero positivo. Los registros que no cumplían se descartaron y se enviaron a `datos_descartados_usuarios.csv`.
- **Dígito verificador (DV) no válido**: Algunos DVs no eran un solo carácter o no estaban en el rango permitido (0-9, K, k).
  - **Solución**: Se verificó que el DV fuera un solo carácter y estuviera en el rango permitido. Los registros que no cumplían se descartaron.
- **Correo no válido**: Algunos correos no tenían el formato correcto o usaban dominios no permitidos.
  - **Solución**: Se verificó que el correo tuviera al menos una letra antes del `@` y que el dominio estuviera en la lista permitida (`viajes.cl`, `tourket.com`, etc.). Los registros con correos inválidos se descartaron.
- **Teléfono de contacto no válido**: Algunos teléfonos no seguían el formato `[código de país] X XXXX XXXX` o no tenían 9 dígitos después del código de país.
  - **Solución**: Se eliminaron espacios y guiones, se verificó que el código de país fuera `+56`, y que el número tuviera 9 dígitos. Los registros que no cumplían se descartaron.
- **Códigos de agenda y reserva no válidos**: Algunos códigos no eran enteros o eran nulos.
  - **Solución**: Se verificó que fueran enteros y no nulos. Los registros que no cumplían se descartaron.
- **Fecha no válida**: Algunas fechas no estaban en formato `YYYY-MM-DD` o no eran fechas válidas.
  - **Solución**: Se convirtieron fechas en formato `YYYY/MM/DD` a `YYYY-MM-DD` y se verificó que fueran fechas válidas usando `checkdate`. Los registros con fechas inválidas se descartaron.
- **Monto no válido**: Algunos montos no eran números o eran negativos.
  - **Solución**: Se verificó que el monto fuera un número positivo y se formateó a 2 decimales. Los registros que no cumplían se descartaron.

#### Archivo `empleados_rescatados.csv`:
- **Contraseña nula**: Algunos empleados tenían contraseña nula, lo cual no está permitido.
  - **Solución**: Los registros con contraseña nula se descartaron y se enviaron a `datos_descartados_empleados.csv`.
- **Fecha de llegada no válida o nula**: Algunas fechas de llegada no estaban en formato `YYYY-MM-DD`, no eran fechas válidas, o eran nulas (lo cual no está permitido).
  - **Solución**: Se verificó que la fecha de llegada no fuera nula y estuviera en el formato correcto. Los registros que no cumplían se descartaron.
- **Lugar de origen y llegada con símbolos**: Algunos lugares contenían números o símbolos, lo cual no está permitido.
  - **Solución**: Se filtraron los caracteres para que solo quedaran letras. Si el resultado era vacío, el registro se descartaba.
- **Precio de asiento no válido**: Algunos precios no eran enteros o eran nulos.
  - **Solución**: Se verificó que el precio fuera un entero y no nulo. Los registros que no cumplían se descartaron.

### 3. Nombre de los archivos de salida y explicación de su contenido

- **Archivo `personasOK.csv`**: Contiene los datos comunes de las personas (tanto usuarios como empleados) después de la limpieza. Columnas: `Nombre`, `Run`, `Dv`, `Correo`, `Contrasena`, `Nombre_usuario`, `Telefono_contacto`.
- **Archivo `usuariosOK.csv`**: Contiene los datos de los usuarios después de la limpieza. Columnas: `Nombre`, `Run`, `Dv`, `Correo`, `Contrasena`, `Nombre_usuario`, `Telefono_contacto`, `Puntos`.
- **Archivo `empleadosOK.csv`**: Contiene los datos de los empleados después de la limpieza. Columnas: `Nombre`, `Run`, `Dv`, `Correo`, `Contrasena`, `Nombre_usuario`, `Telefono_contacto`, `Jornada`, `Isapre`, `Contrato`.
- **Archivo `agendasOK.csv`**: Contiene los datos de las etiquetas de agenda de los usuarios. Columnas: `Correo_usuario`, `Codigo_agenda`, `Etiqueta`.
- **Archivo `reservasOK.csv`**: Contiene los datos de las reservas de los usuarios. Columnas: `Codigo_agenda`, `Codigo_reserva`, `Fecha`, `Monto`, `Cantidad_personas`, `Estado_disponibilidad`.
- **Archivo `transportesOK.csv`**: Contiene los datos generales de los transportes asignados a empleados. Columnas: `Correo_empleado`, `Codigo_reserva`, `Numero_viaje`, `Lugar_origen`, `Lugar_llegada`, `Capacidad`, `Tiempo_estimado`, `Precio_asiento`, `Empresa`, `Fecha_salida`, `Fecha_llegada`.
- **Archivo `busesOK.csv`**: Contiene los datos de los buses asignados a empleados. Columnas: `Correo_empleado`, `Codigo_reserva`, `Numero_viaje`, `Lugar_origen`, `Lugar_llegada`, `Capacidad`, `Tiempo_estimado`, `Precio_asiento`, `Empresa`, `Tipo`, `Comodidades`, `Fecha_salida`, `Fecha_llegada`.
- **Archivo `trenesOK.csv`**: Contiene los datos de los trenes asignados a empleados. Columnas: `Correo_empleado`, `Codigo_reserva`, `Numero_viaje`, `Lugar_origen`, `Lugar_llegada`, `Capacidad`, `Tiempo_estimado`, `Precio_asiento`, `Empresa`, `Comodidades`, `Paradas`, `Fecha_salida`, `Fecha_llegada`.
- **Archivo `avionesOK.csv`**: Contiene los datos de los aviones asignados a empleados. Columnas: `Correo_empleado`, `Codigo_reserva`, `Numero_viaje`, `Lugar_origen`, `Lugar_llegada`, `Capacidad`, `Tiempo_estimado`, `Precio_asiento`, `Empresa`, `Escalas`, `Clase`, `Fecha_salida`, `Fecha_llegada`.
- **Archivo `datos_descartados_usuarios.csv`**: Contiene los registros de usuarios que no pasaron los filtros de limpieza. Tiene las mismas columnas que `usuarios_rescatados.csv`.
- **Archivo `datos_descartados_empleados.csv`**: Contiene los registros de empleados que no pasaron los filtros de limpieza. Tiene las mismas columnas que `empleados_rescatados.csv`.


### 4. Instrucciones para ejecutar el programa
Es fundamental proporcionar instrucciones claras para ejecutar el programa (absolutamente todos los pasos necesarios, como si fueras a ejecutarlo de cero). Por ejemplo:

- **Archivo `main.php`**: Es el archivo principal que ejecuta el programa para la limpieza de datos. Lee los archivos de entrada, aplica los filtros, y genera los archivos de salida.
- **Archivo `funciones.php`**: Contiene las funciones auxiliares para leer los CSV, aplicar los filtros de limpieza, y escribir los archivos de salida.

1. Credenciales para conectar al servidor:
    usuario: pedro.gonzlez
    contraseña: 24664251
2. Conexión al servidor mediante ssh:
    ejecutar el comando ssh pedro.gonzlez@bdd1.ing.puc.cl
    colocar contraseña '24664251'
3. Ejecutar el archivo main.php
    dirigirse a ./Sites/E0/archivos/
    ejecutar el comando: php main.php
    esperar a que termine el proceso
