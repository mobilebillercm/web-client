#!/usr/bin/env bash

sudo rabbitmqctl stop_app &&
sudo rabbitmqctl reset &&
sudo rabbitmqctl start_app