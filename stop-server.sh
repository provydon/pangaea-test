#!/bin/bash

echo "stoping publisher"
kill $(sudo lsof -t -i:8000)

echo "stoping subscriber"
kill $(sudo lsof -t -i:7000)

echo "server has stopped running" 