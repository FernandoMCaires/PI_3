import './index.css'
export default function Nav({ categorias }) {
    return (
        <nav>
            <ul className="lista-categorias">
                {categorias.map((categoria) => (
                    <li key={categoria.id}>{categoria.CATEGORIA_NOME}</li> 
                ))}
            </ul>
        </nav>
    );
}
