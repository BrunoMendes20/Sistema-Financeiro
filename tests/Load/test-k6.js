import http from "k6/http";
import { check, sleep } from "k6";

// Configuração do teste: 50 usuários simultâneos por 30 segundos
export const options = {
    vus: 50,
    duration: "30s",
};

export default function () {
    // URL do endpoint de login
    const url = "http://sistema-financeiro.test/login";

    const payload = JSON.stringify({
        email: "teste@dominio.com",
        password: "senha123",
    });

    const params = {
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    };

    const res = http.post(url, payload, params);

    check(res, {
        "bloqueado pela segurança (429)": (r) => r.status === 429,
        "passou direto (200/302)": (r) => r.status === 200 || r.status === 302,
    });

    sleep(1); // Pausa de 1 segundo entre as requisições
}
