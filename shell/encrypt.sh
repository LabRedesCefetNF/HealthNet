#! /bin/bash
openssl base64 -d -in ../temp-keys/privateKeyEncrypted.pem.64 -out ../temp-keys/privateKeyEncrypted.pem

openssl aes-256-ecb -d -pass pass:$1 -nosalt -in ../temp-keys/privateKeyEncrypted.pem -out ../temp-keys/privateKey.pem

openssl pkeyutl -derive -inkey ../temp-keys/privateKey.pem -peerkey ../temp-keys/publicKey.pem -out ../temp-keys/chaveDH.bin

openssl base64 -d -in ../uploads/$2 -out ../uploads/encoded.txt

openssl aes-256-cbc -e -kfile ../temp-keys/chaveDH.bin -in ../uploads/encoded.txt -out ../saved-files/$2
