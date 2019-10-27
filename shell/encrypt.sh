#! /bin/bash
openssl aes-256-cbc -d -k $1 -in ../temp-keys/privateKeyEncrypted.pem -out ../temp-keys/privateKey.pem

openssl pkeyutl -derive -inkey ../temp-keys/privateKey.pem -peerkey ../temp-keys/publicKey.pem -out ../temp-keys/chaveDH.bin

base64 ../uploads/$2 > ../uploads/encoded.txt

openssl aes-256-cbc -e -kfile ../temp-keys/chaveDH.bin -in ../uploads/encoded.txt -out ../saved-files/$2

#base64 -d ../uploads/encoded.txt > ../uploads/decoded.txt