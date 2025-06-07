#!/bin/bash

# Iniciar PHP-FPM (ajusta el comando si usas otro servicio)
service php8.2-fpm start

# Iniciar nginx
service nginx start

# Mantener el script activo para que el contenedor no se cierre
tail -f /dev/null
