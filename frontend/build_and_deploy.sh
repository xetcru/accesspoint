# До запуска делаем исполняемым: chmod +x /var/www/accesspoint_gro_usr/data/www/accesspoint.gro/frontend/build_and_deploy.sh
# Запуск: /var/www/accesspoint_gro_usr/data/www/accesspoint.gro/frontend/build_and_deploy.sh

#!/bin/bash

# Путь к директории фронтенда
FRONTEND_DIR="/var/www/accesspoint_gro_usr/data/www/accesspoint.gro/frontend"

# Путь к директории для деплоя
DEPLOY_DIR="/var/www/accesspoint_gro_usr/data/www/accesspoint.gro/public/build"

# Переход в директорию фронтенда
cd $FRONTEND_DIR || exit

# Запуск сборки
echo "Запуск сборки React-приложения..."
npm run build

# Проверка успешности сборки
if [ $? -eq 0 ]; then
    echo "Сборка успешно завершена. Перенос содержимого build в $DEPLOY_DIR..."
    
    # Удаляем старую директорию build в public, если существует
    rm -rf $DEPLOY_DIR
    
    # Переносим новую сборку
    mv $FRONTEND_DIR/build $DEPLOY_DIR
    
    echo "Содержимое успешно перенесено!"
else
    echo "Ошибка сборки! Проверьте лог выполнения npm run build."
    exit 1
fi
