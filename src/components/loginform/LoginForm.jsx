import {BeakerIcon} from '@heroicons/react';

const LoginForm = () => {

    return (
        <section
            className="flex justify-center self-center mx-auto flex-col gap-5 h-2/4 w-80 md:w-1/5 items-center bg-gray-50 rounded-2xl px-10 shadow-md">
            <div
                className="flex justify-center items-start flex-col gap-1 ring-gray-500 w-full md:w-3/4">
                <label className="text-gray-500 text-sm" htmlFor="email">E-mail</label>
                <input id="email" name="email"
                       className="w-full text-gray-500 text-sm bg-gray-50 ring-1 ring-gray-300 active:ring-gray-500 focus-visible:ring-gray-400 focus-visible:ring-2 active:ring-2  px-2 py-2 rounded-md"
                       placeholder="E-mail" type="email"/>
            </div>
            <div
                className="flex justify-center items-start flex-col gap-1 ring-gray-500 w-full md:w-3/4">
                <label className="text-gray-500 text-sm" htmlFor="senha">Senha</label>
                <input id="senha" name="Senha"
                       className="w-full text-gray-500 text-sm bg-gray-50 ring-1 ring-gray-300 active:ring-gray-500 focus-visible:ring-gray-400 focus-visible:ring-2 active:ring-2  px-2 py-2 rounded-md"
                       placeholder="Senha" type="password"/>
                <BeakerIcon/>
            </div>
            <button
                className="text-sm text-white font-semibold px-4 py-2 rounded-md border-none bg-amber-500 ring-amber-500 hover:bg-amber-700">Logar
            </button>
        </section>
    );
}

export default LoginForm;
