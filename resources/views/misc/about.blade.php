@extends('layouts.guest')

@section('main')
    <h1 class="font-bold text-3xl sm:px-24 px-6 my-4">À notre sujet</h1>
    <div class="px-6 sm:px-24 flex flex-col-reverse lg:flex-row">
        <div class="lg:w-1/2 w-full">
            <h3 class="font-bold text-2xl mb-3">À propos de Provital</h3>
            <p class="mb-2"> Promue en 1979 par Monsieur Rachid NAJAR, PROVITAL est une entreprise spécialisée dans la nutrition
                animale
                implantée dans la zone industrielle de Grombalia à environ 35 km de Tunis. Elle produit des aliments,
                compléments minéralo-vitaminiques ( CMV ) et additifs ; mais surtout apporte des solutions
                nutritionnelles pour
                les animaux d'élevage. De par son expérience, son savoir faire et ses compétences, PROVITAL est parvenue
                à se
                faire une image de partenaire privilégié de l'éleveur.
            </p>
            <p class="mb-3">
                PROVITAL répond aussi aux attentes des usines d'aliments quelques soient leurs capacités de production,
                en
                mettant à leur disposition, en plus des CMV dont elles ont besoin, de la matière première nécessaire (
                Maïs,
                Tourteaux de Soja, Luzerne, Son ) , importée selon les normes internationales. Ces normes sont
                rigoureusement
                régies par GAFTA ( Grain And Feed Association ), un organisme internationalement reconnu et dont
                PROVITAL est
                adhérent.
            </p>
            <h3 class="font-bold text-2xl mb-2">PROVITAL est en outre</h3>
            <ul class="mb-4">
                <li> 40 000 Tonnes d'aliments produits / an</li>
                <li>38 000m² de surface couverte</li>
                <li>25 000 Tonnes de capacité de stockage en vertical</li>
                <li>15 000 Tonnes de capacité de stockage en horizontal</li>
                <li>Un laboratoire doté des équipements les plus récents 100 collaborateurs</li>
                <li>Une logistique efficace et adaptée aux besoins des clients, assurée par sa filiale T.M.T ( Transport
                    Maritime et Terrestre )
                </li>
            </ul>
            <h3 class="font-bold text-2xl mb-3">Nos Atouts</h3>
            <ul class="mb-8 list-inside">
                <li> Nos produits sont à base végétale exempte de dioxine, de farine animale et de tous autres produits
                    toxiques.
                </li>
                <li> Nous contrôlons en amont et en aval tous nos produits fabriqués pour qu’ils répondent aux normes de
                    qualités exigées
                </li>
                <li>Nous sommes constamment à l’écoute de nos clients pour pouvoir leur prêter assistance et conseil.
                </li>
                <li>Nous investissons dans l’activité de recherche et développement pour une meilleure satisfaction de
                    notre
                    clientèle.
                </li>
                <li>Nous disposons d’un parc de camions et citernes permettant de faire des livraisons à domicile.</li>
                <li>Un système de production flexible et réactif permettant de répondre à des commandes et d’élaborer
                    des
                    produits à la carte.
                </li>
            </ul>
        </div>
        <div class="lg:w-1/2 mx-auto w-full mb-12">
            <iframe class="mx-auto" src="http://player.vimeo.com/video/24535181?title=0&amp;byline=0" seamless="" width="500"
                    height="281"></iframe>
        </div>
    </div>

@endsection
