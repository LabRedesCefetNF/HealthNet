#! /bin/bash

openssl genpkey -genparam -algorithm DH -out ../temp-keys/chaveglobal.pem
openssl genpkey -paramfile ../temp-keys/chaveglobal.pem -out ../temp-keys/privateKey.pem
openssl pkey -in ../temp-keys/privateKey.pem -pubout -out ../temp-keys/publicKey.pem

openssl enc -aes-256-cbc -pass pass:$1 -p -in ../temp-keys/privateKey.pem -out ../temp-keys/privateKeyEncrypted.pem