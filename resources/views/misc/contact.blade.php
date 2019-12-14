@extends('layouts.guest')

@section('main')
    <div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d3207.1027410586958!2d10.486249962944951!3d36.604859044949634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!3e0!4m3!3m2!1d36.606058499999996!2d10.486589799999999!4m3!3m2!1d36.606043299999996!2d10.4866102!5e0!3m2!1sfr!2stn!4v1574810263002!5m2!1sfr!2stn"
            style="border:0" allowfullscreen="" width="100%" height="380" frameborder="0"></iframe>
    </div>

    <div class="container mx-auto mt-8 flex md:flex-no-wrap flex-wrap flex-col md:flex-row px-6 sm:px-0">
        <div class="md:w-3/4 w-full">
            <h2 class="text-3xl">Contactez-nous en remplissant le formulaire de contact ci-dessous</h2>
            <form class="w-full mb-6">
                <div class="w-full">
                    <div class="-mx-3 flex">
                        <div class="px-3 w-1/2">
                            <input type="text" placeholder="* Entrez votre nom complet"
                                   class="px-5 py-3 rounded border w-full">
                        </div>
                        <div class="px-3 w-1/2">
                            <input type="text" placeholder="* Entrez votre nom complet"
                                   class="px-5 py-3 rounded border w-full">
                        </div>
                    </div>
                </div>
                <div class="my-4">
                    <input type="text" placeholder="Entrez votre sujet" class="px-5 py-3 rounded border w-full">
                </div>
                <div class="my-t mb-2">
                    <textarea placeholder="* Votre message" class="px-5 py-3 rounded border w-full"></textarea>
                </div>
                <div class="text-sm text-gray-600 mb-4">* S'il vous plaît remplir tous les champs du formulaire requis, merci!</div>
                <button type="submit" class="px-3 py-3 bg-green-600 text-white rounded">Envoyez votre message</button>
            </form>
        </div>
        <div class="md:w-1/4 w-full md:ml-3 md:pl-3 md:border-l border-t pt-4 md:pt-0 md:border-t-0">
            <h2 class="text-2xl">Informations de contact</h2>
            <h3 class="font-bold">Adresse</h3>
            <p>Rue de la Physique_Z.I 8030</p>
            <p class="mb-4">Grombalia Tunisie</p>
            <h3 class="font-bold">Numéro de Téléphone</h3>
            <p class="mb-4">(216) 72 255 674</p>
            <h3 class="font-bold">Fax</h3>
            <p class="mb-4">(216) 72 255 537</p>
            <h3 class="font-bold">E-mail</h3>
            <p class="mb-4">ste.provital@planet.tn</p>
        </div>
    </div>
@endsection
