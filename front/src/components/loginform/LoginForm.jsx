import { EyeIcon } from "@heroicons/react/16/solid/index.js";
import { useState } from "react";
import { ApiData } from "../../apis/ApiData.jsx";

const LoginForm = () => {
    const [viewPassword, setViewPassword] = useState("password");

    const
        handleShowPassword = () => {
            let input = document.getElementById("password-input");
            if (input.getAttribute("type") === "password") {
                setViewPassword("text");
            } else {
                setViewPassword("password");
            }
        }

    const handleSubmit = (e) => {
        e.preventDefault();
        let form = document.getElementById("login-form");
        let formEmail = form.email.value;
        let formPassword = form.password.value;
        fetch(form.action, {
            method: form.method,
            headers: {
                "Content-type": "application/json"
            },
            credentials: 'include',
            body: JSON.stringify(
                { email: formEmail, password: formPassword }
            ),
        }).then((response) => {
            console.log(response);
        }).catch((err) => {
            console.log("VAI TOMA NO CU DESGRAÇA, FUNCIONA INFERNO.");
        })
    }

    return (

        <form id="login-form" action={(ApiData.url + "/auth/login/")} onSubmit={handleSubmit} method="POST"
            className="flex justify-center self-center mx-auto flex-col gap-5 h-2/4 w-5/6 md:w-3/5 lg:w-2/5 xl:1/5 2xl:w-1/4 items-center bg-gray-50 rounded-2xl px-10 shadow-md">
            <h1 className="font-montserrat-black font-bold uppercase text-2xl">Login</h1>
            <div
                className="flex justify-center items-start flex-col gap-1 ring-gray-500 w-full md:w-3/4">
                <label className="text-gray-500 text-sm" htmlFor="email">E-mail</label>
                <input id="email" name="email"
                    className="w-full text-gray-500 text-sm bg-gray-50 ring-1 ring-gray-300 active:ring-gray-500 focus-visible:ring-gray-400 focus-visible:ring-2 active:ring-2  px-2 py-2 rounded-md"
                    placeholder="E-mail" type="email" />
            </div>
            <div
                className="flex justify-center items-start flex-col gap-1 ring-gray-500 w-full md:w-3/4">
                <label className="text-gray-500 text-sm" htmlFor="senha">Senha</label>
                <div className="w-full relative">
                    <input id="password-input" name="password"
                        className="w-full text-gray-500 text-sm bg-gray-50 ring-1 ring-gray-300 active:ring-gray-500 focus-visible:ring-gray-400 focus-visible:ring-2 active:ring-2  px-2 py-2 rounded-md"
                        placeholder="Senha" type={viewPassword} />
                    <EyeIcon onClick={handleShowPassword}
                        className="h-4 text-gray-400 absolute top-1/2 -translate-y-1/2 right-3.5 cursor-pointer" />
                </div>
            </div>
            <div
                className="flex flex-wrap justify-between flex-row gap-1 ring-gray-500 w-full md:w-3/4">
                <div className="flex flex-row gap-1 align-middle">
                    <input className="text-xs" type="checkbox" id="scales" name="asdasd" />
                    <label className="text-xs" htmlFor="scales">Mantenha-me conectado</label>
                </div>
            </div>
            <button
                className="text-sm text-white font-semibold px-14 py-3 rounded-md border-none bg-gray-600 hover:bg-gray-500" type="submit">LOGIN
            </button>
            <div>
                <a className="text-xs" href="">Esqueceu a senha?</a>
            </div>
        </form>
    );
}

export default LoginForm;
