@extends ('layout')

@section('contenu')

    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                    <a href="tome/{{$manga->id}}">
                        <div class="card">
                            <img class="cover" src="<?= asset('assets/mangas/') ?>{{$manga->manga_jacket}}" alt="">
                            <h1 class="white">{{$manga->manga_name}}</h1>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->
$TTL 86400
codesieg.fr.    IN    SOA   ns329374.ip-37-187-116.eu. hostmaster.codesieg.fr. (
                2013121206  ; serial à changer à chaque modification
                43200       ; refresh, 12h
                3600        ; retry, 1h
                1209600     ; expire
                86400 )     ; negative cache, 24h
codesieg.fr.    IN     NS   ns329374.ip-37-187-116.eu.
codesieg.fr.    IN     NS   ns.kimsufi.com.
codesieg.fr.    IN     A    37.187.116.62
www             IN     A    37.187.116.62
;
;mail           IN     A    37.187.116.62
;codesieg.fr.   IN     A    37.187.116.62
;codesieg.fr.   IN     MX   10 codesieg.fr.

named-checkzone codesieg.fr db.codesieg.fr