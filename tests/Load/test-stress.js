import http from "k6/http";
import { check, sleep } from "k6";

export const options = {
    stages: [
        { duration: "15s", target: 100 }, // Sobe rapidamente para 100 utilizadores em 15s
        { duration: "30s", target: 500 }, // Força o servidor subindo para 500 utilizadores
        { duration: "30s", target: 1000 }, // Pico extremo: 1000 utilizadores em simultâneo
        { duration: "15s", target: 0 }, // Desce e limpa as conexões
    ],
    thresholds: {
        // Se mais de 10% das requisições falharem (timeout/erro), o teste avisa
        http_req_failed: ["rate<0.01"],
    },
};

export default function () {
    const url = "http://sistema-financeiro.test/login";

    const res = http.get(url);

    // assegura que o servidor respondeu com sucesso (código 200)
    check(res, {
        "Servidor respondeu OK (200)": (r) => r.status === 200,
    });

    // Pequena pausa de 1 segundo entre os acessos de cada utilizador virtual
    sleep(1);
}
