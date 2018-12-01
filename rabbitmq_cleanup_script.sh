#!/bin/bash



echo "stopping rabbitmq ..."

nohup sudo rabbitmqctl stop_app &&

echo "rabbitmq stopped..."





echo "resetting rabbitmq ..."

nohup sudo rabbitmqctl reset &&

echo "rabbitmq reset..."





echo "starting rabbitmq ..."

nohup sudo rabbitmqctl start_app &&

echo "rabbitmq started..."



