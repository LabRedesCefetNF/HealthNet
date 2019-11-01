#! /bin/bash
if [ -f ./chaveglobal.pem ]
then
	.
	.
else   
	openssl genpkey -genparam -algorithm DH -out chaveglobal.pem
fi
openssl genpkey -paramfile chaveglobal.pem -out ../temp-keys/privateKey.pem
openssl pkey -in ../temp-keys/privateKey.pem -pubout -out ../temp-keys/publicKey.pem

openssl aes-256-ecb -e -pass pass:$1 -nosalt -in ../temp-keys/privateKey.pem -out ../temp-keys/privateKeyEncrypted.pem

openssl base64 -in ../temp-keys/privateKeyEncrypted.pem -out ../temp-keys/privateKeyEncrypted.pem.64