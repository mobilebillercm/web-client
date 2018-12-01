#!/bin/bash


echo "stopping rabbitmq ..."



nohup service rabbitmq-server stop &&


echo "rabbitmq stopped..."



echo "starting rabbitmq ..."


nohup service rabbitmq-server start &&


echo "rabbitmq started..."

echo "WEB CLIENT STARTED"
cd /var/www/html/mobilebiller/web
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &

nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/account-topupped-with-cash-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/payement-with-mobile-biller-credit-account-made-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/receipt-registered-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/bulk-receipt-registered-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/service-access-registered-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/service-created-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/service-unit-price-defined-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/tenant-collaborator-registration-invitation-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/tenant-collaborator-ssl-registered-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/tenant-ssl-provisioned-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/transfere-operation-created-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/user-mobile-credit-account-created-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/web/app/Infrastructure/Messaging/user-password-changed-queue-listener.php >/dev/null 2>&1 &




echo "WEB CLIENT DONE..."


echo "IAM STARTED"
cd /var/www/html/mobilebiller/ide
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
echo "IAM DONE ..."


echo "PAYMENTS STARTED"
cd /var/www/html/mobilebiller/pay
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/pay/app/Infrastructure/Messaging/payement-with-mobile-biller-account-accepted-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/pay/app/Infrastructure/Messaging/payement-with-mobile-biller-account-failed-queue-listener.php  >/dev/null 2>&1 &
echo "PAYMENTS DONE ..."


echo "PRICNG STARTED"
cd /var/www/html/mobilebiller/pri
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/pri/app/Infrastructure/Messaging/service-created-queue-listener.php  >/dev/null 2>&1 &
echo "PRICNG DONE ..."


echo "RECEIPTS STARTED"
cd /var/www/html/mobilebiller/rec
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/rec/app/Infrastructure/Messaging/receipt-emitted-queue-listener.php  >/dev/null 2>&1 &
echo "RECEIPTS DONE ..."


echo "SERVICES ACCESS STARTED"
cd /var/www/html/mobilebiller/sea
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/sea/app/Infrastructure/Messaging/client-service-validity-period-changed-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/sea/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/sea/app/Infrastructure/Messaging/service-payment-with-mobile-biller-credit-account-accepted-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/sea/app/Infrastructure/Messaging/tenant-provosion-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/sea/app/Infrastructure/Messaging/subaccount-created-queue-listener.php  >/dev/null 2>&1 &
echo "SERVICES ACCESS DONE ..."


echo "SERVICES STARTED"
cd /var/www/html/mobilebiller/ser
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/ser/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/ser/app/Infrastructure/Messaging/tenant-provosion-queue-listener.php  >/dev/null 2>&1 &
echo "SERVICES DONE ..."

echo "WALLET STARTED"
nohup php /var/www/html/mobilebiller/wal/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/wal/app/Infrastructure/Messaging/tenant-provisioned-queue-listener.php >/dev/null 2>&1 &
nohup php /var/www/html/mobilebiller/wal/app/Infrastructure/Messaging/service-payement-with-mobile-biller-account-initiated-queue-listener.php >/dev/null 2>&1 &
echo "WALLET DONE ..."



