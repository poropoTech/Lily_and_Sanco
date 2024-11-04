<div class="row">
    <div class="col-md-4 text-left">
        <h2>Cuida de ti,<br>cuida de nuestro entorno </h2>
        <p>Es el momento de conectar mientras aumenta nuestra
            conciencia Medioambiental. Es el momento de sentirnos más
            cerca los unos de los otros mientras asimilamos nuevos
            hábitos y compartimos experiencias y aprendizajes. De esta
            manera reforzaremos nuestro propio BIENESTAR y el del
            entorno en el que vivimos.
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-center d-md-flex align-content-start justify-content-center">
        @foreach($categories as $category)
            <x-frontend.category.category-card :category="$category" :newActivities="$newActivities[$category->id]"/>
        @endforeach
    </div>
</div>
