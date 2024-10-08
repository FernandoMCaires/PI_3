import { Head } from '@inertiajs/react';
import Header from '../../components/Header'; // Ajuste o caminho se necessário
import Nav from '../../components/Nav'; // Ajuste o caminho se necessário

export default function Home({ categorias }) {
    return (
        <>
            <Head title="Home" />
            <Header />
            <Nav categorias={categorias} /> {/* Passa as categorias para o Nav */}
            
        </>
    );
}
