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
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/artisan serve --port 8040 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/identity-and-access/artisan serve --port 8041 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/payments/artisan serve --port 8042 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/pricing/artisan serve --port 8043 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/receipts/artisan serve --port 8044 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/service-access/artisan serve --port 8045 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/services/artisan serve --port 8046 --host 0.0.0.0 >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/wallet/artisan serve --port 8047 >/dev/null 2>&1 &
echo "launching the servers done..."


echo "WEB CLIENT STARTED"
cd ~/Documents/app-code/business/mobile-biller-php/web-client
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &

nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/tenant-ssl-provisioned-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/tenant-collaborator-registration-invitation-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/service-created-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/tenant-collaborator-ssl-registered-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/service-unit-price-defined-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/account-topupped-with-cash-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/user-mobile-credit-account-created-queue-listener.php >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/web-client/app/Infrastructure/Messaging/transfere-operation-created-queue-listener.php >/dev/null 2>&1 &


echo "WEB CLIENT DONE..."


echo "IAM STARTED"
cd ~/Documents/app-code/business/mobile-biller-php/identity-and-access
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
echo "IAM DONE ..."


echo "PAYMENTS STARTED"
cd ~/Documents/app-code/business/mobile-biller-php/payments
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &
echo "PAYMENTS DONE ..."


echo "PRICNG STARTED"
nohup php ~/Documents/app-code/business/mobile-biller-php/pricing/app/Infrastructure/Messaging/service-created-queue-listener.php  >/dev/null 2>&1 &
echo "PRICNG DONE ..."


echo "RECEIPTS STARTED"
nohup php ~/Documents/app-code/business/mobile-biller-php/receipts/app/Infrastructure/Messaging/receipt-emitted-queue-listener.php  >/dev/null 2>&1 &
echo "RECEIPTS DONE ..."


echo "SERVICES ACCESS STARTED"
cd ~/Documents/app-code/business/mobile-biller-php/service-access
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &

nohup php ~/Documents/app-code/business/mobile-biller-php/service-access/app/Infrastructure/Messaging/client-service-validity-period-changed-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/service-access/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
echo "SERVICES ACCESS DONE ..."


echo "SERVICES STARTED"
cd ~/Documents/app-code/business/mobile-biller-php/service-access
nohup php artisan queue:work --tries=3 --timeout=500 >/dev/null 2>&1 &

nohup php ~/Documents/app-code/business/mobile-biller-php/services/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/services/app/Infrastructure/Messaging/tenant-provosion-queue-listener.php  >/dev/null 2>&1 &

echo "SERVICES DONE ..."

echo "WALLET STARTED"
nohup php ~/Documents/app-code/business/mobile-biller-php/wallet/app/Infrastructure/Messaging/user-registered-queue-listener.php  >/dev/null 2>&1 &
nohup php ~/Documents/app-code/business/mobile-biller-php/wallet/app/Infrastructure/Messaging/tenant-provisioned-queue-listener.php >/dev/null 2>&1 &
echo "WALLET DONE ..."



