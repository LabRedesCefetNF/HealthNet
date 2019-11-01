#! /bin/bash
openssl base64 -d -in ../temp-keys/privateKeyEncrypted.pem.64 -out ../temp-keys/privateKeyEncrypted.pem

openssl aes-256-ecb -d -pass pass:$1 -nosalt -in ../temp-keys/privateKeyEncrypted.pem -out ../temp-keys/privateKey.pem

openssl pkeyutl -derive -inkey ../temp-keys/privateKey.pem -peerkey ../temp-keys/publicKey.pem -out ../temp-keys/chaveDH.bin
openssl aes-256-cbc -d -kfile ../temp-keys/chaveDH.bin -in ../saved-files/$2 -out ../downloads/enconded.txt

openssl base64 -d -in ../downloads/enconded.txt -out ../downloads/decoded.txt