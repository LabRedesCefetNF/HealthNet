#! /bin/bash
main(){
    clear
    echo "Selecion uma opção:"
    echo "1 - Cifrar"
    echo "2 - Decifrar"
    read opcao

    case $opcao in
        "1")
            clear
            cifrar_arquivo
        ;;
        "2")
            clear
            decifrar_arquivo
        ;;
    esac
}

gerar_chave_diffie_hellman()
{
    echo "Informe a chave PRIVADA"
    read chave_privada

    echo "Informe a chave PUBLICA"
    read chave_publica

    #gerando chave devirava da privada + publica
    openssl pkeyutl -derive -inkey $chave_privada -peerkey $chave_publica -out chaveDiffieHellman.bin
}

cifrar_arquivo()
{
    clear
    echo "----- CIFRANDO -----"

    echo "Informe o nome do arquivo:"
    read nome_arquivo

    nome_arquivo_resultado="$nome_arquivo.cifrado"

    gerar_chave_diffie_hellman

    openssl aes-256-cbc -e -kfile chaveDiffieHellman.bin -in $nome_arquivo -out $nome_arquivo_resultado
}

decifrar_arquivo()
{
    clear
    echo "----- DECIFRANDO -----"
    
    echo "Informe o nome do arquivo:"
    read nome_arquivo

    nome_arquivo_resultado="$nome_arquivo.decifrado"
    
    gerar_chave_diffie_hellman

    openssl aes-256-cbc -d -kfile chaveDiffieHellman.bin -in $nome_arquivo -out $nome_arquivo_resultado
}

main