#!/bin/bash



echo "freeing server ports started..."

nohup fuser -n tcp -k  8040 &&
nohup fuser -n tcp -k  8041 &&
nohup fuser -n tcp -k  8042 &&
nohup fuser -n tcp -k  8043 &&
nohup fuser -n tcp -k  8044 &&
nohup fuser -n tcp -k  8045 &&
nohup fuser -n tcp -k  8046 &&
nohup fuser -n tcp -k  8047 &&
echo "freeing server ports done..."


echo "starting to launch the servers ..."
nohup php ~/Documents/app-code/business/mobilebiller/web/artisan serve --port 8040 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/ide/artisan serve --port 8041 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/pay/artisan serve --port 8042 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/pri/artisan serve --port 8043 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/rec/artisan serve --port 8044 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/sea/artisan serve --port 8045 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/ser/artisan serve --port 8046 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/wal/artisan serve --port 8047 --host 0.0.0.0  >/dev/null 2>&1 &
echo "launching the servers done..."



echo "stopping rabbitmq ..."

nohup sudo rabbitmqctl stop_app &&

echo "rabbitmq stopped..."





echo "resetting rabbitmq ..."

nohup sudo rabbitmqctl reset &&

echo "rabbitmq reset..."





echo "starting rabbitmq ..."

nohup sudo rabbitmqctl start_app &&

echo "rabbitmq started..."





echo "WEB CLIENT STARTED"
cd ~/Documents/app-code/business/mobilebiller/web
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &

nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/account-topupped-with-cash-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/payement-with-mobile-biller-credit-account-made-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/receipt-registered-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/bulk-receipt-registered-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/service-access-registered-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/service-created-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/service-unit-price-defined-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/tenant-collaborator-registration-invitation-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/tenant-collaborator-ssl-registered-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/tenant-ssl-provisioned-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/transfere-operation-created-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/user-mobile-credit-account-created-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/web/app/Infrastructure/Messaging/user-password-changed-queue-listener.php >/dev/null 2>&1 &




echo "WEB CLIENT DONE..."


echo "IAM STARTED"
cd ~/Documents/app-code/business/mobilebiller/ide
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
echo "IAM DONE ..."


echo "PAYMENTS STARTED"
cd ~/Documents/app-code/business/mobilebiller/pay
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/pay/app/Infrastructure/Messaging/payement-with-mobile-biller-account-accepted-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/pay/app/Infrastructure/Messaging/payement-with-mobile-biller-account-failed-queue-listener.php  >/dev/null 2>&1 &
echo "PAYMENTS DONE ..."


echo "PRICNG STARTED"
cd ~/Documents/app-code/business/mobilebiller/pri
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/pri/app/Infrastructure/Messaging/service-created-queue-listener.php  >/dev/null 2>&1 &
echo "PRICNG DONE ..."


echo "RECEIPTS STARTED"
cd ~/Documents/app-code/business/mobilebiller/rec
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/rec/app/Infrastructure/Messaging/receipt-emitted-queue-listener.php  >/dev/null 2>&1 &
echo "RECEIPTS DONE ..."


echo "SERVICES ACCESS STARTED"
cd ~/Documents/app-code/business/mobilebiller/sea
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/sea/app/Infrastructure/Messaging/client-service-validity-period-changed-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/sea/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/sea/app/Infrastructure/Messaging/service-payment-with-mobile-biller-credit-account-accepted-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/sea/app/Infrastructure/Messaging/tenant-provosion-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/sea/app/Infrastructure/Messaging/subaccount-created-queue-listener.php  >/dev/null 2>&1 &
echo "SERVICES ACCESS DONE ..."


echo "SERVICES STARTED"
cd ~/Documents/app-code/business/mobilebiller/ser
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/ser/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/ser/app/Infrastructure/Messaging/tenant-provosion-queue-listener.php  >/dev/null 2>&1 &
echo "SERVICES DONE ..."

echo "WALLET STARTED"
cd ~/Documents/app-code/business/mobilebiller/wal
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/wal/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/wal/app/Infrastructure/Messaging/tenant-provisioned-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobilebiller/wal/app/Infrastructure/Messaging/service-payement-with-mobile-biller-account-initiated-queue-listener.php >/dev/null 2>&1 &
echo "WALLET DONE ..."



