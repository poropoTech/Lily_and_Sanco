Una vez clonado del repositorio o descomprimido en el directorio root:

Desde el directorio root:

composer install
npm ci
cp .env.example .env

Completar los datos de configuración en el nuevo fichero .env

Dar permisos rw al usuario del servidor web a estos directorios desde root

/storage

crear las rutas desde root con permisos de rw al usuario del servidor web:

storage/app/public/files/thumbs
storage/app/public/files/uploads
storage/app/public/media-library

php artisan key:generate
php artisan storage:link (en entornos chroot crear el enlace manualmente con ln -s)
php artisan migrate
php artisan db:seed

npm run production

php artisan queue:work //Cola para envío de notificaciones
php artisan schedule:work //Notificaciones programadas

ATENCION! Por problemas con el paquete ResponsiveFileManager, no se puede
utiliar la cache de configuración (artisan config:cache). Se deberá ejecutar
artisan config:clear


+ Notificaciones

Las notificaciones a usuarios hacen uso de colas (Queues) para el envío de correos
electrónicos y de Scheduling para la programación de los envíos para aquellas no
disparadas por eventos.



