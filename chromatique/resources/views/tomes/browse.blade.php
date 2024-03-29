@extends ('layout')

@section('contenu')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <!-- TODO : Création du breadcrumb
                         <a href="./categories.html">Categories</a>
                        <span>Adventure</span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="<?= asset('storage/mangas/') ?>{{$mangaDetails->manga_directory . "/" . $mangaDetails->manga_cover }}">
                            <!--TODO <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $mangaDetails->manga_name }}</h3>
                                <!-- <span>フェイト／ステイナイト, Feito／sutei naito</span> -->
                            </div>
                            <!-- TODO <div class="anime__details__rating">
                                <div class="rating">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-half-o"></i></a>
                                </div>
                                <span>1.029 Votes</span>
                            </div> -->
                            <p>{{ $mangaDetails->manga_synopsis }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <!-- TODO : <li><span>Type :</span>Shomen</li> -->
                                            <li><span>Autheur :</span>{{ $mangaDetails->manga_author }}</li>
                                            <li><span>Date d'ajout :</span>{{ $mangaDetails->updated_at }}</li>
                                            <li><span>Status :</span> En cours</li>
                                            <li><span>Uploadeur :</span>{{ $uploader->name }}</li>
                                            <li><span>Colorisé par :</span>{{ $mangaDetails->coloredBy }}</li>
                                            <!-- TODO <li><span>Genre :</span> Action, Adventure, Fantasy, Magic</li> -->
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <!-- TODO <li><span>Scores :</span> 7.31 / 1,515</li>
                                            <li><span>Votes :</span> 8.5 / 161 times</li>
                                            <li><span>Vues :</span> 131,541</li> -->
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <!-- TODO <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Suivre</a>
                                 <a href="#" class="watch-btn"><span>Watch Now</span> <i
                                    class="fa fa-angle-right"></i></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Tomes</h5>
                            </div>
                            @foreach ($listTomes as $tome)
                                <div class="anime__review__item">
                                    <div class="anime__review__item__text">
                                        <a href="/tome/page/{{ $tome->id }}">Tome {{ $tome->tome_number }}</a>
                                    </div>
                                </div>
                            @endforeach 
                        </div>
                    </div>
                    <!-- TODO <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>Vous aimeriez...</h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="<?= asset('assets/img/sidebar/tv-2.jpg ') ?>">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Boruto: Naruto next generations</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="<?= asset('assets/img/sidebar/tv-2.jpg') ?>">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">The Seven Deadly Sins: Wrath of the Gods</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="<?= asset('assets/img/sidebar/tv-3.jpg') ?>">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Sword art online alicization war of underworld</a></h5>
                            </div>
                            <div class="product__sidebar__view__item set-bg" data-setbg="<?= asset('assets/img/sidebar/tv-4.jpg') ?>">
                                <div class="ep">18 / ?</div>
                                <div class="view"><i class="fa fa-eye"></i> 9141</div>
                                <h5><a href="#">Fate/stay night: Heaven's Feel I. presage flower</a></h5>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- Anime Section End -->
@endsection