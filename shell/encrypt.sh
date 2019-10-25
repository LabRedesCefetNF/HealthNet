#! /bin/bash

openssl enc -aes-256-cbc -d -pass pass:$1 -p -in ../temp-keys/privateKeyEncrypted.pem -out ../temp-keys/privateKey.pem