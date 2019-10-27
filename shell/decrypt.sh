#! /bin/bash
openssl aes-256-cbc -d -k $1 -in ../temp-keys/privateKeyEncrypted.pem -out ../temp-keys/privateKey.pem

openssl pkeyutl -derive -inkey ../temp-keys/privateKey.pem -peerkey ../temp-keys/publicKey.pem -out ../temp-keys/chaveDH.bin

openssl aes-256-cbc -d -kfile ../temp-keys/chaveDH.bin -in ../saved-files/$2.txt -out ../downloads/$2

base64 -d ../downloads/$2 > ../downloads/$2